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
      <form action="/accounts?" method="POST">
        <fieldset>
          <legend>Account Information</legend>
          <label for="email">Email</label>
          <input id="email" name="client[clientEmail]" type="text" required/>
          <label for="password">Password</label>
          <input id="password" name="client[clientPassword]" type="password" required/>
          <label for="confirm-password">Confirm Password</label>
          <input id="confirm-password" name="confirm-password" type="password" required/>
        </fieldset>
        <fieldset>
          <legend>Personal Information</legend>
          <label for="firstname">First Name</label>
          <input id="firstname" name="client[clientFirstname]" type="text" required/>
          <label for="lastname">Last Name</label>
          <input id="lastname" name="client[clientLastname]" type="text" required/>
          <button>Register</button>
        </fieldset>
      </form> 
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
  </body>
</html>