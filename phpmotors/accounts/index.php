<!-- ACCOUNTS CONTROLLER -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'Login':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/login.php';
			break;
		case 'Register':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/register.php';
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
