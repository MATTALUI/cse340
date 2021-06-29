<?php
  //// UPLOADS CONTROLLER ////
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/constants.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicles-model.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/uploads-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/fileops.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/vehicle.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/user.php';

  $action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();
  requirePrivledge();

  switch ($action) {
    case 'Create':
      $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
      $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);
      $invImage = $_FILES['invImage'];

      $imgName = $invImage['name'];
      $imageCheck = checkExistingImage($invId, $imgName);
            
      $message = '<p class="message-error">Sorry, something went wrong.</p>';;
      if($imageCheck){
        $message = '<p class="message-error">An image by that name already exists for that vehicle.</p>';
      } elseif (empty($invId) || empty($imgName) || $invImage['size'] === 0) {
        $message = '<p class="message-error">You must select a vehicle and image file for the vehicle.</p>';
      } else {
        $imgPaths = addInventoryImages($invId, $invImage);

        if ($imgPrimary) {
          clearPrimaryImage($invId);
          updateVehicleImages($invId, $imgName, makeThumbnailName($imgName));
        }
            
        $result = storeImage($imgPaths['invImage'], $invId, $imgName, $imgPrimary);
        $result += storeImage($imgPaths['invThumbnail'], $invId, makeThumbnailName($imgName), $imgPrimary);
            
        if ($result === 2) {
          $message = '<p class="message-success">The upload succeeded.</p>';
        }
      }
            
      $_SESSION['message'] = $message;
            
      header('location: /phpmotors/uploads/index.php');
      break;
    case 'Destroy':
      $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);
      $image = getImage($imgId);
      $vehicleId = $image['invId'];
      $message = '<p class="message-error">Something went wrong. Unable to delete the image '.$image['imgName'].'.</p>';
            
      $target = $_SERVER['DOCUMENT_ROOT'].$image['imgPath'];

      $result = NULL;
      if (file_exists($target)) {
        $result = unlink($target); 
      }
            
      $remove = NULL;
      if ($result) {
        $remove = deleteImage($imgId);
      }
            
      if ($remove) {
        $message = "<p class='message-success'>".$image['imgName']." was successfully deleted.</p>";
      }
            
      $_SESSION['message'] = $message;
            
      header('location: /phpmotors/uploads/index.php');
      break;
    case 'Manage':
    default:
      $images = getImages();
      $vehicles = getAllInventory();
            
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/uploads/manage.php';
  }
?>