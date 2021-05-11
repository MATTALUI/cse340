<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/home.css" media="screen">
    <link rel="icon" href="/phpmotors/images/site/logo.png">
    <script src="/phpmotors/js/main.js" defer></script>
    <title>PHP Motors | Home</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php'; ?>
    <main>
      <h1>Welcome to PHP Motors!</h1>
      <div id="featured">
        <div id="featured-description">
          <span>DMC Delorean</span>
          <span>3 cup holders</span>
          <span>Superman doors</span>
          <span>Fuzzy dice!</span>
        </div>
        <img src="/phpmotors/images/delorean.jpg" alt="The delorean car">
        <button>Own Today</button>
      </div>
      <div id="reviews">
        <h2>DMC Delorean reviews</h2>
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
        <h2>Delorean Upgrades</h2>
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
            echo "<img src=\"/phpmotors/images/upgrades/$upgrade[img]\" alt=\"$upgrade[name] display\">";
            echo "</div>$upgrade[name]</a>";
          }
        ?>
      </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
  </body>
</html>