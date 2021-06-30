<?php
  $BASE_INVENTORY_SELECTION =
    'SELECT invId
    , invMake
    , invModel
    , invDescription
    , invPrice
    , invStock
    , invColor
    , classificationId
    , ( SELECT imgName
        FROM images
        WHERE images.invId = inventory.invId
        AND images.imgPrimary = 1
        AND images.imgName NOT LIKE "%-tn.%")
      AS invImage
    , ( SELECT imgName
        FROM images
        WHERE images.invId = inventory.invId
        AND images.imgPrimary = 1
        AND images.imgName LIKE "%-tn.%")
      AS invThumbnail
    FROM inventory ';

  function getAllInventory() {
    // @TODO: Paginate to prevent mega queries
    global $BASE_INVENTORY_SELECTION;
    $db = phpmotorsConnect();
    $sql = $BASE_INVENTORY_SELECTION.'ORDER BY invMake ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $inventory; 
  }

  // Get vehicle information by invId
  function getInvItemInfo($invId){
    global $BASE_INVENTORY_SELECTION;
    $db = phpmotorsConnect();
    $sql = $BASE_INVENTORY_SELECTION.'WHERE invId = :invId';
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
    global $BASE_INVENTORY_SELECTION;
    $db = phpmotorsConnect(); 
    $sql = $BASE_INVENTORY_SELECTION.'WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor();

    return $inventory; 
  }

  // @NOTE: The AC of the assignment specifically requested the Delorean on the
  // homepage, but it didn't state specific logic for anything beyond that. So
  // This is how we're going to query for it since DBs aren't going to match up
  // ¯\_(ツ)_/¯
  function getDelorean() {
    global $BASE_INVENTORY_SELECTION;
    $db = phpmotorsConnect(); 
    $sql = $BASE_INVENTORY_SELECTION.'WHERE UPPER(invModel) = UPPER("DELOREAN")'; 
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $inventory = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $inventory; 
  }
?>