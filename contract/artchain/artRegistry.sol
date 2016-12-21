contract artRegistry {

// TODO: map validator address and more...

/**
 * @title artRegistry
 * @author Artchain.org
 * @notice Registers artwork on the ethereum blockchain, allowing users to appraise.
 * @dev This contract is still under development.
 */
 
    enum existence { yes, no } // does the artwork exist
    struct Artwork {
        exists existence; 
        string artistName; // name of artist
        uint dateCreated; // dateCreated in timestamp
        uint issueDate; // issueDate in timestamp
        Appraiser[] appraisers;
    }
    
    struct Appraiser {
        string name;
        string review;
    }

}
