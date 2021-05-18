<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="/phpmotors/assets/css/main.css" media="screen">
    <link rel="icon" href="/phpmotors/assets/images/site/logo.png">
    <script src="/phpmotors/assets/js/main.js" defer></script>
    <title>PHP Motors | Template</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>MAIN CONTENT HERE</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>