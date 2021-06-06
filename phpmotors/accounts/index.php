<!-- ACCOUNTS CONTROLLER -->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/utils.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/accounts-model.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'Login':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
			break;
		case 'Register':
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/register.php';
			break;
		case 'Authenticate':
				$clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
				$clientEmail = checkEmail($clientEmail);
				$clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
				$checkPassword = checkPassword($clientPassword);

				if(empty($clientEmail) || empty($checkPassword)){
					$message = '<p class="message-error">Please email and password.</p>';
					include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
					exit;
				}
				echo "success";

			break;
		case 'Create':
			$clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
			$clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
			$clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
			$clientEmail = checkEmail($clientEmail);
			$clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
			$checkPassword = checkPassword($clientPassword);
			$confirmPassword = trim(filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_STRING));

			if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
				$message = '<p class="message-error">Please provide information for all empty form fields.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/register.php';
				exit;
			}

			if($confirmPassword != $clientPassword){
				$message = '<p class="message-error">Password and Password Confirmation must match.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/register.php';
				exit;
			}

			$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
			$regOutcome = registerClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
			if($regOutcome === 1){
				$message = '<p class="message-success">Thanks for registering, '.$clientFirstname.'. Please use your email and password to login.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
				exit;
			} else {
				$message = '<p class="message-error">Sorry, '.$clientFirstname.', but the registration failed. Please try again.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/register.php';
				exit;
			}
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
