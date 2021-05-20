<?php
  function addInventoryImages($vehicleId, $invImage){
    $dir_path = $_SERVER['DOCUMENT_ROOT'].'/phpmotors/assets/images/vehicles/'.$vehicleId;
    $name = $invImage['name'];
    $img_path = $dir_path.'/'.$name;
    mkdir($dir_path, 0777, true);
    copy($invImage['tmp_name'], $img_path);
    
    return Array(
      'invImage' => '/assets/images/vehicles/'.$vehicleId.'/'.$name,
      'invThumbnail' => '/assets/images/vehicles/'.$vehicleId.'/'.$name,
    );
  }
?>