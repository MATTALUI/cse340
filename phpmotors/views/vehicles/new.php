<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | New vehicle</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>New Vehicle</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form action="/phpmotors/vehicles/index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="Create">
        <fieldset>
          <legend>Vehicle</legend>
          <label for="make">Make</label>
          <input id="make" name="invMake" type="text" required/>
          <label for="model">Model</label>
          <input id="model" name="invModel" type="text" required/>
          <label for="classification">Classification</label>
          <select id="classification" name="classificationId">
            <?php
              if (isset($classifications)) {
                foreach ($classifications as $classification) {
                  echo '<option value="'.$classification['classificationId'].'">'.$classification['classificationName'].'</option>';
                }
              }
            ?>
          </select>
          <label for="image">Upload Image</label>
          <input id="image" name="invImage" type="file" />
          <label for="description">Description</label>
          <textarea id="description" name="invDescription"></textarea>
          <label for="price">Price</label>
          <input id="price" name="invPrice" type="number" step="0.01" min="0" required/>
          <label for="stock">Stock</label>
          <input id="stock" name="invStock" type="number" step="1" min="0" required/>
          <label for="color">Color</label>
          <input id="color" name="invColor" type="text" required/>
          <input type="submit" value="Save">
        </fieldset>
      </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>