<?php 
  date_default_timezone_set("America/Sao_Paulo");

  $data_acesso = date("Y-m-d H:i:s");
  $id_usuario = $_SESSION['usuario_id'];
  $tipo_2fa = $_SESSION['2FA'];

  $stmt = $conexao->prepare("INSERT INTO log (id_usuario, data_acesso, tipo_2fa) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $id_usuario, $data_acesso, $tipo_2fa);
  $stmt->execute();
  $stmt->close();
?>