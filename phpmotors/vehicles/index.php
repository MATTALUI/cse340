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
			$newVehicleId = createVehicle(
				filter_input(INPUT_POST, 'invMake'), # invMake
				filter_input(INPUT_POST, 'invModel'), # invModel
				filter_input(INPUT_POST, 'classificationId'), # classificationId
				filter_input(INPUT_POST, 'invDescription'), # invDescription
				filter_input(INPUT_POST, 'invPrice'), # invPrice
				filter_input(INPUT_POST, 'invStock'), # invStock
				filter_input(INPUT_POST, 'invColor'), # invColor
				$DEFAULT_INVENTORY_IMAGE_PATH, # $invImage
				$DEFAULT_INVENTORY_IMAGE_PATH # $invThumbnail
			);

			if ($_FILES['invImage']){
				$imagePaths = addInventoryImages($newVehicleId, $_FILES['invImage']);
				updateVehicleImages($newVehicleId, $imagePaths['invImage'], $imagePaths['invThumbnail']);
			}

			$message = '<p class="message-success">Vehicle successfully created.</p>';

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
		case 'New':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/new.php';
			exit;
    case 'Manage':
		default:
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
	}
?>
