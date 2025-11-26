<?php 
  $idUsuario = $_SESSION['usuario_id'];
  $sql = "SELECT tipo_usuario FROM cadastrou WHERE id = '$idUsuario'";
  $query = mysqli_query($conexao, $sql);
  $tipo_usuario = mysqli_fetch_assoc($query);

  if ($tipo_usuario['tipo_usuario'] !== 'admin') {
    header("Location: /Projeto-Backend-Unisuam/index.php");
    exit;
  }
?>