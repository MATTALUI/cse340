<?php
  if(isset($_COOKIE['firstname'])){
		$cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
	}
?>