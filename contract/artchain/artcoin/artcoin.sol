pragma solidity ^0.4.4;


import "./StandardToken.sol";


/*
 * artcoin
 *
 * 
 */
contract artcoin is StandardToken {
  
  // name of the artcoin ERC20 token
  string public name = "artcoin";
  // symbol
  string public symbol = "ART";
  // smallest denomination of artcoin is 0.00000001 Laurenzo.
  uint public decimals = 8;

  // 1 ether = 10 artcoin. 1:1 Exchange of art.token for artcoin TBD.
  uint PRICE = 10;
  
  // issue artcoin to the sender of ethereum to this contract.
  function () payable {
    createTokens(msg.sender);
  }
  
  function createTokens(address recipient) payable {
    if (msg.value == 0) throw;

    uint tokens = safeMul(msg.value, getPrice());

    totalSupply = safeAdd(totalSupply, tokens);
    balances[recipient] = safeAdd(balances[recipient], tokens);
  }
  
  // get price of artcoin. 
  function getPrice() constant returns (uint result){
    return PRICE;
  }
}
