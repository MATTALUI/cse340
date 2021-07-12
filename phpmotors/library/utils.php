<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/vehicle.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/review.php';

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
     echo '<div class="inventory__card-image"><img class="active" src="'.safeImagePath(buildThumbnailPath($vehicle)).'" alt="'.vehicleDisplayName($vehicle).' on phpmotors.com"></div>';
     echo '<div class="inventory__card-info">';
     echo '<h2>'.$vehicle['invMake'].' '.$vehicle['invModel'].'</h2>';
     echo '<span class="inventory__card-price">'.vehiclePrice($vehicle).'</span>';
     echo '</div>'; # inventory__card-info
     echo '</a>'; # inventory__card
    }
    echo '</div>';
  }

  function buildInventoryThumbnailGrid($images) {
    echo '<div class="inventory__card-thumbnails">';
    if (isset($images)) {
      foreach ($images as $image) {
        if(isThumbnail($image['imgPath'])){
          echo '<img src="'.$image['imgPath'].'" alt="vehicle thumbnail '.$image['imgId'].'"/>';
        }
      }
    }
    echo '</div>';
  }

  function buildInventoryCardImages($images) {
    if (isset($images)) {
      $first = true;
      foreach ($images as $image) {
        $class = $first ? 'active' : '';
        if(!isThumbnail($image['imgPath'])){
          echo '<img src="'.$image['imgPath'].'" alt="vehicle" class="'.$class.'"/>';
        }
        $first = false;
      }
    }
  }

  function goToRoot() {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
      $uri = 'https://';
    } else {
      $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    header('Location: '.$uri.'/phpmotors/index.php');
    exit;
  }

  function safeImagePath($path) {
    global $DEFAULT_INVENTORY_IMAGE_PATH;
    if (file_exists($_SERVER['DOCUMENT_ROOT'].$path)) {
      return $path;
    } else {
      return '/phpmotors/'.$DEFAULT_INVENTORY_IMAGE_PATH;
    }
  }

  function buildImageDisplay($images) {
    if (!isset($images) || count($images) === 0) {
      echo '<p class="message-info">There are no images to display.</p>';
    } else {
      foreach ($images as $image) {
        echo '<div class="upload__card">';
        echo '<div class="upload__card-image"><img src="'.safeImagePath($image['imgPath']).'" alt="preview for upload"></div>';
        echo '<a href="/phpmotors/uploads/index.php?action=Destroy&imgId='.$image['imgId'].'" data-confirm="This will permanantly delete this image. Are you sure?">'.$image['imgName'].'</a>';
        echo '</div>';
      }
    }
  }

  function buildReviews($reviews) {
    $clientId = getUserData()['clientId'];
    if (!isset($reviews) || count($reviews) === 0) {
      echo '<p class="message-info">This vehicle has no reviews.</p>';
    } else {
      foreach ($reviews as $review) {
        $reviewerName = buildReviewerDisplayName($review);
        $isUser = $review['clientId'] === $clientId;
        $extraClass = $isUser ? 'owned' : '';

        echo '<div class="review '.$extraClass.'">';
        echo '<div class="review__namecard"><span>'.$reviewerName.'</span></div>';
        echo '<div class="review__text"><span>'.$review['reviewText'].'</span></div>';
        echo '<div class="review__footer">';
        echo '<span>'.formatReviewDate($review).'</span>';
        if ($isUser) {
          echo '<span>';
          echo '<a href="/phpmotors/reviews/index.php?action=Edit&review='.$review['reviewId'].'">Edit</a>';
          echo '<a href="/phpmotors/reviews/index.php?action=Delete&review='.$review['reviewId'].'" >Delete</a>';
          echo '</span>';
        }
        echo '</div>';
        echo '</div>';
      }
    }
  }

  function buildReviewsTable($reviews){
    if (!isset($reviews) || count($reviews) === 0) {
      echo '<p class="message-info">You have no reviews. <a href="/phpmotors/vehicles/index.php?action=Index">Browse our available inventory</a> to add some reviews.</p>';
    } else {
      echo '<table><thead><tr><th>Vehicle</th><th>Review</th><th>Date</th><th></th><th></th></tr></thead><tbody>';
      foreach ($reviews as $review) {
        echo '<tr>';
        echo '<td><a href="/phpmotors/vehicles/index.php?action=Show&vehicleId='.$review['invId'].'">'.formatReviewVehicleName($review).'</a></td>';
        echo '<td>'.$review['reviewText'].'</td>';
        echo '<td>'.formatReviewDate($review).'</td>';
        echo '<td><a href="/phpmotors/reviews/index.php?action=Edit&review='.$review['reviewId'].'">Edit</a></td>';
        echo '<td><a href="/phpmotors/reviews/index.php?action=Delete&review='.$review['reviewId'].'" >Delete</a></td>';
        echo '</tr>';
      }
      echo '</tbody></table>';
    }
  }
?>
