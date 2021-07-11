<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | Delete Review</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>Delete Your Review for <?php echo vehicleDisplayName($vehicle); ?></h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <p>
        <?php echo $review['reviewText']; ?>
      </p>
      <a class="button" href="/phpmotors/reviews/index.php?action=Destroy&review=<?php echo $review['reviewId'];?>" data-confirm="This will permanantly delete this review. Are you sure?">Delete</a>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>