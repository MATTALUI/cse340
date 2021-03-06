<?php
  function getClassifications(){
    $db = phpmotorsConnect(); 
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC'; 
    $stmt = $db->prepare($sql);
    $stmt->execute(); 
    $classifications = $stmt->fetchAll();
    $stmt->closeCursor();
    
    return $classifications;
  }

  function createClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO carclassification (classificationName)
      VALUES (:classificationName)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  function getClassification($classificationId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM carclassification WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $invInfo;
  }
?>