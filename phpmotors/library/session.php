<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/constants.php';
	session_start();
	$userData = NULL;
	$userFirstname = NULL;

	if (isset($_SESSION['clientData'])){
		$userData = $_SESSION['clientData'];
		$userFirstname = $userData['clientFirstname'];
  }

	function getUserData() {
		if (isset($_SESSION['clientData'])){
			return $_SESSION['clientData'];
		}
		return null;
	}

	function preventUser() {
		if (getUserData()) {
			header('Location: /phpmotors/accounts/index.php?action=Admin');
			exit;
		}
	}

	function requireUserData() {
		if (!getUserData()) {
			header('Location: /phpmotors/accounts/index.php?action=Login');
			exit;
		}
	}

	function requirePrivledge(){
		requireUserData();
		global $BASIC_USER;
		$userData = getUserData();
		if ($userData['clientLevel'] == $BASIC_USER) {
			header('Location: /phpmotors');
			exit;
		}
	}

	function requireAdmin() {
		requireUserData();
		global $ADMIN_USER;
		$userData = getUserData();
		if ($userData['clientLevel'] != $ADMIN_USER) {
			header('Location: /phpmotors');
			exit;
		}
	}
?>