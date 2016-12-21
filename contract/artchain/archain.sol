pragma solidity ^0.4.2;

/// @title Artchain - basic draft with collection of functions. is not ready to compile.

contract Artchain {
    // This declares a new complex type which will
    // be used for variables later.
    // It will represent a single voter.
    struct Appraiser {
        uint weight; // weight is accumulated by delegation
        bool voted;  // if true, that person already appraised
        address delegate; // person delegated to
        uint artVote;   // index of the appraised proposal
    }
    struct artwork {
        uint artId;
        bytes32 name; // short name of artwork under 32 characters
        mapping (address => bool) artistAddr;
        address[] artwork;
        uint voteCount;
    }


    struct Appraiser {
        uint userId;
        // ethereum address of the user controlling the account.
        address userAddress;
        // contract address of the user account.
        address contractAddress;
        // type of user 
        // 1: appraiser, 2: artist
        // 3: broker 4: collector
        bytes4 userType;
        bool exists;
        // number of appraisers acknowledging the user.
        uint appraiserCount;
        // list of appraisers
        uint weight; // weight is accumulated by delegation
        bool voted;  // if true, that person already voted
        address delegate; // person delegated to
        uint vote;   // index of the voted proposal
    }

*/
/*    address[] votersArray;
    mapping(address => address[]) votesOf;
    mapping(address => mapping(address => int8)) votesMapOf;
    mapping(address => bool) appraised; // If a registered voter has voted or not
*/
    //The function takes as an argument the address we want to vote for and
    //a vote.

  /*  modifier vote_only_once() {
        if (hasVoted[msg.sender]) throw;
        _
    }
    
    // Name Artist Date Size Material Image Issuer Owner
    
    function validateCertificate(){
        
    }
    
    function validateProfile(){
        
    }
    
    function issueCertificate(){
        
    }
    
    function transferCertificate(){
        
    }
    
    function transferArtwork(){
        
    }
    
    function createUser(address voteFor, int vote) {

    }

    function totalAppraisers() constant returns (uint) {
        return votersArray.length;
    }

    function voterOfIndex(uint index) constant returns (address) {
        return votersArray[index];
    }

    function totalVotesOf(address currentAppraiser) constant returns (uint) {
        return votesOf[currentAppraiser].length;
    }

*/
}
