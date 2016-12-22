contract artRegistry {

  // TODO: map validator address and more...
  
  /**
  * @author Artchain.org
  * @notice Registers artwork on the ethereum blockchain, allowing users to appraise.
  * @dev This contract is still under development.
  */
  event RegisteredAppraisal(uint artId, uint apprId);
  event RegisteredArt(uint artId);

  struct Artwork {
      string artistName; // name of artist
      string titleofwork; // title of artwork
      uint dateCreated; // dateCreated in timestamp
      uint issueDate; // issueDate in timestamp
      Appraiser[] appraisers; // array of apraisers
  }
  Artwork[] artworks; // will improve later

  struct Appraiser {
      string name; // name of appraiser
      string review; // review from the appraiser
  }

  // @param artId  returns 
  function appraisalsOf(uint artId) constant returns(uint res) {
      return artworks[artId].appraisers.length;
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
  
  function appraiseArtwork(
    uint artId,
    string name,
    string review
  ) returns(
    uint apprId
    ) {
      if(bytes(name).length != 0 || bytes(review).length != 0) {
        apprId = artworks[artId].appraisers.length++; // assign ID for the appraisal
        artworks[artId].appraisers[apprId].name = name; 
        artworks[artId].appraisers[apprId].review = review;
        RegisteredAppraisal(artId, apprId);
      } else {
        throw;
      }
  }

  
  function publishArtwork(
    string titleofwork,
    string artistName,
    uint dateCreated
  ) returns(
    uint artId
  ) {
    if(bytes(titleofwork).length == 0 || bytes(artistName).length == 0) {
      artId = artworks.length++;
      artworks[artId].titleofwork = titleofwork;
      artworks[artId].artistName = artistName;
      artworks[artId].dateCreated = dateCreated;
      artworks[artId].issueDate = block.timestamp;
      RegisteredArt(artId);
    } else {
      throw;
    }
  }
  
  // returns total number of artworks on registry
  function totalArts() constant returns (uint res) {
    return artworks.length;
  }
  
}
