<?php
session_start();
include_once "src/config/conexao.php";

if (isset($_SESSION['usuario_id'])) {
    include('src/actions/log.php');
}

$sql = "SELECT * FROM livros ORDER BY id DESC";
$result = $conexao->query($sql);
$livros = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $livros[] = $row;
  }
}


$sqlCapas = "SELECT capa FROM livros ORDER BY RAND() LIMIT 3";
$resultCapas = $conexao->query($sqlCapas);

$capas = [];
if ($resultCapas && $resultCapas->num_rows > 0) {
  while ($c = $resultCapas->fetch_assoc()) {
    if (filter_var($c['capa'], FILTER_VALIDATE_URL)) {
      $capas[] = $c['capa'];
    } else {
      $capas[] = "src/uploads/" . $c['capa'];
    }
  }
}


while (count($capas) < 3) {
  $capas[] = "src/images/default.jpg";
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="src/css/user.css">
  <link rel="stylesheet" href="src/css/index.css">
  <script src="src/scripts/fonte.js" defer></script>
  <script src="src/scripts/index.js" defer></script>
  <script src="src/scripts/darkmode.js" defer></script>
  <script src="src/scripts/user.js" defer></script>
  <title>UniLivros</title>
</head>
<body>

<!-- Header -->
<?php 
    include('src/pages/includes/header.php');
  ?>

<!-- HERO -->
<section class="hero">
  <div class="container px-4 py-3" id="custom-cards">
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5 cardH">
      <?php foreach ($capas as $i => $capa): ?>
        <div class="col">
          <a href="#<?= ['lancamentos','populares','recomendacoes'][$i] ?>" class="link-underline-opacity-0">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                 style="background-image: url('<?= $capa ?>'); background-size: cover; background-position: center;">
              <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1"
                   style="backdrop-filter: brightness(0.5); background: rgba(0,0,0,0.3);">
                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
                  <?= ['Lançamentos','Populares no momento','Recomendações'][$i] ?>
                </h3>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <hr>
  </div>
</section>

<!-- CONTEÚDO -->
<section class="conteudo">
  <div class="container">

    <?php
    $secoes = ['lancamentos'=>'Lançamentos','populares'=>'Populares no momento','recomendacoes'=>'Recomendações'];
    foreach ($secoes as $id => $titulo): ?>
      <div class="<?= $id ?> mb-4" id="<?= $id ?>">
        <h2 class="text-primary-emphasis fs-3 fw-semibold nav-link mb-4">
          <span class="text-primary fs-3">|</span> <?= $titulo ?>
        </h2>
        <div class="livros-container-wrapper">
          <button class="seta seta-esquerda" aria-label="Ver anteriores"><i class="bi bi-chevron-left"></i></button>
          <div class="livros-container" role="list">
            <?php if (!empty($livros)): ?>
              <?php foreach ($livros as $livro): ?>
                <div class="livro-card" role="listitem">
                  <div class="card livro-card-inner shadow-sm">
                    <?php if (!empty($livro['capa'])): ?>
                      <img src="<?= filter_var($livro['capa'], FILTER_VALIDATE_URL) ? $livro['capa'] : "src/uploads/".$livro['capa'] ?>" alt="Capa do livro" class="livro-capa">
                    <?php else: ?>
                      <div class="livro-capa no-img d-flex align-items-center justify-content-center">
                        <span class="text-muted">Sem capa</span>
                      </div>
                    <?php endif; ?>
                    <div class="p-3">
                      <strong class="d-inline-block mb-2 text-success-emphasis">Livro</strong>
                      <h4 class="mb-1 fw-bold" style="font-size: 1.1rem;"><?= htmlspecialchars($livro['titulo']) ?></h4>
                      <p class="text-secondary mb-2"><?= htmlspecialchars($livro['autor']) ?></p>
                      <p class="descricao-curta"><?= htmlspecialchars($livro['descricao']) ?></p>
                      <button 
                        class="btn btn-link p-0 saiba-mais"
                        data-id="<?= $livro['id'] ?>"
                        data-titulo="<?= htmlspecialchars($livro['titulo']) ?>"
                        data-autor="<?= htmlspecialchars($livro['autor']) ?>"
                        data-descricao="<?= htmlspecialchars($livro['descricao']) ?>"
                        data-genero="<?= htmlspecialchars($livro['genero']) ?>"
                        data-ano="<?= htmlspecialchars($livro['ano_publicacao']) ?>"
                        data-paginas="<?= htmlspecialchars($livro['paginas']) ?>"
                        data-edicao="<?= htmlspecialchars($livro['edicao']) ?>"
                        data-quantidade="<?= htmlspecialchars($livro['quantidade']) ?>"
                        data-capa="<?= !empty($livro['capa']) ? (filter_var($livro['capa'], FILTER_VALIDATE_URL) ? $livro['capa'] : 'src/uploads/'.$livro['capa']) : 'src/images/default.jpg' ?>"
                      >
                        Saiba mais
                      </button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted">Nenhum livro cadastrado ainda.</p>
            <?php endif; ?>
          </div>
          <button class="seta seta-direita" aria-label="Ver próximos"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- MODAL DETALHES -->
 
<div class="modal fade" id="modalLivro" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitulo"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body row">
        <div class="col-md-4">
          <img id="modalCapa" src="" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-8">
          <p><strong>Autor:</strong> <span id="modalAutor"></span></p>
          <p><strong>Ano:</strong> <span id="modalAno"></span></p>
          <p><strong>Gênero:</strong> <span id="modalGenero"></span></p>
          <p><strong>Páginas:</strong> <span id="modalPaginas"></span></p>
          <p><strong>Edição:</strong> <span id="modalEdicao"></span></p>
          <p><strong>Quantidade:</strong> <span id="modalQuantidade"></span></p>
          <p><strong>Descrição:</strong></p>
          <p id="modalDescricao" class="text-secondary"></p>
          <div class="mt-3">
            <a id="btnAlugar" href="#" class="btn btn-primary me-2">Alugar Livro</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="blurAluga"></div>
<div id="mensagemAluga">Livro alugado com sucesso!</div>



<!-- FOOTER -->
 <?php 
    include('src/pages/includes/footer.php');
  ?>

</body>
</html>
