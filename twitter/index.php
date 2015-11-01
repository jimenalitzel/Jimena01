<?php

session_start();

 ?>

<html>

  <body>
    <h2>Hello <?=(!empty($_SESSION['username']) ? '@' . $_SESSION['username'] : 'Guest'); ?></h2>
    <a href="./redirect.php">Log in with Twitter</a>
  </body>
</html>