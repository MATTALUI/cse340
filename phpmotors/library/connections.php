<?php
  function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iclient';
    $password = '7ORL5q(VB4-4qQjA'; 
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
      // throw new PDOException('Test Redirect');
      $link = new PDO($dsn, $username, $password, $options);
      return $link;
    } catch(PDOException $e) {
      header('Location: /phpmotors/view/500.php');
      exit;
    }
  }

  $connection = phpmotorsConnect();
?>