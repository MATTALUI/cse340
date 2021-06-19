<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/shared_head.php'; ?>
    <title>PHP Motors | Manage Account</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/nav.php'; ?>
    <main>
      <h1>Manage Account</h1>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/messages.php'; ?>
      <section>
        <h2>Update Account Information</h2>
        <form>
          <input type="hidden" name="action" value="Update" />
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
            <input type="submit" value="Update Account Information">
          </fieldset>
        </form>
      </section>
      <section>
        <h2>Update Account Password</h2>
        <form>
          <input type="hidden" name="action" value="UpdatePassword" />
          <fieldset>
            <legend>Password Information</legend>
            <label for="password">Current Password</label>
            <input id="password" name="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/>
            <label for="new-password">New Password</label>
            <input id="new-password" name="new-password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/>
            <label for="confirm-password">Confirm Password</label>
            <input id="confirm-password" name="confirm-password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/>
            <input type="submit" value="Update Password">
          </fieldset>
        </form>
      </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/views/common/footer.php'; ?>
  </body>
</html>