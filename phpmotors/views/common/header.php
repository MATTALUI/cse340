<header>
  <div id="logo-container">
    <a href="/phpmotors">
      <img src="/phpmotors/assets/images/site/logo.png" alt="php motors logo">
    </a>
  </div>
  <a href="/phpmotors/accounts/index.php?action=Login">
    <?php
      if (isset($cookieFirstname)){
        echo $cookieFirstname.'\'s Account';
      } else {
        echo 'My Account';
      }
    ?>
  </a>
</header>