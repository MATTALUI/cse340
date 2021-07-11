<?
  $BASE_REVIEW_SELECTION = 
    'SELECT reviews.*
    , clients.clientFirstname AS reviewerFirstname
    , clients.clientLastname AS reviewerLastname
    FROM reviews
    JOIN clients
    ON reviews.clientId = clients.clientId ';

  function getReviews() {
    global $BASE_REVIEW_SELECTION;

    $db = phpmotorsConnect(); 
    $sql = $BASE_REVIEW_SELECTION; 
    $stmt = $db->prepare($sql);
    $stmt->execute(); 
    $reviews = $stmt->fetchAll();
    $stmt->closeCursor();
    
    return $reviews;
  }

  function getReview($reviewId) {
    global $BASE_REVIEW_SELECTION;

    $db = phpmotorsConnect(); 
    $sql = $BASE_REVIEW_SELECTION.' WHERE reviewId = :reviewId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute(); 

    $review = $stmt->fetch();
    $stmt->closeCursor();
    
    return $review;
  }

  function getReviewFromUserForVehicle($clientId, $invId) {
    global $BASE_REVIEW_SELECTION;

    $db = phpmotorsConnect(); 
    $sql = $BASE_REVIEW_SELECTION.' WHERE reviews.clientId = :clientId AND invId = :invId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute(); 

    $review = $stmt->fetch();
    $stmt->closeCursor();
    
    return $review;
  }

  function getVehicleReviews($invId) {
    global $BASE_REVIEW_SELECTION;

    $db = phpmotorsConnect(); 
    $sql = $BASE_REVIEW_SELECTION.' WHERE invId = :invId ORDER BY reviewDate DESC';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute(); 

    $review = $stmt->fetchAll();
    $stmt->closeCursor();
    
    return $review;
  }

  function checkUserReviewedVehicle($invId, $clientId) {
    $db = phpmotorsConnect(); 
    $sql = 'SELECT COUNT(1) AS result FROM reviews WHERE invId = :invId AND clientId = :clientId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute(); 

    $resultSet = $stmt->fetch();
    $stmt->closeCursor();
    
    return $resultSet['result'] === '1';
  }

  function createReview($reviewText, $invId, $clientId) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
      VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  function updateReview($reviewId, $reviewText) {
    // @NOTE: It might seem strange to only need the text to update the review, but
    // changing any of the other data changes the intrinsic identity of a review. Only
    // the text and maybe the date could be changed without putting ourselves into a
    // situation where it might as well be a different review, but the assignment AC
    // doesn't describe the behaviour of the date when making changes so I'm ignoring
    // that for now.
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }
?>