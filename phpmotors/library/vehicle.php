<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/constants.php';

  function vehicleDisplayName($vehicle) {
    return $vehicle['invMake'].' '.$vehicle['invModel'];
  }

  function vehiclePrice($vehicle) {
    return '$'.number_format($vehicle['invPrice'], 2);
  }

  function buildVehiclesSelect($vehicles) {
    echo '<select id="invId" name="invId" required>';
    if (isset($vehicles)) {
      foreach ($vehicles as $inv) {
        echo '<option value="'.$inv['invId'].'" ';
        if(isset($invId) && $invId == $inv['invId']){
          echo " selected ";
        }
        echo ' >';
        echo vehicleDisplayName($inv);
        echo'</option>';
      }
    }
    echo '</select>';
  }

  function buildImagePath($vehicle){
    global $INVENTORY_IMAGE_DIRECTORY;
    
    return $INVENTORY_IMAGE_DIRECTORY.$vehicle['invId'].'/'.$vehicle['invImage'];
  }

  function buildThumbnailPath($vehicle){
    global $INVENTORY_IMAGE_DIRECTORY;
    
    return $INVENTORY_IMAGE_DIRECTORY.$vehicle['invId'].'/'.$vehicle['invThumbnail'];
  }
?>