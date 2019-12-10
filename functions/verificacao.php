<?php
    if (!$_SESSION['email']) {
      header('location: ../templates/login.php');
      exit();
    }
?>
