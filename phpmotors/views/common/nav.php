<nav>
  <button class="navbar-toggler">&#9776;</button>
  <ul class="hidden" aria-hidden="true">
    <?php
      require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/utils.php';
      $links = [
        'Home' => '/phpmotors/index.php',
      ];
      foreach ($links as $link => $path) {
        echo buildNavLink($link, $path);
      }

      if (isset($classifications)) {
        buildClassificationNav($classifications);
      }
    ?>
  </ul>
</nav>