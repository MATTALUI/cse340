<nav>
  <button class="navbar-toggler">&#9776;</button>
  <ul class="hidden" aria-hidden="true">
    <?php
      function buildLink($link, $path=''){
        $req_path = $_SERVER['REQUEST_URI'];
        $navlink  = '<li><a href="'.$path.'" ';
        $navlink .= strcmp($path, $req_path) === 0 ? 'class="active">': '>';
        $navlink .= $link;
        $navlink .= '</a></li>';

        return $navlink;
      }

      $links = [
        'Home' => '/phpmotors/index.php',
      ];
      foreach ($links as $link => $path) {
        echo buildLink($link, $path);
      }
      // TODO: ignore if not defined
      if (isset($classifications)) {
        foreach ($classifications as $classification) {
          echo buildLink($classification['classificationName'], '/phpmotors/index.php?action='.urlencode($classification['classificationName']));
        }
      }
    ?>
  </ul>
</nav>