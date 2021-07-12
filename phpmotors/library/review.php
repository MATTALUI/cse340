<?php
  function checkReviewPermissions($review) {
    // @TODO: Probably at some point we could take user levels into permissions;
    // an admin should be able to delete troll reviews.
    return isset($_SESSION['clientData']) &&
      !empty($review) &&
      $review['clientId'] === $_SESSION['clientData']['clientId'];
  }

  function protectReview($review) {
    if (!checkReviewPermissions($review)) {
      // You don't get to mess with a review that doesn't exist or that's not yours! GET OUTTTA HERE!
      goToRoot();
    }
  }

  function buildReviewerDisplayName($review) {
    // Display the "screen name" (the first initial of the first name and the complete last name, with no spaces)
    return strtoupper(substr($review['reviewerFirstname'], 0, 1)).'. '.$review['reviewerLastname'];
  }

  function formatReviewDate($review) {
    // https://www.php.net/manual/en/datetime.format.php
    $format = 'l, F j Y';
    return date($format, strtotime($review['reviewDate']));
  }

  function formatReviewVehicleName($review) {
    return $review['invMake'].' '.$review['invModel'];
  }
?>