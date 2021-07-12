<form class="<? if (!$defaultOpenForm) { echo 'hidden'; }?>" action="/phpmotors/reviews/index.php" method="post">
  <input type="hidden" name="action" value="<?php if (isset($review)) { echo 'Update'; } else { echo 'Create'; }?>" />
  <input type="hidden" name="invId" <?php echo 'value="'.$vehicleId.'"'; ?> />
  <fieldset>
    <legend>
      <?php
        if (isset($review)) {
          echo 'Edit Review';
        } else {
          echo 'New Review';
        }
      ?>
    </legend>
    <label for="name">Reviewing As</label>
    <input id="name" name="name" type="text" value="<?php echo userDisplayName($_SESSION['clientData']); ?>" readonly />
    <label for="reviewText" class="hidden">Review Text</label>
    <textarea id="reviewText" rows="6" name="reviewText" required><?php if (isset($review)) { echo $review['reviewText']; }?></textarea>
    <input type="submit" value="Save Review"/>
  </fieldset>
</form>