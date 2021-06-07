<?php
	session_start();
	if (isset($_SESSION['clientData'])){
		$clientData = $_SESSION['clientData'];
		$cookieFirstname = $clientData['clientFirstname'];
  } else if(isset($_COOKIE['firstname'])){
		$cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
	}
?>