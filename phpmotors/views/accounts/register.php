<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
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
          <input
            id="email"
            name="clientEmail"
            type="text"
            <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>
            required
          />
          <label for="password">Password</label>
          <input id="password" name="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/>
          <label for="confirm-password">Confirm Password</label>
          <input id="confirm-password" name="confirm-password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/>
          <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p> 
        </fieldset>
        <fieldset>
          <legend>Personal Information</legend>
          <label for="firstname">First Name</label>
          <input
            id="firstname"
            name="clientFirstname"
            type="text"
            <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>
            required
          />
          <label for="lastname">Last Name</label>
          <input
            id="lastname"
            name="clientLastname"
            type="text"
            <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>
            required
          />
          <input type="submit" value="Register">
        </fieldset>
      </form> 
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>