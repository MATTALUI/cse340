<?php
	//// VEHICLES CONTROLLER ////
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicles-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';
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
	switch ($action){
		case 'Create':
			$invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
			$invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
			$classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
			$invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
			$invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
			$invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));

			if (
				empty($invMake) ||
				empty($invModel) ||
				empty($classificationId) ||
				empty($invDescription) ||
				empty($invPrice)||
				empty($invStock) ||
				empty($invColor)
			) {
				$message = $message = '<p class="message-error">Please provide all required information.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/new.php';
				exit;
			}


			$newVehicleId = createVehicle(
				$invMake,                      # invMake
				$invModel,                     # invModel
				$classificationId,             # classificationId
				$invDescription,               # invDescription
				$invPrice,                     # invPrice
				$invStock,                     # invStock
				$invColor,                     # invColor
				$DEFAULT_INVENTORY_IMAGE_PATH, # $invImage
				$DEFAULT_INVENTORY_IMAGE_PATH  # $invThumbnail
			);

			if ($_FILES['invImage']['size'] > 0){
				$imgName = $_FILES['invImage']['name'];
				$imgPrimary = 1; // Make it the primary if they uploaded it manually
				$imagePaths = addInventoryImages($newVehicleId, $_FILES['invImage']);
				// @TODO: when adding the image names to the inventory table, we need
				// to make sure names are truncated otherwise it breaks table constraints.
				updateVehicleImages($newVehicleId, $imgName, makeThumbnailName($imgName));
            
				clearPrimaryImage($newVehicleId);
        storeImage($imagePaths['invImage'], $newVehicleId, $imgName, $imgPrimary);
        storeImage($imagePaths['invThumbnail'], $newVehicleId, makeThumbnailName($imgName), $imgPrimary);
			}

			$message = '<p class="message-success">Vehicle successfully created.</p>';

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
			exit;
		case 'Update':
			$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
			$invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
			$invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
			$classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
			$invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
			$invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
			$invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));

			if (
				empty($invMake) ||
				empty($invModel) ||
				empty($classificationId) ||
				empty($invDescription) ||
				empty($invPrice)||
				empty($invStock) ||
				empty($invColor)
			) {
				$message = $message = '<p class="message-error">Please provide all required information.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/edit.php';
				exit;
			}


			$updateResult = updateVehicle(
				$invId,                        # invId
				$invMake,                      # invMake
				$invModel,                     # invModel
				$classificationId,             # classificationId
				$invDescription,               # invDescription
				$invPrice,                     # invPrice
				$invStock,                     # invStock
				$invColor,                     # invColor
			);

			// @TODO: There's a bug here where ONLY updating image will make it look like nothing has changed
			// and trigger a false error; this might be able to be fixed by adding the images first.
			if ($updateResult < 1) {
				$message = $message = '<p class="message-error">An error has occured. Please try again later.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/edit.php';
				exit;
			}

			if ($_FILES['invImage']['size'] > 0){
				$imgName = $_FILES['invImage']['name'];
				$imgPrimary = 1; // Make it the primary since they uploaded it manually
				$imagePaths = addInventoryImages($invId, $_FILES['invImage']);
				// @TODO: when adding the image names to the inventory table, we need
				// to make sure names are truncated otherwise it breaks table constraints.
				updateVehicleImages($invId, $imgName, makeThumbnailName($imgName));
            
				clearPrimaryImage($invId);
        storeImage($imagePaths['invImage'], $invId, $imgName, $imgPrimary);
        storeImage($imagePaths['invThumbnail'], $invId, makeThumbnailName($imgName), $imgPrimary);
			}

			$_SESSION['message'] = '<p class="message-success">Congratulations, the '.$invMake.' '.$invModel.' was successfully updated.</p>';

			header('location: /phpmotors/vehicles/');
			exit;
		case 'Destroy':
			// @TODO: delete associated images
			$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
			$invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
			$invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
			
			$deletedVehicle = deleteVehicle($invId);
			if ($deletedVehicle > 0) {
				$_SESSION['message'] = "<p class='message-success'>Congratulations the, ".$invMake." ".$invModel." was	successfully deleted.</p>";;
				
				header('location: /phpmotors/vehicles/');
				exit;
			} else {
				$_SESSION['message'] = "<p class='message-error'>Error: ".$invMake." ".$invModel." was not deleted.</p>";
				header('location: /phpmotors/vehicles/');
				exit;
			}
			exit;
		case 'ajaxGetInventoryItems': 
			$classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
			$inventory = getInventoryByClassification($classificationId);
			echo json_encode($inventory);
			break;
		case 'Edit':
			$invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
			$invInfo = getInvItemInfo($invId);
			if(!$invInfo) {
				$message = '<p class="message-error">Sorry, no vehicle information could be found.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
				exit;
			}
			$invId = $invInfo['invId'];
			$invImage = $invInfo['invImage'];
			$invMake = $invInfo['invMake'];
			$invModel = $invInfo['invModel'];
			$classificationId = $invInfo['classificationId'];
			$invDescription = $invInfo['invDescription'];
			$invPrice = $invInfo['invPrice'];
			$invStock = $invInfo['invStock'];
			$invColor = $invInfo['invColor'];

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/edit.php';
			exit;
		case 'Delete':
			$invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
			$invInfo = getInvItemInfo($invId);
			if(!$invInfo) {
				$_SESSION['message'] = '<p class="message-error">Sorry, no vehicle information could be found.</p>';
				header('location: /phpmotors/vehicles/');
				exit;
			}

			$invId = $invInfo['invId'];
			$invMake = $invInfo['invMake'];
			$invModel = $invInfo['invModel'];
			$invDescription = $invInfo['invDescription'];
			$invImage = $invInfo['invImage'];
	
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/delete.php';
			exit;
		case 'Show':
			$vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_STRING);
			$vehicle = getInvItemInfo($vehicleId);
			$classificationId = $vehicle['classificationId'];
			$classification = getClassification($classificationId);
			$images = getImagesForInventory($vehicleId);
			$reviews = getVehicleReviews($vehicleId);
			$clientData = getUserData();
			$userReviewed = checkUserReviewedVehicle($vehicleId, $clientData['clientId']);

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/show.php';
			exit;
		case 'Index':
			$classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_STRING);
			$classification = isset($classificationId) ? getClassification($classificationId) : null;
			$inventory = isset($classificationId) ? getInventoryByClassification($classificationId) : getAllInventory();
			
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/index.php';
			exit;
		case 'New':
			$classificationId = '';
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/new.php';
			exit;
    case 'Manage':
		default:
			$classificationId = $classifications[0]['classificationId'];
			$inventory = getInventoryByClassification($classificationId);
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
	}
?>
