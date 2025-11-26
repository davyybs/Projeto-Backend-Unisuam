<?php 
  session_start();
  require '../config/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../scripts/darkmode.js" defer></script>
  <script src="../scripts/fonte.js" defer></script>
  <script src="../scripts/user.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/user.css">
  <link rel="stylesheet" href="../css/livros.css">
  <title>UniLivros | Gerenciar Livros</title>
</head>

<body>

  <!-- Header -->
   <?php 
    include('includes/header.php');
  ?>
  <!-- Conteúdo principal -->
  <section>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex flex-wrap justify-content-between p-3">
              <h2 class="fs-3 ms-2 fw-semibold">Gerenciar Livros</h2>

              <a href="../pdf/gerar_pdf.php" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Baixar PDF
              </a>

              <form action="<?= $_SERVER['PHP_SELF']?>" role="search" method="GET">
                <div class="input-group float-end">
                  <input type="search" class="form-control text-body inputSearch" placeholder="Título ou Autor"
                    name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']?>" />
                  <span class="input-group-text">
                    <button type="submit" class="searchBtn">
                      <i class="bi bi-search"></i>
                    </button>
                  </span>
                </div>
              </form>
            </div>

             <div class="card-body mt-3 px-4">
                <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Páginas</th>
                    <th>Edição</th>
                    <th>Ano</th>
                    <th>Capa</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                    $search = $_GET['search'] ?? '';

                    if (!empty($search)) {
                      $sql = "SELECT * FROM livros WHERE titulo LIKE '%$search%' OR autor LIKE '%$search%'";
                    } else {
                      $sql = "SELECT * FROM livros";
                    }

                    $result = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      while ($livro = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td><?= $livro['id']?></td>
                    <td><?= $livro['isbn']?></td>
                    <td><?= $livro['titulo']?></td>
                    <td><?= $livro['autor']?></td>
                    <td><?= $livro['genero']?></td>
                    <td><?= $livro['paginas']?></td>
                    <td><?= $livro['edicao']?></td>
                    <td><?= $livro['ano_publicacao']?></td>

                    <!-- Capa -->
                    <td>
                      <?php 
                        $capa = $livro['capa'];
                        if (!empty($capa)):
                          if (preg_match('/^https?:\/\//', $capa)): ?>
                            <a href="<?= htmlspecialchars($capa) ?>" target="_blank">
                              <img src="<?= htmlspecialchars($capa) ?>" width="60" height="80" class="rounded shadow-sm">
                            </a>
                          <?php else: ?>
                            <img src="../uploads/<?= htmlspecialchars($capa) ?>" width="60" height="80" class="rounded shadow-sm">
                          <?php endif;
                        else: ?>
                          <span class="text-muted">Sem capa</span>
                      <?php endif; ?>
                    </td>

                    <td><?= $livro['quantidade']?></td>

                    <!-- BOTÕES -->
                    <td class="d-flex gap-2 justify-content-center">

                      <!-- EDITAR -->
                      <a href="editar_livros.php?id=<?= $livro['id'] ?>" 
                        class="btn btn-warning btn-sm">
                        Editar
                      </a>

                      <!-- EXCLUIR -->
                    <a href="../actions/excluir_livro.php?id=<?= $livro['id'] ?>" 
                    onclick="return confirm('Tem certeza que deseja excluir este livro?')"
                     class="btn btn-danger btn-sm">
                     Excluir
                    </a>
                    </td>
                  </tr>
                  <?php 
                      } 
                    } else {
                      echo '<tr><td colspan="11" class="text-center py-3 text-muted">Nenhum livro encontrado</td></tr>';
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

  <!-- Footer -->
  <footer class="d-flex bg-body mt-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
          <a href="/Projeto-Backend-Unisuam/index.php"
            class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
            <img src="../images/logoC.png" alt="Logo UniLivros" class="logoImgFooter" id="imagemTema">
          </a>
          <p class="text-body-secondary">&copy; 2025 UniLivros. Todos os direitos reservados.</p>
        </div>

        <div class="col mb-3"></div>

        <div class="col mb-3">
          <h5>Seções</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="/Projeto-Backend-Unisuam/index.php" class="nav-link p-0">Home</a></li>
            <li class="nav-item mb-2"><a href="modeloBD.php" class="nav-link p-0">Modelo de BD</a></li>
            <li class="nav-item mb-2"><a href="cadastro_livro.php" class="nav-link p-0">Cadastrar Livro</a></li>
            <li class="nav-item mb-2"><a href="editar_livros.php" class="nav-link p-0">Gerenciar Livros</a></li>
          </ul>
        </div>

        <div class="col mb-3">
          <h5>Redes Sociais</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><i class="bi bi-instagram"> @unilivros</i></a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><i class="bi bi-tiktok"> @_unilivros</i></a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><i class="bi bi-youtube"> /@unilivrosyt</i></a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><i class="bi bi-twitter-x"> @unilivros</i></a></li>
          </ul>
        </div>

      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

</body>

</html>
