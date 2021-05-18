<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="/phpmotors/assets/css/main.css" media="screen">
    <link rel="icon" href="/phpmotors/assets/images/site/logo.png">
    <script src="/phpmotors/assets/js/main.js" defer></script>
    <title>PHP Motors | Login</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>LOGIN</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form action="/accounts?" method="POST">
        <fieldset>
          <legend>Login</legend>
          <label for="email">Email</label>
          <input id="email" name="client[clientEmail]" type="text" required/>
          <label for="password">Password</label>
          <input id="password" name="client[clientPassword]" type="password" required/>
          <button>Login</button>
        </fieldset>
      </form>
      <p>
        Not a member of the PHPMotors community?
        <a href="/phpmotors/accounts/index.php?action=Register">Register here for free!</a>
      </p>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>