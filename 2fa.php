<!doctype html>
<html lang="pt-BR" class="h-100" data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/alterar_senha.css">
    <script src="js/fonte.js" defer></script>
    <title>Confirmar Acesso</title>
  </head>
  <body class="h-100">
    <main class="d-flex h-100">
      <section class="container d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex align-items-center justify-content-center w-75 h-75 shadow loginArea">
          <form id="formRecuperar">
            <div class="d-flex flex-column-reverse align-items-center gap-2 mb-3">
              <h1 class="fw-semibold text-primary-emphasis fs-2">Confirme seu acesso</h1>
              <a href="index.php"><img src="images/logoI.png" alt="Logo Unilivros" class="logoImg" id="imagemTema2"></a>
            </div>
            
            <p class="text-center mb-3">
              Digite seu CEP para confirmarmos o seu login!
            </p>
            
            <div class="d-flex flex-column pb-4 pt-2">
              <label for="cpf" class="form-label fs-4">CEP</label>
              <div class="input-group mb-1">
                <span class="input-group-text">
                  <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="text" name="cep" id="cep" required maxlength="8" class="form-control">
              </div>
            </div>
            
            <div class="mb-3">
              <button type="submit" id="btnEnviar" class="btn btn-primary fw-semibold">Confirmar</button>
              <button type="reset" class="btn btn-secondary fw-semibold">Limpar</button>
            </div>
            
            <div id="mensagem-container" class="mb-3"></div>
            
            <div class="mt-3">
              <a href="login.php" class="text-decoration-none">Voltar para o login</a>
            </div>
          </form>
        </div>
      </section>
      
      <section class="container d-none d-lg-flex align-items-center justify-content-center pe-0">
        <img src="images/library.png" alt="Livraria" class="img-fluid">
      </section>
    </main>
    
    <script src="js/darkmode.js"></script>
  </body>
  </html>
  