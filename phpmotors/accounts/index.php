<?php
	/* ACCOUNTS CONTROLLER */
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/utils.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/accounts-model.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	switch ($action){
		case 'Update':
			$clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
			$clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
			$clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

			$clientData = $_SESSION['clientData'];
			$clientId = $clientData['clientId'];

			if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
				$message = '<p class="message-error">Please provide information for all empty form fields.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
				exit;
			}

			if ($clientEmail !== $clientData['clientEmail'] && checkExistingEmail($clientEmail)) {
				$message = '<p class="message-error">An account with that email already exists; you may not use it.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
				exit;
			}

			$changeCount = updateClient($clientId, $clientEmail, $clientFirstname, $clientLastname);

			if ($changeCount > 0) {
				$_SESSION['clientData']['clientEmail'] = $clientEmail;
				$_SESSION['clientData']['clientFirstname'] = $clientFirstname;
				$_SESSION['clientData']['clientLastname'] = $clientLastname;
				$_SESSION['message'] = '<p class="message-success">Your account information has been successfully updated.</p>';

				header('Location: /phpmotors/accounts/index.php?action=Admin');
			} else {
				$message = '<p class="message-error">Sorry. Something went wrong. Please try again later.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
			}

			break;
		case 'UpdatePassword':
			$clientId = $_SESSION['clientData']['clientId'];
			$clientEmail = $_SESSION['clientData']['clientEmail'];
			$clientFirstname = $_SESSION['clientData']['clientFirstname'];
			$clientLastname = $_SESSION['clientData']['clientLastname'];

			$clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
			$newPassword = trim(filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING));
			$confirmPassword = trim(filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING));

			if(empty($clientPassword) || empty($newPassword) || empty($confirmPassword)){
				$message = '<p class="message-error">Please provide information for all empty form fields.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
				exit;
			}

			if ($newPassword !== $confirmPassword) {
				$message = '<p class="message-error">New passwords do not match.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
				exit;
			}

			$clientData = getClient($clientEmail);
			$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
				
			if (!$hashCheck) {
				$message = '<p class="message-error">Unable to confirm password.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
				exit;
			}

			$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			$updateCount = updateClientPassword($clientId, $hashedPassword);

			if ($updateCount > 0) {
				$_SESSION['message'] = '<p class="message-success">Your account password successfully updated.</p>';

				header('Location: /phpmotors/accounts/index.php?action=Admin');
				exit;
			} else {
				$message = '<p class="message-error">Sorry. Something went wrong. Please try again later.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
				exit;
			}

			break;
		case 'Admin':
			requireUserData();
			require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/user.php';
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/admin.php';
			break;
		case 'Login':
			preventUser();
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
			break;
		case 'Register':
			preventUser();
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/register.php';
			break;
		case 'Edit':
			requireUserData();
			$clientFirstname = $_SESSION['clientData']['clientFirstname'];
			$clientLastname = $_SESSION['clientData']['clientLastname'];
			$clientEmail = $_SESSION['clientData']['clientEmail'];

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/edit.php';
			break;
		case 'Authenticate':
			preventUser();
			$clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
			$clientEmail = checkEmail($clientEmail);
			$clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
			$checkPassword = checkPassword($clientPassword);

			if(empty($clientEmail) || empty($checkPassword)){
				$message = '<p class="message-error">Please email and password.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
				exit;
			}

			$clientData = getClient($clientEmail);
			$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
				
			if(!$hashCheck) {
				$message = '<p class="message-error">Please check your email and password and try again.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
				exit;
			}

			$_SESSION['loggedin'] = TRUE;
			array_pop($clientData); // Remove the password from the array
			$_SESSION['clientData'] = $clientData;
			$_SESSION['message'] = '<p class="message-success">Welcome, '.$clientData['clientFirstname'].'</p>';
			header('Location: /phpmotors/accounts/index.php?action=Admin');
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

			// Check for existing email address in the table
			if (checkExistingEmail($clientEmail)) {
				$message = '<p class="message-info">That email address already exists. Do you want to login instead?</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/login.php';
				exit;
			}

			$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
			$regOutcome = registerClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
			if($regOutcome === 1){
				$_SESSION['message'] = '<p class="message-success">Thanks for registering, '.$clientFirstname.'. Please use your email and password to login.</p>';
				header('Location: /phpmotors/accounts/?action=Login');
				exit;
			} else {
				$message = '<p class="message-error">Sorry, '.$clientFirstname.', but the registration failed. Please try again.</p>';
				include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/register.php';
				exit;
			}
			break;
		case 'Logout':
			unset($_SESSION['loggedin']);
			unset($_SESSION['clientData']);
			unset($_SESSION['message']);
			session_destroy();
			$message = '<p class="message-success">Logged out. Come back soon!</p>';
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/home.php';
		default:
			goToRoot();
			exit;
	}
?>
