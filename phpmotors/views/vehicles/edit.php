<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <script src="/phpmotors/assets/js/vehicles-form.js" defer></script>
    <title>
      PHP Motors |
      <?php
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
          echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
          echo "Modify $invMake $invModel";
        }
      ?>
    </title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>
      <?php
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
          echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
          echo "Modify $invMake $invModel";
        }
      ?>
      </h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <form action="/phpmotors/vehicles/index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="Update">
        <input
          type="hidden"
          name="invId"
          <?php echo 'value="'.$invId.'"'; ?>
        />
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
          <?php buildClassificationSelect($classifications, $classificationId); ?>
          <div id="inventoryPreview" class="image-preview">
            <img src="<?php echo safeImagePath($invImage); ?>" alt="vehicle preview"/>
          </div>
          <label for="image">Upload New Image</label>
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
          <input type="submit" value="Update Vehicle">
        </fieldset>
      </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>