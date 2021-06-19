<?php
  // Accounts Model

  // Register a new client
  function registerClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
      VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  // Check for an existing email address
  function checkExistingEmail($clientEmail) {
    $db =  phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    
    return !empty($matchEmail);
  }

  // Get client data based on an email address
  function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
  }

  function updateClient($clientId, $clientEmail, $clientFirstname, $clientLastname){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients
      SET clientEmail = :clientEmail,
          clientFirstname = :clientFirstname,
          clientLastname = :clientLastname
    WHERE clientId = :clientId'; 
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);

    $stmt->execute();
    $stmt->closeCursor();

    return $stmt->rowCount();
  }

  function updateClientPassword($clientId, $hashedPassword){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId'; 
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);

    $stmt->execute();
    $stmt->closeCursor();

    return $stmt->rowCount();
  }
?>