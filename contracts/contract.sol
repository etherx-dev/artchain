pragma solidity ^0.4.2;
/* The token is used as appraising artwork */
contract token { mapping (address => uint256) public balanceOf;  }

contract owned {
    address public owner;
    function owned() {
        owner = msg.sender;
    }
    modifier onlyOwner {
        if (msg.sender != owner) throw;
        _;
    }
    function transferOwnership(address newOwner) onlyOwner {
        owner = newOwner;
    }
}

/* Transfer of the token to user */
contract Token {
    function transferFrom(address _from, address _to, uint256 _value) returns (bool success);
}

contract Artwork is owned, tokenRecipient {
/* Below this is still to be modified  */
    /* Contract Variables and events */
    uint public minimumQuorum;
    Proposal[] public proposals;
    uint public numProposals;
    token public sharesTokenAddress;

    event ProposalAdded(uint proposalID, address recipient, uint amount, string description);
    event Voted(uint proposalID, bool position, address voter);
    event ProposalTallied(uint proposalID, int result, uint quorum, bool active);
    event ChangeOfRules(uint minimumQuorum, uint debatingPeriodInMinutes, address sharesTokenAddress);

    struct Proposal {
        address recipient;
        uint amount;
        string description;
        bool executed;
        bool proposalPassed;
        uint numberOfVotes;
        bytes32 proposalHash;
        Vote[] votes;
        mapping (address => bool) voted;
    }

    struct Vote {
        bool inSupport;
        address voter;
    }

}
