<?php

  function getAllInventory() {
    // @TODO: Paginate to prevent mega queries
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory ORDER BY invMake ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $inventory; 
  }

  // Get vehicle information by invId
  function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $invInfo;
  }

  function createVehicle(
    $invMake,
    $invModel,
    $classificationId,
    $invDescription,
    $invPrice,
    $invStock,
    $invColor,
    $invImage,
    $invThumbnail
  ) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO inventory (
      invMake,
      invModel,
      classificationId,
      invImage,
      invThumbnail,
      invDescription,
      invPrice,
      invStock,
      invColor
    ) VALUES (
      :invMake,
      :invModel,
      :classificationId,
      :invImage,
      :invThumbnail,
      :invDescription,
      :invPrice,
      :invStock,
      :invColor
    )'; 
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);

    $stmt->execute();
    $stmt->closeCursor();

    return $db->lastInsertId();
  }

  function updateVehicleImages($vehicleId, $invImage, $invThumbnail) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory SET
      invImage = :invImage,
      invThumbnail = :invThumbnail
      WHERE invId = :vehicleId'; 
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':vehicleId', $vehicleId, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);

    $stmt->execute();
    $stmt->closeCursor();
  }

  function updateVehicle(
    $invId,
    $invMake,
    $invModel,
    $classificationId,
    $invDescription,
    $invPrice,
    $invStock,
    $invColor
  ) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory
      SET invMake = :invMake,
        invModel = :invModel,
        classificationId = :classificationId,
        invDescription = :invDescription,
        invPrice = :invPrice,
        invStock = :invStock,
        invColor = :invColor
    WHERE invId = :invId'; 
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);

    $stmt->execute();
    $stmt->closeCursor();

    return $stmt->rowCount();
  }

  function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId'; 
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    $stmt->execute();
    $stmt->closeCursor();

    return $stmt->rowCount();
  }

  function getInventoryByClassification($classificationId){
    $db = phpmotorsConnect(); 
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
  }
?>