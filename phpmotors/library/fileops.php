<?php
  function addInventoryImages($vehicleId, $invImage){
    // @TODO: error handling
    // @TODO: validate based on file extension
    // @TODO: create thumbnail from original
    $dir_path = $_SERVER['DOCUMENT_ROOT'].'/phpmotors/assets/images/vehicles/'.$vehicleId;
    $path_parts = pathinfo($invImage['name']);
    $extension = $path_parts['extension'];
    $name = 'img.'.$extension;
    $img_path = $dir_path.'/'.$name;
    mkdir($dir_path, 0777, true);
    copy($invImage['tmp_name'], $img_path);
    
    return Array(
      'invImage' => '/assets/images/vehicles/'.$vehicleId.'/'.$name,
      'invThumbnail' => '/assets/images/vehicles/'.$vehicleId.'/'.$name,
    );
  }
?>