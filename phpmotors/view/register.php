<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
    <link rel="icon" href="/phpmotors/images/site/logo.png">
    <script src="/phpmotors/js/main.js" defer></script>
    <title>PHP Motors | Register</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php'; ?>
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
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
  </body>
</html>