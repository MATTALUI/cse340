<!-- CLASSIFICATIONS CONTROLLER -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/accounts-model.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'Create':
			$classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

			if(empty($classificationName)){
				$message = '<p class="message-error">Please provide classification name.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/classifications/new.php';
				exit;
			}

			$regOutcome = createClassification($classificationName);
			if($regOutcome === 1){
				$classifications = getClassifications();
				$message = '<p class="message-success">Classification '.$classificationName.' created successfully.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/vehicles/manage.php';
				exit;
			} else {
				$message = '<p class="message-error">Sorry, but the creation failed. Please try again.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/classifications/new.php';
				exit;
			}
			exit;
		case 'New':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/classifications/new.php';
			break;
		default:
			if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
				$uri = 'https://';
			} else {
				$uri = 'http://';
			}
			$uri .= $_SERVER['HTTP_HOST'];
			header('Location: '.$uri.'/phpmotors/index.php');
			exit;
	}
?>