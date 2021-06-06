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
?>
