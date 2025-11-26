<?php
  include('../config/conexao.php');
  
  if (isset($_SESSION['usuario_id'])) {
    include('../actions/log.php');
  
  }
  
  include('../actions/loginVerify.php');
  include('../actions/admin.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titulo = $_POST['titulo'] ?? '';
      $autor = $_POST['autor'] ?? '';
      $isbn = $_POST['isbn'] ?? '';
      $genero = $_POST['genero'] ?? '';
      $descricao = $_POST['descricao'];
      $edicao = $_POST['edicao'] ?? '';
      $ano_publicacao = $_POST['ano_publicacao'] ?? '';
      $paginas = $_POST['paginas'] ?? '';
      $quantidade = $_POST['quantidade'] ?? '';
      $link_capa = $_POST['link_capa'] ?? '';
      $capa = '';

    
      if ((!empty($_FILES['capa']['name']) && !empty($link_capa)) ||
          (empty($_FILES['capa']['name']) && empty($link_capa))) {
          
          echo "<script>
                  alert('❌ Escolha apenas UMA opção: envie uma imagem OU insira um link.');
                  document.getElementById('capa').value = '';
                  document.getElementById('link_capa').value = '';
                  history.back();
                </script>";
          exit; 
      }

    
      if (!empty($_FILES['capa']['name'])) {
          $capa = $_FILES['capa']['name'];
          $pastaDestino = '../uploads/';
          $caminhoCapa = $pastaDestino . basename($capa);

          if (!move_uploaded_file($_FILES['capa']['tmp_name'], $caminhoCapa)) {
              echo "<script>alert('⚠️ Erro ao enviar a imagem da capa.'); history.back();</script>";
              exit;
          }
      } 
      
      else {
          $capa = $link_capa;
      }

      
      $sql = "INSERT INTO livros (titulo, autor, isbn, genero, descricao, edicao, ano_publicacao, paginas, quantidade, capa)
          VALUES ('$titulo', '$autor', '$isbn', '$genero', '$descricao', '$edicao', '$ano_publicacao', '$paginas', '$quantidade', '$capa')";


      if ($conexao->query($sql)) {
          echo "<script>alert('✅ Livro cadastrado com sucesso!'); window.location.href='cadastro_livro.php';</script>";
      } else {
          echo "<script>alert('❌ Erro ao cadastrar livro: {$conexao->error}'); history.back();</script>";
      }
  }
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Livros</title>
  <script src="../scripts/cadastro_livro.js" defer></script>
  <script src="../scripts/fonte.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/cadastro_livro.css">
  <script src="../scripts/darkmode.js" defer></script>

</head>
<body>
  <div class="container">
    <section class="d-flex mb-5 justify-content-between">
        <h1 class="text-primary-emphasis fw-semibold">Cadastro de livros</h1>
        
        <a href="/Projeto-Backend-Unisuam/index.php"><img src="../images/logoI.png" alt="Logo UniLivros" class="logoImg"
            id="imagemTema2"></a>
            
      </section>
    
   
    <form action="cadastro_livro.php" method="POST" enctype="multipart/form-data" class="form-livro">
  <div class="upload-box">
    <label for="capa" class="upload-label">
      <div class="upload-area" id="upload-preview">
        <span>📁</span>
        <p>Clique para adicionar a capa</p>
        <p class="formato">PNG, JPG, até 5MB</p>
      </div>
    </label>
    <input type="file" name="capa" id="capa" accept="image/*">

   
    <div class="ou-link">
      <label for="link_capa">Ou insira o link da imagem:</label>
      <input type="url" name="link_capa" id="link_capa" placeholder="https://exemplo.com/imagem.jpg">
    </div>
  </div>

 
  <div class="form-grid">
    <div>
      <label for="titulo">Título do Livro *</label>
      <input type="text" name="titulo" id="titulo" required minlength="2">
    </div>

    <div>
      <label for="autor">Autor(es) *</label>
      <input type="text" name="autor" id="autor" required minlength="2">
    </div>

    <div>
      <label for="isbn">ISBN *</label>
      <input type="text" name="isbn" id="isbn" required pattern="\d{9,13}" title="Digite entre 10 e 13 números">
    </div>

    <div>
      <label for="genero">Gênero *</label>
      <input type="text" name="genero" id="genero" required minlength="2">
    </div>
  
    <div>
      <label for="edicao">Edição *</label>
      <input type="text" name="edicao" id="edicao" required minlength="1">
    </div>

    <div>
      <label for="ano_publicacao">Ano de Publicação *</label>
      <input type="number" name="ano_publicacao" id="ano_publicacao" required min="1000" max="2025">
    </div>

    <div>
      <label for="paginas">Número de Páginas *</label>
      <input type="number" name="paginas" id="paginas" required min="1">
    </div>

    <div>
      <label for="quantidade">Quantidade *</label>
      <input type="number" name="quantidade" id="quantidade" required min="1">
    </div>
  </div>
      <div class="descricao-container">
  <label for="descricao">Descrição *</label>
  <textarea name="descricao" id="descricao" rows="5" required minlength="10" placeholder="Digite uma breve descrição do livro..."></textarea>
</div>
  <div class="botao col-lg-4 col-md-6 col-12 mb-3 d-flex justify-content-center align-items-end">
              <input type="hidden" name="tipo_usuario" value="usuario">
              <button type="submit" class="btn btn-primary btn-lg w-75">Cadastrar</button>
            </div>
</form>

  </div>

  <script>
    
    const input = document.getElementById('capa');
    const preview = document.getElementById('upload-preview');

    input.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Prévia da capa">`;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>
