<!-- ROOT CONTROLLER -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'cats': # Just a nonsense case to fill for future work
			break;
		default:
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/home.php';
	 }
?>
