<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | New Classification</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>New Classification</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form action="/phpmotors/classifications/index.php" method="POST">
        <input type="hidden" name="action" value="Create">
        <fieldset>
          <legend>Classification</legend>
          <label for="name">Name</label>
          <input id="name" name="classificationName" type="text" required/>
          <input type="submit" value="Register">
        </fieldset>
      </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>