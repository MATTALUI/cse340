<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <link rel="stylesheet" href="/phpmotors/assets/css/home.css" media="screen">
    <title>PHP Motors | Home</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>
        <?php
          echo 'Welcome to PHP Motors';
          if (isset($userFirstname)){
            echo ', '.$userFirstname;
           }
          echo '!';
        ?>
      </h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <div id="featured">
        <div id="featured-description">
          <span>
            <?php echo isset($featuredVehicle) ? vehicleDisplayName($featuredVehicle) : 'DMC Delorean'; ?>
          </span>
          <span>3 cup holders</span>
          <span>Superman doors</span>
          <span>Fuzzy dice!</span>
        </div>
        <img src="<?php echo isset($featuredVehicle) ? safeImagePath(buildImagePath($featuredVehicle)) : '/phpmotors/assets/images/delorean.jpg'; ?>" alt="The delorean car">
        <a class="button" href="<?php echo isset($featuredVehicle) ? '/phpmotors/vehicles?action=Show&vehicleId='.$featuredVehicle['invId'] : '#';?>">Own Today</a>
      </div>
      <div id="reviews">
        <h2><?php echo isset($featuredVehicle) ? vehicleDisplayName($featuredVehicle) : 'DMC Delorean'; ?> reviews</h2>
        <ul>
          <?php
            $reviews = [
              '"So fast it\'s almost like in time." (4/5)',
              '"Coolest ride on the road." (4/5)',
              '"I\'m telling Marty McFly!" (5/5)',
              '"The most futuristic ride of our day" (5/5)',
              '"80\'s livin and loving it!" (5/5)',
            ];
            foreach ($reviews as $review) {
              echo "<li>$review</li>";
            }
          ?>
        </ul>
      </div>
      <div id="upgrades">
        <h2><?php echo isset($featuredVehicle) ? $featuredVehicle['invModel'] : 'DMC Delorean'; ?> Upgrades</h2>
        <?php
          $upgrades = [
            array("name" => "Flame Decals", "img" => "flame.jpg"),
            array("name" => "Flux Capacitor", "img" => "flux-cap.png"),
            array("name" => "Bumper Stickers", "img" => "bumper_sticker.jpg"),
            array("name" => "Hub Caps", "img" => "hub-cap.jpg"),
          ];
          $thang = "cats";
          foreach ($upgrades as $upgrade) {
            echo "<a href=\"#\"><div>";
            echo "<img src=\"/phpmotors/assets/images/upgrades/$upgrade[img]\" alt=\"$upgrade[name] display\">";
            echo "</div>$upgrade[name]</a>";
          }
        ?>
      </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>