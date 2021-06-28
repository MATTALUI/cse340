<script src="/phpmotors/assets/js/uploads-form.js" defer></script>
<form action="/phpmotors/uploads/index.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="action" value="Create">
  <fieldset>
    <legend>Image For Vehicle</legend>
    <label for="invId">Vehicle</label>
    <?php buildVehiclesSelect($vehicles); ?>
    <p>Is this the vehicle's primary image?</p>
    <div>
      <input id="imgPrimary-Yes" name="imgPrimary" type="radio" value="1" required>
      <label for="imgPrimary-Yes">Yes</label>
    </div>
    <div>
      <input id="imgPrimary-No" name="imgPrimary" type="radio" value="0"  required>
      <label for="imgPrimary-No">No</label>
    </div>
    <div id="imagePreview" class="image-preview"></div>
    <label for="image">Select Image</label>
    <input id="image" name="invImage" type="file" required/>
    <input type="submit" value="Upload">
  </fieldset>
</form>