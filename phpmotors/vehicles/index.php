<?php
	//// VEHICLES CONTROLLER ////
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicles-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/fileops.php';

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

			if ($_FILES['invImage']){
				$imagePaths = addInventoryImages($newVehicleId, $_FILES['invImage']);
				updateVehicleImages($newVehicleId, $imagePaths['invImage'], $imagePaths['invThumbnail']);
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

			if ($updateResult < 1) {
				$message = $message = '<p class="message-error">An error has occured. Please try again later.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/edit.php';
				exit;
			}

			if ($_FILES['invImage']){
				$imagePaths = addInventoryImages($invId, $_FILES['invImage']);
				updateVehicleImages($invId, $imagePaths['invImage'], $imagePaths['invThumbnail']);
			}

			$_SESSION['message'] = '<p class="message-success">Congratulations, the '.$invMake.' '.$invModel.' was successfully updated.</p>';

			header('location: /phpmotors/vehicles/');
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
		case 'New':
			$classificationId = '';
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/new.php';
			exit;
    case 'Manage':
		default:
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
	}
?>
