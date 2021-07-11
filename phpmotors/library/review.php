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
?>