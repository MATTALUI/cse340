<div id="vehicleReviews">
  <div>
    <h2>Vehicle Reviews</h2>
    <?php
      if (!isset($_SESSION['clientData'])) {
        echo '<a href="/phpmotors/accounts/index.php?action=Login">Log In to Add a Review</a>';
      } else if (!$userReviewed){
        echo '<a id="reviewTrigger" href="#" aria-role="button">Add Review</a>';
      }
    ?>
  </div>
  <?php
    if (isset($_SESSION['clientData']) && !$userReviewed) {
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/reviews/_form.php';
    }
  ?>
  <div>
    <?php buildReviews($reviews); ?>
  </div>
</div>