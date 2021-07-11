<form class="<? if (!$defaultOpenForm) { echo 'hidden'; }?>" action="/phpmotors/reviews/index.php" method="post">
  <input type="hidden" name="action" value="<?php if (isset($review)) { echo 'Update'; } else { echo 'Create'; }?>" required/>
  <input type="hidden" name="invId" <?php echo 'value="'.$vehicleId.'"'; ?>  required/>
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
    <textarea rows="6" name="reviewText" required><?php if (isset($review)) { echo $review['reviewText']; }?></textarea>
    <input type="submit" value="Save Review"/>
  </fieldset>
</form>