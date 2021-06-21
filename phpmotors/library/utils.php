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
      echo buildNavLink($classification['classificationName'], '/phpmotors/vehicles/index.php?action=Index&classificationId='.urlencode($classification['classificationId']));
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

  function buildInventoryTableDataRows($inventory) {
    foreach ($inventory as $vehicle) {
      echo '<tr>';
      echo '<td>'.$vehicle['invMake'].' '.$vehicle['invModel'].'</td>';
      echo '<td><a href="/phpmotors/vehicles?action=Edit&invId='.$vehicle['invId'].'" title="Click to modify">Modify</a></td>';
      echo '<td><a href="/phpmotors/vehicles?action=Delete&invId='.$vehicle['invId'].'" title="Click to delete">Delete</a></td>';
      echo '</tr>';
    }
  }

  function buildVehiclesDisplay($inventory){
    echo '<div id="inventoryCards">';
    if (count($inventory) === 0) {
      echo '<p class="message-info">No vehicles available.</p>';
    }
    foreach ($inventory as $vehicle) {
     echo '<a class="inventory__card" href="/phpmotors/vehicles?action=Show&vehicleId='.$vehicle['invId'].'">';
     echo '<div class="inventory__card-image"><img src="'.safeImagePath($vehicle['invThumbnail']).'" alt="'.vehicleDisplayName($vehicle).' on phpmotors.com"></div>';
     echo '<div class="inventory__card-info">';
     echo '<h2>'.$vehicle['invMake'].' '.$vehicle['invModel'].'</h2>';
     echo '<span class="inventory__card-price">'.vehiclePrice($vehicle).'</span>';
     echo '</div>'; # inventory__card-info
     echo '</a>'; # inventory__card
    }
    echo '</div>';
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
