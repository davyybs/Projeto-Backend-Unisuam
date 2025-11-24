<?php 
  session_start();
  require_once '../config/conexao.php';
  include('../actions/log.php');

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
  <link rel="stylesheet" href="../css/log.css">
  <link rel="stylesheet" href="../css/responsividade.css">
  <link rel="stylesheet" href="../css/user.css">
  <script src="../scripts/fonte.js" defer></script>
  <script src="../scripts/user.js" defer></script>
  <script src="../scripts/darkmode.js" defer></script>
  <title>UniLivros</title>
</head>

<body>

  <?php 
    include('includes/header.php');
  ?>

  <!-- Tabela Consulta de Usuário -->
  <section>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <?php 
                if (isset($_GET['id'])) {
                  $id_usuario = mysqli_real_escape_string($conexao, $_GET['id']);
                  $sql = "SELECT * FROM cadastrou WHERE id = '$id_usuario'";
                  $query = mysqli_query($conexao, $sql);

                  if (mysqli_num_rows($query) > 0) {
                    $usuario = mysqli_fetch_array($query);
              ?>
            <div class="card-header d-flex justify-content-between align-items-center p-3">
              <h2 class="fs-3 ms-2 fw-semibold text-primary-emphasis"><?= $usuario['nome']?></h2>
              <a href="consulta_usuario.php" class="btn btn-secondary btn-lg">Voltar</a>
            </div>
            <div class="card-body p-4">

              <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Nome Materno</label>
                  <p class="form-control"><?= $usuario['nomeM']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Data de Nascimento</label>
                  <p class="form-control"><?= date('d/m/Y', strtotime($usuario['data_nasc']))?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">CPF</label>
                  <p class="form-control"><?= $usuario['cpf']?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Sexo</label>
                  <p class="form-control"><?= $usuario['sexo']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Telefone Celular</label>
                  <p class="form-control"><?= $usuario['celular']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">CEP</label>
                  <p class="form-control"><?= $usuario['cep']?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Estado</label>
                  <p class="form-control"><?= $usuario['estado']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Cidade</label>
                  <p class="form-control"><?= $usuario['cidade']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Bairro</label>
                  <p class="form-control"><?= $usuario['bairro']?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Rua</label>
                  <p class="form-control"><?= $usuario['rua']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Número</label>
                  <p class="form-control"><?= $usuario['numero']?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                  <label class="form-label">Complemento</label>
                  <p class="form-control"><?= $usuario['complemento']?></p>
                </div>
              </div>
              <?php 
                  } else {
                    echo '<h5>Usuário não encontrado</h5>';
                  }
                }
              ?>
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