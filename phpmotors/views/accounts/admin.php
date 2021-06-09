<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | Admin</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>
        <?php echo userFullName(); ?>
      </h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <p>You are logged in.</p>
      <ul>
        <li><?php echo 'First Name: '.$userData['clientFirstname']; ?></li>
        <li><?php echo 'Last Name: '.$userData['clientLastname']; ?></li>
        <li><?php echo 'Email: '.$userData['clientEmail']; ?></li>
      </ul>
      <?php
        if (hasPrivledges()) {
          include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/accounts/_admin_panel.php';
        }
      ?>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>