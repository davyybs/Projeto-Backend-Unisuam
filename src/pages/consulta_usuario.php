<?php 
  session_start();
  require_once '../config/conexao.php';
  
  if (isset($_SESSION['usuario_id'])) {
    include('../actions/log.php');
  }
  
  include('../actions/loginVerify.php');
  include('../actions/admin.php');

  // ======================
  // PROCESSAR EXCLUSÃO
  // ======================
  $mensagem = "";

  if (isset($_POST['delete_id'])) {

      $id = intval($_POST['delete_id']);

      $stmt = $conexao->prepare("DELETE FROM cadastrou WHERE id = ?");
      $stmt->bind_param("i", $id);

      if ($stmt->execute()) {
          $mensagem = "Usuário excluído com sucesso!";
      } else {
          $mensagem = "Erro ao excluir usuário!";
      }

      $stmt->close();
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
  <link rel="stylesheet" href="../css/fonte.css">
  <script src="../scripts/fonte.js" defer></script>
  <script src="../scripts/user.js" defer></script>
  <script src="../scripts/darkmode.js" defer></script>
  <title>UniLivros</title>
</head>

<body>

  <?php 
    include('includes/header.php');
  ?>

  <!-- ==========================
      MODAL DE CONFIRMAÇÃO
  ========================== -->
  <div class="modal fade" id="modalExcluir" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          Tem certeza que deseja excluir este usuário?
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

          <form method="POST">
            <input type="hidden" id="delete_id" name="delete_id">
            <button type="submit" class="btn btn-danger">Excluir</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- ==========================
      MODAL DE MENSAGEM
  ========================== -->
  <?php if (!empty($mensagem)) { ?>
  <div class="modal fade show" id="modalMensagem" style="display:block; background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
          <h4 class="mb-3"><?= $mensagem ?></h4>
          <button class="btn btn-primary" onclick="window.location='consulta_usuario.php'">
              OK
          </button>
      </div>
    </div>
  </div>
  <?php } ?>

  <!-- Tabela Consulta de Usuário -->
  <section>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex flex-wrap justify-content-between p-3">
              <h2 class="fs-3 ms-2 fw-semibold">Usuários</h2>
              <form action="<?= $_SERVER['PHP_SELF']?>" role="search" method="GET">
                <div class="input-group float-end">
                  <input type="search" class="form-control text-body inputSearch" placeholder="Nome do usuário ou CPF"
                    aria-label="Search" name="search"
                    value="<?php if(isset($_GET['search'])) echo $_GET['search'];?>" />
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
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
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
                    <td><?= $usuario['id']?></td>
                    <td><?= $usuario['nome']?></td>
                    <td><?= $usuario['cpf']?></td>
                    <td><?= date('d/m/Y', strtotime($usuario['data_nasc']))?></td>
                    <td>
                      <a href=" visualizar_usuario.php?id=<?=$usuario['id']?>" class="btn btn-secondary"><i
                          class="bi bi-eye-fill"></i> Visualizar</a>
                      <a href="editar_usuario.php?id=<?= $usuario['id']?>" class="btn btn-success">
                        <i class="bi bi-pencil-fill"></i> Editar
                      </a>

                      <button class="btn btn-danger"
                              onclick="abrirModalExcluir(<?= $usuario['id']?>)">
                        <i class="bi bi-trash-fill"></i> Excluir
                      </button>
                    </td>
                  </tr>
                  <?php 
                      }
                    } else {
                      echo '<td colspan="5" class="text-center py-3 text-muted">Nenhum usuário foi encontrado</td>';
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
  <script>
  function abrirModalExcluir(id) {
    document.getElementById('delete_id').value = id;
    let modal = new bootstrap.Modal(document.getElementById('modalExcluir'));
    modal.show();
  }
</script>

</body>

</html>