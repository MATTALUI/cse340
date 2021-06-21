<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>
      PHP Motors |
      <?php
        echo "Delete $invMake $invModel?";
      ?>
    </title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>
        <?php
          echo "Are you sure you want to delete $invMake $invModel?";
        ?>
      </h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <form action="/phpmotors/vehicles/index.php" method="POST">
        <input type="hidden" name="action" value="Destroy">
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
            readonly
          />
          <label for="model">Model</label>
          <input
            id="model"
            name="invModel"
            type="text"
            <?php if(isset($invModel)){echo "value='$invModel'";}  ?>
            readonly
          />
          <div id="inventoryPreview" class="image-preview">
            <img src="<?php echo safeImagePath($invImage); ?>" alt="vehicle preview"/>
          </div>
          <label for="description">Description</label>
          <textarea id="description" name="invDescription" readonly><?php if(isset($invDescription)){ echo $invDescription; }  ?></textarea>
          <input type="submit" value="Delete Vehicle">
        </fieldset>
      </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>