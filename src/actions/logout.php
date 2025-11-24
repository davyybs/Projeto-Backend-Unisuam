<?php
  session_start();
  session_unset();
  session_destroy();
  header("Location: /Projeto-Backend-Unisuam/index.php");
  exit;
?>