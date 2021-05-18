<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>in.js" defer></script>
    <title>PHP Motors | Register</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>REGISTER</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form action="/phpmotors/accounts/index.php" method="POST">
        <input type="hidden" name="action" value="Create">
        <fieldset>
          <legend>Account Information</legend>
          <label for="email">Email</label>
          <input id="email" name="clientEmail" type="text" required/>
          <label for="password">Password</label>
          <input id="password" name="clientPassword" type="password" required/>
          <label for="confirm-password">Confirm Password</label>
          <input id="confirm-password" name="confirm-password" type="password" required/>
        </fieldset>
        <fieldset>
          <legend>Personal Information</legend>
          <label for="firstname">First Name</label>
          <input id="firstname" name="clientFirstname" type="text" required/>
          <label for="lastname">Last Name</label>
          <input id="lastname" name="clientLastname" type="text" required/>
          <input type="submit" value="Register">
        </fieldset>
      </form> 
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>