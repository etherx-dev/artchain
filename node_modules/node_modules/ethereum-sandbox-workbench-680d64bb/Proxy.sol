contract Proxy {

  bool _traceFunctionCalls = false;
  event Trace(address caller, bytes data, uint value);

  function Proxy(bool traceFunctionCalls) {
    _traceFunctionCalls = traceFunctionCalls;
  }

  function setMock(bytes4 method, uint8 operationType, address target, bytes data) {
    operations[method] = Operation(operationType, target, data);
  }

  function setMockWithArgs(bytes methodWithData, uint8 operationType, address target, bytes data) {
    operationsWithArgs[methodWithData] = Operation(operationType, target, data);
  }

  function() {
    if (_traceFunctionCalls) {
      Trace(msg.sender, msg.data, msg.value);
    }
    Operation memory operation = operationsWithArgs[msg.data];
    uint8 operationType = operation.operationType;
    if (operationType == 0) {
      operation = operations[msg.sig];
      operationType = operation.operationType;
      if (operationType == 0) {
        throw;
      }
    } 

    if (operationType == 1) {
      address target = operation.target;
      var retVal = target.call(operation.data);
    } else if (operationType == 2) {
      bytes memory data = operation.data;
      assembly {
        return(add(data, 32), mload(data))
      }
    } else {
      throw;
    }
  }

  struct Operation {
    uint8 operationType;
    address target;
    bytes data;
  }

  mapping (bytes4 => Operation) operations;
  mapping (bytes => Operation) operationsWithArgs;

}
