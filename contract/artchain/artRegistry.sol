contract artRegistry {

  // TODO: map validator address and more...
  
  /**
   * @title artRegistry
   * @author Artchain.org
   * @notice Registers artwork on the ethereum blockchain, allowing users to appraise.
   * @dev This contract is still under development.
   */
 
  struct Artwork {
      string artistName; // name of artist
      string titleofwork; // title of artwork
      uint dateCreated; // dateCreated in timestamp
      uint issueDate; // issueDate in timestamp
      Appraiser[] appraisers;
  }
  Artwork[] artworks; // will improve later

  struct Appraiser {
      string name;
      string review;
  }
  
  function artDetails(uint artId) constant returns(
    string titleofwork, 
    string artistname, 
    uint datecreated, 
    uint issuedate) {

      return (
          artworks[artId].titleofwork,
          artworks[artId].artistName,
          artworks[artId].dateCreated,
          artworks[artId].issueDate
      );
  }
}
