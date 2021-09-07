<?php
	/* REVIEWS CONTROLLER */
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/common.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/classifications-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/vehicles-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/vehicle.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/review.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/user.php';

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
	}

	$classifications = getClassifications();

	requireUserData();
	switch ($action){
		case 'Create':
			$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
			$reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
			$clientId = getUserData()['clientId'];

			if (empty($invId) || empty($reviewText) || empty($clientId)) {
				// @NOTE: We're checking all of these fields simply out of an over-abundance of
				// caution. Really, only the $reviewText is user-facing and will likely be the only
				// one to be left blank short of some monkey-business.
				$_SESSION['message'] = '<p class="message-error">Please fill out all required review fields.</p>';
				header('location: /phpmotors/vehicles/index.php?action=Show&vehicleId='.$invId);
				exit;
			}
			
			$reviewsCreated = createReview($reviewText, $invId, $clientId);

			if ($reviewsCreated > 0) {
				$_SESSION['message'] = '<p class="message-success">Your review was saved successfully.</p>';
			} else {
				$_SESSION['message'] = '<p class="message-error">Something went wrong; we were unable to save your review.</p>';
			}
			header('location: /phpmotors/vehicles/index.php?action=Show&vehicleId='.$invId);
			
			break;
		case 'Update':
			$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
			$reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
			$clientId = getUserData()['clientId'];

			if (empty($invId) || empty($reviewText) || empty($clientId)) {
				// @NOTE: We're checking all of these fields simply out of an over-abundance of
				// caution. Really, only the $reviewText is user-facing and will likely be the only
				// one to be left blank short of some monkey-business.
				$_SESSION['message'] = '<p class="message-error">Please fill out all required review fields.</p>';
				header('location: /phpmotors/vehicles/index.php?action=Show&vehicleId='.$invId);
				exit;
			}

			$review = getReviewFromUserForVehicle($clientId, $invId);
			$reviewId = $review['reviewId'];
			protectReview($review);
			
			$reviewsUpdated = updateReview($reviewId, $reviewText);

			if ($reviewsUpdated > 0) {
				$_SESSION['message'] = '<p class="message-success">Your review was saved successfully.</p>';
				header('location: /phpmotors/vehicles/index.php?action=Show&vehicleId='.$invId);
			} else {
				$_SESSION['message'] = '<p class="message-error">Something went wrong; we were unable to save your review.</p>';
				header('location: /phpmotors/reviews/index.php?action=Edit&review='.$reviewId);
			}
			break;
		case 'Destroy':
			$reviewId = filter_input(INPUT_GET, 'review', FILTER_SANITIZE_NUMBER_INT);
			$review = getReview($reviewId);
			protectReview($review);
			$reviewsDeleted = deleteReview($reviewId);

			if ($reviewsDeleted > 0) {
				$_SESSION['message'] = '<p class="message-success">Your review was deleted successfully.</p>';
			} else {
				$_SESSION['message'] = '<p class="message-error">Something went wrong; we were unable to delete your review.</p>';
			}

			header('location: /phpmotors/vehicles/index.php?action=Show&vehicleId='.$review['invId']);
			break;
		case 'Edit':
			$reviewId = filter_input(INPUT_GET, 'review', FILTER_SANITIZE_NUMBER_INT);
			$review = getReview($reviewId);
			protectReview($review);
			$vehicleId = $review['invId'];
			$vehicle = getInvItemInfo($vehicleId);
			$defaultOpenForm = true;

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/reviews/edit.php';
			break;
		case  'Manage':
			$clientId = getUserData()['clientId'];
			$reviews = getUsersReviews($clientId);

			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/reviews/manage.php';
			break;
		case 'Delete':
			// @NOTE: This view is required in the AC. Ideally we wouldn't need it since
			// this can be done slightly less annoyingly using a JS alert.
			$reviewId = filter_input(INPUT_GET, 'review', FILTER_SANITIZE_NUMBER_INT);
			$review = getReview($reviewId);
			protectReview($review);
			$vehicleId = $review['invId'];
			$vehicle = getInvItemInfo($vehicleId);
	
			include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/reviews/delete.php';
			break;
		default:
			header('location: /phpmotors/accounts/index.php?action=Admin');
	 }
?>
