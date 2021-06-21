<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <link rel="stylesheet" href="/phpmotors/assets/css/vehicles.css" media="screen">
    <title>PHP Motors | 
      <?php echo vehicleDisplayName($vehicle); ?>
    </title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>
        <?php echo vehicleDisplayName($vehicle); ?>
      </h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <div id="vehicleMain">
        <div class="inventory__card">
          <div class="inventory__card-image">
            <img src="<?php echo safeImagePath($vehicle['invImage']); ?>" alt="image for <?php echo vehicleDisplayName($vehicle); ?>">
          </div>
          <div class="inventory__card-info">
            <span class="inventory__card-price">
              <? echo vehiclePrice($vehicle); ?>
            </span>
            <p>
              <? echo $vehicle['invDescription']; ?>
            </p>
          </div>
        </div>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/_vehicle_table.php';
          if (hasPrivledges()) {
            include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/_vehicle_admin_panel.php';
          }
        ?>
      </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>