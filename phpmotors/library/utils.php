<?php
  function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
  }

  // Check the password for a minimum of 8 characters,
  // at least one 1 capital letter, at least 1 number and
  // at least 1 special character
  function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
  }

  function buildNavLink($link, $path=''){
    $req_path = $_SERVER['REQUEST_URI'];
    $navlink  = '<li><a href="'.$path.'" ';
    $navlink .= strcmp($path, $req_path) === 0 ? 'class="active">': '>';
    $navlink .= $link;
    $navlink .= '</a></li>';

    return $navlink;
  }

  function buildClassificationNav($classifications){
    foreach ($classifications as $classification) {
      echo buildNavLink($classification['classificationName'], '/phpmotors/index.php?action='.urlencode($classification['classificationName']));
    }
  }

  function buildClassificationSelect($classifications, $classificationId=NULL) {
    echo '<select id="classification" name="classificationId">';
    if (isset($classifications)) {
      foreach ($classifications as $classification) {
        echo '<option value="'.$classification['classificationId'].'" ';
        if(isset($classificationId) && $classificationId == $classification['classificationId']){
          echo " selected ";
        }
        echo ' >';
        echo $classification['classificationName'];
        echo'</option>';
      }
    }
    echo '</select>';
  }

  function goToRoot() {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
      $uri = 'https://';
    } else {
      $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    header('Location: '.$uri.'/phpmotors/index.php');
  }

  function safeImagePath($path) {
    global $DEFAULT_INVENTORY_IMAGE_PATH;
    if (file_exists($_SERVER['DOCUMENT_ROOT'].$path)) {
      return $path;
    } else {
      return '/phpmotors/'.$DEFAULT_INVENTORY_IMAGE_PATH;
    }
  }
?>
