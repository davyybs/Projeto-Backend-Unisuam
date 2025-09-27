<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="pt-BR" class="h-100" data-bs-theme="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/fonte.js" defer></script>
    <title>Login</title>
  </head>
  <body class="h-100">
    <main class="d-flex h-100">
      <section class="container d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex align-items-center justify-content-center w-75 h-75 shadow loginArea">
          <form action="2fa.php" method="post">
            <div class="d-flex flex-column-reverse align-items-center gap-2">
              <h1 class="fw-semibold text-body">Faça o Login!</h1>
              <a href="index.php"><img src="images/logoI.png" alt="Logo Unilivros" class="logoImg" id="imagemTema2"></a>
            </div>
            <div class="d-flex flex-column pb-4 pt-2">
              <label for="login" class="form-label fs-4">Login</label>
              <div class="input-group mb-1">
                <span class="input-group-text">
                  <i class="bi bi-person-fill"></i>
                </span>
                <input type="text" name="login" id="login" required class="form-control bg-body text-body">
              </div>
              <label for="password" class="form-label fs-4">Senha</label>
              <div class="input-group mb-1">
                <span class="input-group-text">
                  <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" name="password" id="password" required class="form-control bg-body text-body">
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary fw-semibold">Enviar</button>
              <button type="reset" class="btn btn-secondary fw-semibold">Limpar</button>
            </div>
            <div class="mt-3">
              <p class="">Esqueceu sua senha? <a href="alterar_senha.php" class="text-decoration-none">Redefinir senha</a></p>
            </div>
          </form>
        </div>
      </section>
      <section class="container d-none d-lg-flex align-items-center justify-content-center pe-0">
        <img src="images/library.png" alt="Livraria" class="img-fluid">
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="js/darkmode.js"></script>
  </body>
</html>