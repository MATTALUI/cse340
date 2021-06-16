<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <script src="/phpmotors/assets/js/vehicles-manage.js" defer></script>
    <title>PHP Motors | Manage Vehicles</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>Vehicle Management</h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <h2>Vehicles By Classification</h2>
      <p>Choose a classification to see those vehicles</p>
      <?php buildClassificationSelect($classifications); ?>
      <noscript>
        <p>
          <strong>JavaScript Must Be Enabled to Use this Page.</strong>
        </p>
      </noscript>
      <table id="inventoryDisplay"></table>
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