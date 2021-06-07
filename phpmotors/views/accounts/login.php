<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | Login</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>LOGIN</h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <form action="/phpmotors/accounts/index.php" method="POST" novalidate>
        <input type="hidden" name="action" value="Authenticate">
        <fieldset>
          <legend>Login</legend>
          <label for="email">Email</label>
          <input
            id="email"
            name="clientEmail"
            type="text"
            <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>
            required
          />
          <label for="password">Password</label>
          <input id="password" name="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/>
          <!-- These password hints and stuff were required in the activities; I don't feel like they actually belong here. -->
          <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p> 
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