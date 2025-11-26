<?php 
  if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
  } elseif (!isset($_SESSION['2fa_status']) || $_SESSION['2fa_status'] !== true) {
    header("Location: 2fa.php");
    exit;
  }
?>