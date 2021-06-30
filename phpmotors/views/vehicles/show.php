<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <link rel="stylesheet" href="/phpmotors/assets/css/vehicles.css" media="screen">
    <script src="/phpmotors/assets/js/vehicles-show.js" defer></script>
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
            <?php 
              if (isset($images) && count($images) > 1) {
                buildInventoryCardImages($images);
              } else {
                echo '<img src="'.safeImagePath(buildImagePath($vehicle)).'" alt="image for '.vehicleDisplayName($vehicle).'" class="active">';
              }
            ?>
          </div>
          <?php 
            if (isset($images) && count($images) > 1) {
              buildInventoryThumbnailGrid($images);
            }
          ?>
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