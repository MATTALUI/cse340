<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
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