# Ethereum Sandbox Helper

A helper for a tesing with [Ethereum Sandbox](https://github.com/etherj/ethereum-sandbox).

## Installation

```
$ npm install ethereum-sandbox-helper
```

## Usage

**helper.compile(dir, files)**

Compiles specified sol-files in the `dir`. Throws an array of errors in case of compilation errors.

```js
var compiled = helper.compile('contracts', ['contract.sol']);
```

The function uses [solc-js](https://github.com/ethereum/solc-js) under the hood and returns a provided array.

**helper.waitForReceipt(web3, txHash, cb)**

Waits for a receipt of the transaction with the provided transaction hash (`txHash`).

```js
helper.waitForReceipt(sandbox.web3, txHash, function(err, receipt) {
  if (err) return done(err);
  console.log(receipt.logs);
  done();
});
```

**helper.waitForSandboxReceipt(web3, txHash, cb)**

Waits for a sandbox receipt of the transaction with the provided transaction hash (`txHash`). Sandbox receipt has a return value of called function.

```js
helper.waitForSandboxReceipt(sandbox.web3, txHash, function(err, receipt) {
  if (err) return done(err);
  console.log(receipt.returnValue);
  done();
});
```