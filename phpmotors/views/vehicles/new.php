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
          <input
            id="make"
            name="invMake"
            type="text"
            <?php if(isset($invMake)){echo "value='$invMake'";}  ?>
            required
          />
          <label for="model">Model</label>
          <input
            id="model"
            name="invModel"
            type="text"
            <?php if(isset($invModel)){echo "value='$invModel'";}  ?>
            required
          />
          <label for="classification">Classification</label>
          <select id="classification" name="classificationId">
            <?php
              if (isset($classifications)) {
                foreach ($classifications as $classification) {
                  echo '<option value="'.$classification['classificationId'].'" ';
                  if(isset($classificationId) && $classificationId == $classification['classificationId']){
                    echo " selected ";
                  }
                  echo ' >';
                  echo $classification['classificationName'];
                  echo'</option>';
                }
              }
            ?>
          </select>
          <label for="image">Upload Image</label>
          <input id="image" name="invImage" type="file" />
          <label for="description">Description</label>
          <textarea id="description" name="invDescription"><?php if(isset($invDescription)){ echo $invDescription; }  ?></textarea>
          <label for="price">Price</label>
          <input
            id="price"
            name="invPrice"
            type="number"
            step="0.01"
            min="0"
            <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>
            required
          />
          <label for="stock">Stock</label>
          <input
            id="stock"
            name="invStock"
            type="number"
            step="1"
            min="0"
            <?php if(isset($invStock)){echo "value='$invStock'";}  ?>
            required
          />
          <label for="color">Color</label>
          <input
            id="color"
            name="invColor"
            type="text"
            <?php if(isset($invColor)){echo "value='$invColor'";}  ?>
            required
          />
          <input type="submit" value="Save">
        </fieldset>
      </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>