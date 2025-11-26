<?php
    session_start();
    require_once '../config/conexao.php';
    include('../actions/loginVerify.php');
    include('../actions/admin.php');

    if (!isset($_GET['id'])) {
        die("ID do livro não informado.");
    }

    $id = intval($_GET['id']);

    // Buscar o livro pelo ID
    $sql = "SELECT * FROM livros WHERE id = $id";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) == 0) {
        die("Livro não encontrado.");
    }

    $livro = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="pt-BR" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <title>Editar Livro</title>
    <script src="../scripts/darkmode.js" defer></script>
    <script src="../scripts/fonte.js" defer></script>
    <script src="../scripts/user.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/livros.css">
</head>

<body>
<!-- Header -->
   <?php 
    include('includes/header.php');
  ?>
    <div class="container my-5">

        <h2 class="fw-semibold mb-4">Editar Livro</h2>

        <form action="salvar_edicao.php" method="POST" enctype="multipart/form-data" class="row g-3">

            <!-- ID Oculto -->
            <input type="hidden" name="id" value="<?= $livro['id'] ?>">

            <div class="col-md-6">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-control" required value="<?= $livro['isbn'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required value="<?= $livro['titulo'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" required value="<?= $livro['autor'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Gênero</label>
                <input type="text" name="genero" class="form-control" required value="<?= $livro['genero'] ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Páginas</label>
                <input type="number" name="paginas" class="form-control" required value="<?= $livro['paginas'] ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Edição</label>
                <input type="text" name="edicao" class="form-control" required value="<?= $livro['edicao'] ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Ano de Publicação</label>
                <input type="number" name="ano_publicacao" class="form-control" required value="<?= $livro['ano_publicacao'] ?>">
            </div>

            <div class="col-md-12">
                <label class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" required value="<?= $livro['quantidade'] ?>">
            </div>

             <!-- Link da capa -->
            <div class="col-12">
             <label class="form-label">URL da Capa (opcional)</label>
             <input 
              type="text" 
             name="capa_url" 
             class="form-control" 
            placeholder="https://exemplo.com/imagem.jpg"
            value="<?= preg_match('/^https?:\/\//', $livro['capa']) ? $livro['capa'] : '' ?>"
            >
             <small class="text-muted">Se preencher o link, o upload abaixo será ignorado.</small>
        </div>

            <!-- Upload de nova capa -->
            <div class="col-12">
            <label class="form-label">Upload de Nova Capa (opcional)</label>
             <input type="file" name="capa_upload" class="form-control">
            </div>


            <!-- Capa Atual -->
            <div class="col-md-6">
                <label class="form-label">Capa Atual</label><br>

                <?php if (!empty($livro['capa'])): ?>

                    <?php if (preg_match('/^https?:\/\//', $livro['capa'])): ?>
                        <img src="<?= $livro['capa'] ?>" width="120" class="rounded shadow-sm mb-2">
                    <?php else: ?>
                        <img src="../uploads/<?= $livro['capa'] ?>" width="120" class="rounded shadow-sm mb-2">
                    <?php endif; ?>

                <?php else: ?>
                    <p class="text-muted">Sem capa</p>
                <?php endif; ?>
            </div>


            <!-- Botões -->
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Salvar Alterações
                </button>

                <a href="visualizar_livros.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

        </form>

    </div>

</body>
</html>
