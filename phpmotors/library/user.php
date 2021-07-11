<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/constants.php';

  function userFullName() {
    if (!$_SESSION['clientData']) {
      return 'Unknown User';
    }
    $userData = $_SESSION['clientData'];

    return $userData['clientFirstname'].' '.$userData['clientLastname'];
  }

  function userDisplayName($user) {
    // Display the "screen name" (the first initial of the first name and the complete last name, with no spaces)
    return strtoupper(substr($user['clientFirstname'], 0, 1)).'. '.$user['clientLastname'];
  }

  function hasPrivledges() {
    global $BASIC_USER;
    if (isset($_SESSION['clientData'])) {
      return intval($_SESSION['clientData']['clientLevel']) > $BASIC_USER;
    }

    return false;
  }

  function isSupervisor() {
    global $SUPERVISOR_USER;
    if (isset($_SESSION['clientData'])) {
      return $_SESSION['clientData']['clientLevel'] == $SUPERVISOR_USER;
    }

    return false;
  }

  function isAdmin() {
    global $ADMIN_USER;
    if (isset($_SESSION['clientData'])) {
      return $_SESSION['clientData']['clientLevel'] == $ADMIN_USER;
    }

    return false;
  }
?>