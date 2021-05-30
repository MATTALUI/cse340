<!-- VEHICLES CONTROLLER -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicles-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/constants.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/fileops.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'Create':
			$invMake = filter_input(INPUT_POST, 'invMake');
			$invModel = filter_input(INPUT_POST, 'invModel');
			$classificationId = filter_input(INPUT_POST, 'classificationId');
			$invDescription = filter_input(INPUT_POST, 'invDescription');
			$invPrice = filter_input(INPUT_POST, 'invPrice');
			$invStock = filter_input(INPUT_POST, 'invStock');
			$invColor = filter_input(INPUT_POST, 'invColor');

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
		case 'New':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/new.php';
			exit;
    case 'Manage':
		default:
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
	}
?>
