<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/constants.php';
  // Adds "-tn" designation to file name
  function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
  }

  function addInventoryImages($vehicleId, $invImage){
    // @TODO: error handling
    // @TODO: validate based on file extension
    global $INVENTORY_IMAGE_DIRECTORY;
    $dirPath = $_SERVER['DOCUMENT_ROOT'].$INVENTORY_IMAGE_DIRECTORY.$vehicleId;
    $pathParts = pathinfo($invImage['name']);
    $extension = $pathParts['extension'];
    $imgName = $invImage['name'];
    $name = $imgName;
    $imgPath = $dirPath.'/'.$name;
    $thumbnailPath = $dirPath.'/'.makeThumbnailName($name);
    mkdir($dirPath, 0777, true);
    copy($invImage['tmp_name'], $imgPath);
    copy($invImage['tmp_name'], $thumbnailPath);
    processImage($dirPath, $imgName);
    
    return Array(
      'invImage' => $INVENTORY_IMAGE_DIRECTORY.$vehicleId.'/'.$name,
      'invThumbnail' => $INVENTORY_IMAGE_DIRECTORY.$vehicleId.'/'.makeThumbnailName($name),
    );
  }

  // Processes images by getting paths and 
  // creating smaller versions of the image
  function processImage($dir, $filename) {
    $dir = $dir . '/';
    $image_path = $dir . $filename;
    $image_path_tn = $dir.makeThumbnailName($filename);
    resizeImage($image_path, $image_path_tn, 200, 200);
    resizeImage($image_path, $image_path, 500, 500);
  }

  // Checks and Resizes image
  function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    switch ($image_type) {
      case IMAGETYPE_JPEG:
        $image_from_file = 'imagecreatefromjpeg';
        $image_to_file = 'imagejpeg';
        break;
      case IMAGETYPE_GIF:
        $image_from_file = 'imagecreatefromgif';
        $image_to_file = 'imagegif';
        break;
      case IMAGETYPE_PNG:
        $image_from_file = 'imagecreatefrompng';
        $image_to_file = 'imagepng';
        break;
      default:
        return;
    }

    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
  
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
  
    if ($width_ratio > 1 || $height_ratio > 1) {
      $ratio = max($width_ratio, $height_ratio);
      $new_height = round($old_height / $ratio);
      $new_width = round($old_width / $ratio);
      $new_image = imagecreatetruecolor($new_width, $new_height);
    
      if ($image_type == IMAGETYPE_GIF) {
        $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagecolortransparent($new_image, $alpha);
      }
    
      if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
      }
    
      $new_x = 0;
      $new_y = 0;
      $old_x = 0;
      $old_y = 0;
      imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
      $image_to_file($new_image, $new_image_path);
      imagedestroy($new_image);
    } else {
      $image_to_file($old_image, $new_image_path);
    }
    imagedestroy($old_image);
  }
?>