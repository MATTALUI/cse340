<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <link rel="stylesheet" href="/phpmotors/assets/css/uploads.css" media="screen">
    <title>PHP Motors | Uploads</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>Manage Uploads</h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <h2>New Upload</h2>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/uploads/_form.php'; ?>
      <hr/>
      <h2>All Uploads</h2>
      <p>Use the following links in order to delete images for a vehicle. Please remember to delete thumnails for images and images for thumbnails.</p>
      <div class="grid">
        <?php buildImageDisplay($images); ?>
      </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>