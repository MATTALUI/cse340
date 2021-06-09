<header>
  <div id="logo-container">
    <a href="/phpmotors">
      <img src="/phpmotors/assets/images/site/logo.png" alt="php motors logo">
    </a>
  </div>
  <span>
    <?php
      $action = 'Login';
      $text = 'My Account';
      if (isset($userFirstname)){
        $action = 'Admin';
        $text = $userFirstname.'\'s Account';
      }
      echo '<a href="/phpmotors/accounts/index.php?action='.$action.'">'.$text.'</a>';
      if (isset($userFirstname)){
        echo '<span class="horsep">|</span>';
        echo '<a href="/phpmotors/accounts/index.php?action=Logout">Logout</a>';
      }
    ?>
  </span>
</header>