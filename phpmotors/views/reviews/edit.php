<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | Edit Review</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>Edit Review For <?php echo vehicleDisplayName($vehicle); ?></h1>
      <?php
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php';
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/reviews/_form.php';
      ?>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>