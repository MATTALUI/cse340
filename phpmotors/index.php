<!-- ROOT CONTROLLER -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicles-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/vehicle.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'cats': # Just a nonsense case to fill for future work
			break;
		default:
			// @NOTE: The AC just said to display the delorean, but if there's not
			// one in the DB it could br problematic. Some extra logic is included
			// in the view to protect from that situation.
			$featuredVehicle = getDelorean();

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/home.php';
	 }
?>
