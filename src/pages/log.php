<?php 
  session_start();
  require_once '../config/conexao.php';
  
  if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
  } elseif (!isset($_SESSION['2fa_status']) || $_SESSION['2fa_status'] !== true) {
    header("Location: 2fa.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/responsividade.css">
  <link rel="stylesheet" href="../css/user.css">
  <link rel="stylesheet" href="../css/log.css">
  <script src="../scripts/user.js" defer></script>
  <script src="../scripts/darkmode.js" defer></script>
  <script src="../scripts/fonte.js" defer></script>
  <title>UniLivros</title>
</head>

<body>

  <?php 
    include('includes/header.php');
  ?>

  <!-- Tabela Log -->
  <section>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex flex-wrap justify-content-between p-3">
              <h2 class="fs-3 ms-2 fw-semibold">Registros</h2>
              <form action="<?= $_SERVER['PHP_SELF']?>" role="search" method="GET">
                <div class="input-group float-end">
                  <input type="search" class="form-control text-body inputSearch" placeholder="Nome do usuário ou CPF"
                    aria-label="Search" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']?>" />
                  <span class="input-group-text">
                    <button type="submit" class="searchBtn">
                      <i class="bi bi-search"></i>
                    </button>
                  </span>
                </div>
              </form>
            </div>
            <div class="card-body mt-3 px-4">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Data/Hora</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>2° Fator de Autenticação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $search = $_GET['search'] ?? '';

                    if (!empty($search)) {
                      $sql = "SELECT * FROM cadastrou WHERE nome LIKE '%$search%'";
                    } else {
                      $sql = 'SELECT * FROM cadastrou';
                    }

                    $usuarios = mysqli_query($conexao, $sql);
                    if (mysqli_num_rows($usuarios) > 0) {
                      foreach ($usuarios as $usuario) {
                  ?>
                  <tr>
                    <td><?= $usuario['data_cadastro']?></td>
                    <td><?= $usuario['id']?></td>
                    <td><?= $usuario['nome']?></td>
                    <td><?= $usuario['cpf']?></td>
                    <td>CPF</td>
                  </tr>
                  <?php 
                      }
                    } else {
                      echo '<h5>Nenhum usuário foi encontrado</h5>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php 
    include('includes/footer.php');
  ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>