<?php
  function storeImage($imgPath, $invId, $imgName, $imgPrimary) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary) VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
    $stmt = $db->prepare($sql);
    // Store the full size image information
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  function getImage($imgId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $imageArray = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $imageArray;
  }

  // Get Image Information from images table
  function getImages() {
    $db = phpmotorsConnect();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $imageArray;
  }

  function getImagesForInventory($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM images
      WHERE invId = :invId
      ORDER BY imgPrimary DESC';
    $stmt = $db->prepare($sql);
  
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
  
    return $imageArray;
  }

  // Delete image information from the images table
  function deleteImage($imgId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();

    return $result;
  }

  // Check for an existing image
  function checkExistingImage($invId, $imgName){
    $db = phpmotorsConnect();
    $sql = "SELECT imgName FROM images WHERE imgName = :name AND invId = :invId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();

    return $imageMatch;
  }

  function setAsPrimaryImage($invId, $imgName) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE images
      SET imgPrimary = 1
      WHERE invId = :invId
      AND imgName = :imgName'; 
    $stmt = $db->prepare($sql);
  
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgId', $invId, PDO::PARAM_STR);
  
    $stmt->execute();
    $stmt->closeCursor();
  
    return $stmt->rowCount();
  }

  function clearPrimaryImage($invId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE images
      SET imgPrimary = 0
      WHERE invId = :invId'; 
    $stmt = $db->prepare($sql);
  
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  
    $stmt->execute();
    $stmt->closeCursor();
  
    return $stmt->rowCount();
  }
?>