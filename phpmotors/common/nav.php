<nav>
  <button class="navbar-toggler">&#9776;</button>
  <ul class="hidden" aria-hidden="true">
    <?php
      $req_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $links = [
        'Home' => '/phpmotors/home.php',
        'Classics' => '#',
        'Sports' => '#',
        'SUV' => '#',
        'Trucks' => '#',
        'Used' => '#',
      ];
      foreach ($links as $link => $path) {
        echo '<li><a href="'.$path.'" ';
        echo strcmp($path, $req_path) === 0 ? 'class="active">': '>';
        echo $link;
        echo '</a></li>';
      }
    ?>
  </ul>
</nav>