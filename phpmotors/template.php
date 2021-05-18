<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
    <link rel="icon" href="/phpmotors/images/site/logo.png">
    <script src="/phpmotors/js/main.js" defer></script>
    <title>PHP Motors | Template</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php'; ?>
    <main>
      <h1>MAIN CONTENT HERE</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
  </body>
</html>