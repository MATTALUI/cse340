<?php
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
?>