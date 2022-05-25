<?php
  session_start();
  session_destroy();
  header('Location: hw_login.php');
?>