<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | Manage Vehicles</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>Vehicle Management</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <ul>
        <li>
          <a href="/phpmotors/classifications/index.php?action=New">Add Classification</a>
        </li>
        <li>
          <a href="/phpmotors/vehicles/index.php?action=New">Add Vehicle</a>
        </li>
      </ul>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>