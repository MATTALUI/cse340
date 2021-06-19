<div id="messages-container">
  <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']); // Removes message so that it's only displayed the first time; similar to Rails's flash messages
    }

    if (isset($message)) {
      echo $message;
    }
  ?>
</div>