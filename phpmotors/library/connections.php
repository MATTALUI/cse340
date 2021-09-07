<?php
  function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iclient';
    $password = '7ORL5q(VB4-4qQjA'; 
    if ($_ENV['DOCKER'] == 'true') {
      $server = 'mysql'; // The name of the container will resolve correctly
      $username = 'root';
      $password = 'some_password'; 
    }
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
      // throw new PDOException('Test Redirect');
      $link = new PDO($dsn, $username, $password, $options);
      return $link;
    } catch(PDOException $e) {
      header('Location: /phpmotors/views/500.php');
      exit;
    }
  }
?>