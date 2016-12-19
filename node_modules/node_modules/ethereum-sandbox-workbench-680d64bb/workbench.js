/*
 * Ethereum Sandbox Helper
 * Copyright (C) 2016  <ether.camp> ALL RIGHTS RESERVED  (http://ether.camp)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License version 3
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License version 3 for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

var crypto = require('crypto');
var Module = require('module');
var vm = require('vm');
var async = require('async');
var _ = require('lodash');
var path = require('path');
var https = require('https');

if (typeof it !== 'undefined') {
  var originalIt = it;
  var patchFunc = function(func) {
    var patched = function(description, cb) {
      if (typeof cb === 'undefined') return func(description);
      if (cb.length > 0) console.log('ERROR: it callback should not have parameters, this could lead to unexpected behaviour');
      return func(description, function() {
        var result;
        result = cb();
        if (typeof result === 'undefined') {
          throw new Error('ERROR: it callback did not return promise');
        }
        return result;
      });
    };
    return patched;
  };
  it = patchFunc(originalIt);
  it.only = patchFunc(originalIt.only);
  it.skip = patchFunc(originalIt.skip);
}
Promise.prototype['originalThen'] = Promise.prototype.then;
Promise.prototype['then'] = function() {
  var resultCheckerFunc = function(result) {
    if (typeof result === 'undefined')
      console.log('WARNING: result from promise was undefined');
    return result;
  };
  if (typeof arguments[1] === 'function') {
    return this.originalThen(arguments[0], arguments[1]);
  } else {
    return this.originalThen(arguments[0])
    .originalThen(resultCheckerFunc);
  }
};
var Pudding = require('ether-pudding');
var requireFromSourceInject =  function(source, filename) {
  // Modified from here: https://gist.github.com/anatoliychakkaev/1599423
  // Allows us to require asynchronously while allowing specific dependencies.
  var m = new Module(filename);

  // Provide all the globals listed here: https://nodejs.org/api/globals.html
  var context = {
    Buffer: Buffer,
    __dirname: path.dirname(filename),
    __filename: filename,
    clearImmediate: clearImmediate,
    clearInterval: clearInterval,
    clearTimeout: clearTimeout,
    Promise: Promise,
    console: console,
    exports: exports,
    global: global,
    module: m,
    process: process,
    require: require,
    setImmediate: setImmediate,
    setInterval: setInterval,
    setTimeout: setTimeout,
  };

  var script = vm.createScript(source, filename);
  script.runInNewContext(context);

  return m.exports;
};

Pudding._requireFromSource = requireFromSourceInject;

var path = require('path');
var fs = require('fs');

var callsite = require('callsite');
var Sandbox = require('ethereum-sandbox-client');
var helper = require('ethereum-sandbox-helper');
var SolidityFunction = require("web3/lib/web3/function.js");
var coder = require('web3/lib/solidity/coder');

var proxyContractName = 'Proxy';

function configureState(options, ethereumJsonPath) {
  var state;
  if (options.initialState) {
    fs.writeFileSync(ethereumJsonPath, JSON.stringify(options.initialState));
  }

  var defaultAccount = '0xcd2a3d9f938e13cd947ec05abc7fe734df8dd826';
  var miner = '0xa413a58a1a925001ad2a50b35f2cd337752f84ff';
  if (options.defaults && options.defaults.from) defaultAccount = options.defaults.from;
  else this.defaults.from = defaultAccount;

  if (!fs.existsSync(ethereumJsonPath)) {
    if (options.defaults && options.defaults.miner) miner = options.defaults.miner;

    state = {
      contracts: './contract',
      env: {
        block: {
          coinbase: miner,
          difficulty: '0x0100',
          gasLimit: 314159200,
          gasPrice: 600000000
        },
        accounts: {}
      }
    };
    state.env.accounts[defaultAccount] = {
      name: 'fellow-1',
      balance: 1000000000000000000000000,
      nonce: '1430',
      pkey: 'cow',
      default: true
    };
    fs.writeFileSync(ethereumJsonPath, JSON.stringify(state));
  }
}

var Workbench = function(options) {
  this.sandbox = new Sandbox('http://localhost:8554');
  this.readyContracts = {};
  if (!options) options = {};
  this.defaults = options.defaults || {};
  this.ethereumJsonPath = path.dirname(callsite()[1].getFileName()) + '/ethereum.json';
  if (options.ethereumJsonPath) this.ethereumJsonPath = options.ethereumJsonPath;
  configureState.bind(this)(options, this.ethereumJsonPath);
  this.state = JSON.parse(fs.readFileSync(this.ethereumJsonPath));
  this.contractsDirectory = options.contractsDirectory || this.state.contracts;
  this.solcVersion = options.solcVersion || 'latestStable';
};

function getDependencies(files, dir) {
  var dependencies = [];

  getDeps(files);
  return dependencies;

  function getDeps(files) {
    files.forEach(function(file) {
      if (_.startsWith(file, './')) file = file.substr(2);
      if (_.includes(dependencies, file)) return;

      dependencies.push(file);

      var content = fs.readFileSync(dir + '/' + file);
      var rx = /^(?:\s*import\s*")([^"]*)"/gm,
          match,
          deps = [];
      while ((match = rx.exec(content)) !== null) {
        deps.push(match[1]);
      }
      getDeps(deps);
    });
  }
}

Workbench.prototype.compileWithCache = function(dir, contractsWithoutDependencies, printSolcVersion) {
  var self = this;
  var cacheDir = '.contract_cache';
  if (!fs.existsSync(cacheDir)) {
    fs.mkdirSync(cacheDir);
  }
  var compiled = {contracts: [], sources: []};
  var contracts = [];
  function resolveContractDependencies(contractsToCheck) {
    contractsToCheck.forEach(function(contract) {
      var dependencies = getDependencies([contract], dir);
      contracts = contracts.concat(dependencies);
    });
  }
  resolveContractDependencies(contractsWithoutDependencies);

  var isSolcCurrent = true;
  var solcVersionCachePath = cacheDir + '/solc.cache';
  var currentSolcVersion = self.specificSolc ? self.solcVersion : helper.getSolcVersion();
  if (!fs.existsSync(solcVersionCachePath)) {
    fs.writeFileSync(solcVersionCachePath, currentSolcVersion);
    isSolcCurrent = false;
  } else {
    var cachedSolcVersion = fs.readFileSync(solcVersionCachePath).toString();
    if (cachedSolcVersion !== currentSolcVersion) {
      fs.writeFileSync(solcVersionCachePath, currentSolcVersion);
      isSolcCurrent = false;
    }
  }

  if (printSolcVersion) {
    console.log('Using solc version: ' + currentSolcVersion);
  }

  contracts.forEach(function(contract) {
    var contractContent = fs.readFileSync(dir + '/' + contract);

    var md5 = crypto.createHash('md5').update(contractContent).digest('hex');
    var cachePath = cacheDir + '/' + path.basename(contract);

    var copyContractsWithCode = function(output, compiled, timestamp) {
      Object.keys(compiled.contracts).forEach(contractName => {
        if (compiled.contracts[contractName].assembly) {
          if (output.contracts[contractName] && output.contracts[contractName].timestamp > timestamp) return;
          output.contracts[contractName] = compiled.contracts[contractName];
          output.contracts[contractName].timestamp = timestamp;
          output.sources[contractName] = compiled.sources[contractName];
        }
      });
      return output;
    };

    var compileIt = function() {
      var output = helper.compile(dir, [contract], self.specificSolc);
      var timestamp = Date.now();
      var saveObj = {
        output: output,
        hash: md5,
        timestamp: timestamp
      };
      fs.writeFileSync(cachePath, JSON.stringify(saveObj));
      copyContractsWithCode(compiled, output, timestamp);
    };

    if (!isSolcCurrent) {
      compileIt();
      return;
    }

    if (!fs.existsSync(cachePath)) {
      compileIt();
      return;
    }
    var cacheContent = JSON.parse(fs.readFileSync(cachePath));
    if (cacheContent.hash !== md5) {
      compileIt();
      return;
    } else {
      copyContractsWithCode(compiled, cacheContent.output, cacheContent.timestamp || 0);
    }
  });
  return compiled;
};

Workbench.prototype.compile = function(contracts, dir, cb) {
  var output = this.compileWithCache(dir, contracts, true);
  var proxyOutput = this.compileWithCache(__dirname, [proxyContractName + '.sol']);
  Object.assign(output.contracts, proxyOutput.contracts);
  Object.assign(output.sources, proxyOutput.sources);
  var ready = {};
  Object.keys(output.contracts).forEach(contractName => {
    var contract = output.contracts[contractName];
    var contractData = {
      abi: JSON.parse(contract.interface),
      unlinked_binary: '0x' + contract.bytecode
    };
    ready[contractName] = Pudding.whisk(contractName, contractData);
  });
  if (cb) cb(ready);
  return ready;
};

Workbench.prototype.start = function(contracts, cb) {
  var self = this;
  this.sandbox.start(this.ethereumJsonPath, this.specificSolc, function (err) {
    if (err) return cb(err);
    Object.keys(contracts).forEach(contractName => {
      contracts[contractName].setProvider(self.sandbox.web3.currentProvider);
      // return result as per: https://github.com/ConsenSys/ether-pudding/issues/39
      // code here based on https://github.com/ConsenSys/ether-pudding/blob/5a3f4023bb2b2816086193dce8015eb49193bd5e/classtemplate.js#L11
      contracts[contractName].web3.currentProvider.send = function() {
        return this.provider.send.apply(this.provider, arguments);
      };
      if (self.defaults) contracts[contractName].defaults(self.defaults);
    });
    cb();
  });
};

Workbench.prototype.stop = function(cb) {
  this.sandbox.stop(cb);
};

function makeCallsSync(contract) {
  var self = this;
  contract.originalNew = contract.new;
  contract.new = function() {
    return this.originalNew.apply(this, arguments)
    .then(function(contractToPatch) {
      contractToPatch.web3Contract = self.sandbox.web3.eth.contract(contractToPatch.abi).at(contractToPatch.address);
      contractToPatch.abi.forEach(obj => {
        if (obj.type === 'function') {
          var callFunc = function() {
            var options = {};
            Object.assign(options, self.defaults);
            var args = arguments;
            args[Object.keys(args).length] = options;
            return contractToPatch.web3Contract[obj.name].call.apply(null, args);
          };
          var newFunc;
          if (obj.constant) {
            newFunc = callFunc;
            Object.assign(newFunc, contractToPatch[obj.name]);
          } else {
            newFunc = contractToPatch[obj.name];
          }
          newFunc.call = callFunc;
          contractToPatch[obj.name] = newFunc;

          contractToPatch[obj.name].decodeReturn = function(returnValue) {
            return coder.decodeParams(obj.outputs.map(x => x.type), returnValue.replace('0x', ''));
          };
        }
      });
      return contractToPatch;
    });
  };
}

function setupMockOnContract(contract) {
  var self = this;
  contract.newMock = function(options) {
    return self.readyContracts[proxyContractName].originalNew((options && options.traceFunctionCalls) || false)
    .then(function(proxyContract) {
      if (proxyContract.address) {
        var proxyContractMock = contract.at(proxyContract.address);
        proxyContractMock.abi.forEach(obj => {
          if (obj.type === 'function') {
            var func = new SolidityFunction(null, obj, null);
            proxyContractMock[obj.name].mockCallReturnValue = function(returnValue, onArgs) {
              var encoded = coder.encodeParams([obj.outputs[0].type], [returnValue]);
              var promise;
              if (onArgs) {
                var encodedInput = coder.encodeParams(obj.inputs.map(x => x.type), onArgs);
                promise = proxyContract.setMockWithArgs('0x' + func.signature() + encodedInput, 2, '0x0', '0x' + encoded, {gas: 500000});
              } else {
                promise = proxyContract.setMock('0x' + func.signature(), 2, '0x0', '0x' + encoded, {gas: 500000});
              }
              return promise
              .then(function(txHash) {
                return self.waitForReceipt(txHash);
              });
            };
            proxyContractMock[obj.name].mockTransactionForward = function(address, options, onArgs) {
              var data;
              if (options.data) {
                data = options.data;
              } else {
                var funcAbi;
                options.contract.abi.forEach(abiFunc => {
                  if (options.functionName === abiFunc.name) {
                    funcAbi = abiFunc;
                  }
                });
                var funcForForward = new SolidityFunction(null, funcAbi, null);
                data = funcForForward.toPayload(options.args).data;
              }
              var promise;
              if (onArgs) {
                var encodedInput = coder.encodeParams(obj.inputs.map(x => x.type), onArgs);
                promise = proxyContract.setMockWithArgs('0x' + func.signature() + encodedInput, 1, address, data, {gas: 500000});
              } else {
                promise = proxyContract.setMock('0x' + func.signature(), 1, address, data, {gas: 500000});
              }

              return promise
              .then(function(txHash) {
                return self.waitForReceipt(txHash);
              });
            };

            proxyContractMock[obj.name].wasCalled = function(receipt) {
              var called = false;
              var retArgs;
              receipt.logs.forEach(eventLog => {
                if (eventLog.parsed && eventLog.parsed.event == 'Trace') {
                  var funcSig = '0x' + func.signature();
                  var parsedArgs = eventLog.parsed.args;
                  if (parsedArgs.data.startsWith(funcSig)) {
                    called = true;
                    retArgs = coder.decodeParams(obj.inputs.map(x => x.type), parsedArgs.data.replace(funcSig, ''));
                  }
                }
              });
              return {
                called: called,
                args: retArgs
              };
            };
          }
        });
        return proxyContractMock;
      } else {
        throw new Error('No address for proxy contract');
      }
    });
  };
}

Workbench.prototype.startTesting = function(contracts, cb) {
  var self = this;
  if (typeof contracts === 'string') contracts = [contracts];
  contracts = contracts.map(x => x + '.sol');
  var setupTesting = (function() {
    var dir = this.contractsDirectory;

    Object.assign(this.readyContracts, this.compile(contracts, dir));
    Object.keys(this.readyContracts).forEach(contractName => {
      var contract = this.readyContracts[contractName];
      makeCallsSync.bind(this)(contract);
      setupMockOnContract.bind(this)(contract);
    });
  }).bind(this);

  var name = '[' + contracts.join(', ') + '] Contracts Testing';
  describe(name, function() {
    this.timeout(60000);
    before(function(done) {
      var solcVersion = self.solcVersion;
      if (solcVersion == 'latestStable') {
        setupTesting();
        self.start(self.readyContracts, done);
      } else {
        https.get('https://ethereum.github.io/solc-bin/bin/list.json', function(res) {
          var body = '';
          res.on('data', function(data) {
            body += data;
          });
          res.on('end', function() {
            try {
              var solcJson = JSON.parse(body);
              var solcVersionString;
              if (solcJson.releases[solcVersion]) {
                solcVersionString = solcJson.releases[solcVersion].replace('soljson-', '').replace('.js', '');
              } else {
                var builds = solcJson.builds.filter(function(obj) {
                  return obj.path.indexOf(solcVersion) >= 0;
                });
                if (builds.length === 0) {
                  done(new Error('Error setting up solc: could not find matching version ' + solcVersion));
                  return;
                } 
                if (builds.length > 1) {
                  done(new Error('Error setting up solc: multiple matching versions for ' + solcVersion + ': ' + builds.join(', ')));
                  return;
                } 
                solcVersionString = solcVersion;
              }
              helper.getSpecificSolc(solcVersionString, function(err, specificSolc) {
                if (err) {
                  done(err);
                  return;
                }
                self.specificSolc = specificSolc;
                setupTesting();
                self.start(self.readyContracts, done);
              });
            } catch(e) {
              done(new Error('Error setting up solc: ' + e));
            }
          });
        });
      }
    });
    after(function(done) {
      self.stop(done);
    });
    if (cb) cb(self.readyContracts);
  });
};

Workbench.prototype.waitForReceipt = function (txHash) {
  var self = this;
  return new Promise((resolve, reject) => {
    var called = false;
    function cb(err, receipt) {
      if (err) return reject(err);
      self.sandbox.web3.sandbox.receipt(txHash, function(err, sandboxReceipt) {
        if (err) return reject(err);
        checkForSandboxReceiptErrors(sandboxReceipt, txHash);
        receipt.logs.forEach(eventLog => {
          for (var key in self.readyContracts) {
            if (eventLog.topics.length > 0) {
              eventLog.parsed = helper.parseEventLog(self.readyContracts[key].abi, eventLog);
              if (eventLog.parsed) break;
            }
          }
        });
        return resolve(receipt);
      });
    }
    var web3 = self.sandbox.web3;
    web3.eth.getTransactionReceipt(txHash, function(err, receipt) {
      if (receipt) return cb(null, receipt);
      var blockFilter = web3.eth.filter('latest');
      blockFilter.watch(function() {
        web3.eth.getTransactionReceipt(txHash, function(err, receipt) {
          if (err) return cb(err);
          if (receipt) {
            if (called) return; // protection against double calling
            called = true;
            blockFilter.stopWatching();
            cb(null, receipt);
          }
        });
      });
    });
  });
};

function checkForSandboxReceiptErrors(receipt, txHash) {
  if (receipt.exception === 'out of gas') console.log('Out of gas: tx ' + txHash);
}
Workbench.prototype.waitForSandboxReceipt = function (txHash) {
  var self = this;
  return new Promise((resolve, reject) => {
    var called = false;
    function cb(err, receipt) {
      if (err) return reject(err);
      checkForSandboxReceiptErrors(receipt, txHash);
      return resolve(receipt);
    }
    var web3 = self.sandbox.web3;
    web3.sandbox.receipt(txHash, function(err, receipt) {
      if (receipt) return cb(null, receipt);
      var blockFilter = web3.eth.filter('latest');
      blockFilter.watch(function() {
        web3.sandbox.receipt(txHash, function(err, receipt) {
          if (err) return cb(err);
          if (receipt) {
            if (called) return; // protection against double calling
            called = true;
            blockFilter.stopWatching();
            cb(null, receipt);
          }
        });
      });
    });
  });
};

Workbench.prototype.sendTransaction = function (options) {
  var self = this;
  return new Promise((resolve, reject) => {
    return self.sandbox.web3.eth.sendTransaction(options, function (err, txHash) {
      if (err) return reject(err);
      return resolve(txHash);
    });
  });
};

Workbench.prototype.call = function (options) {
  var self = this;
  return new Promise((resolve, reject) => {
    return self.sandbox.web3.eth.call(options, function (err, result) {
      if (err) return reject(err);
      return resolve(result);
    });
  });
};

Workbench.prototype.stopMiner = function () {
  var self = this;
  var web3 = self.sandbox.web3;
  return new Promise((resolve, reject) => {
    return web3.sandbox.stopMiner(function (err) {
      if (err) return reject(err);
      return resolve(true);
    });
  });
};

Workbench.prototype.startMiner = function () {
  var self = this;
  var web3 = self.sandbox.web3;
  return new Promise((resolve, reject) => {
    return web3.sandbox.startMiner(function (err) {
      if (err) return reject(err);
      return resolve(true);
    });
  });
};

Workbench.prototype.mine = function (numBlocks) {
  var self = this;
  var web3 = self.sandbox.web3;
  return new Promise((resolve, reject) => {
    return web3.sandbox.mine(numBlocks, function (err) {
      if (err) return reject(err);
      return resolve(true);
    });
  });
};

Workbench.prototype.setTimestamp = function (timestamp, keepTimestampConstant) {
  var self = this;
  var web3 = self.sandbox.web3;
  return new Promise((resolve, reject) => {
    var toSet;
    if (typeof timestamp == 'string') {
      toSet = Date.parse(timestamp);
    } else if (typeof timestamp == 'number') {
      toSet = timestamp;
    } else if (typeof timestamp == 'object' && timestamp.getTime) {
      toSet = timestamp.getTime();
    }
    toSet = parseInt(toSet / 1000);
    return web3.sandbox.setTimestamp(toSet, keepTimestampConstant, function (err) {
      if (err) return reject(err);
      return resolve(true);
    });
  });
};

Workbench.prototype.rollTimeTo = function (timestamp, movingTimestamp) {
  var self = this;
  return self.setTimestamp(timestamp, !movingTimestamp)
  .then(function() {
    return self.mine(1);
  });
};

module.exports = Workbench;
