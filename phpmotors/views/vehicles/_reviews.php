<div id="vehicleReviews">
  <div>
    <h2>Vehicle Reviews</h2>
    <?php
      if (!$userReviewed) {
        echo '<a id="reviewTrigger" href="#" aria-role="button">Add Review</a>';
      }
    ?>
  </div>
  <?php
    if (!$userReviewed) {
      include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/reviews/_form.php';
    }
  ?>
  <div>
    <?php buildReviews($reviews); ?>
  </div>
</div>