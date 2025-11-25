<?php 
  session_start();
  require_once '../config/conexao.php';
  
  if (isset($_SESSION['usuario_id'])) {
    include('src/actions/log.php');
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset=" UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/responsividade.css">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/index.css">
  <script src="../scripts/fonte.js" defer></script>
  <script src="../scripts/user.js" defer></script>
  <script src="../scripts/darkmode.js" defer></script>
  <title>UniLivros</title>
</head>

<body>

  <?php 
    include('includes/header.php');
  ?>

  <main class="m-3">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center p-4">
        <img src="../images/MER.png" alt="Modelo Conceitual do Banco de Dados"
          class="w-75 border border-secondary border-4 p-4">
      </div>
    </div>
  </main>

  <?php 
    include('includes/footer.php');
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>