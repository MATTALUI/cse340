<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <link rel="stylesheet" href="/phpmotors/assets/css/vehicles.css" media="screen">
    <title>PHP Motors | 
      <?php
        if (isset($classification)) {
          echo $classification['classificationName'].' Vehicles';
        } else {
          echo 'All Vehicles';
        }
      ?>
    </title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>
        <?php
          if (isset($classification)) {
            echo $classification['classificationName'].' Vehicles';
          } else {
            echo 'All Vehicles';
          }
        ?>
      </h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <?php buildVehiclesDisplay($inventory); ?>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>