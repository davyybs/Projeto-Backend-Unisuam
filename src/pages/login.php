<?php
  session_start();
  require '../config/conexao.php';
?>

<!doctype html>
<html lang="pt-BR" class="h-100" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/responsividade.css">
  <script src="../scripts/fonte.js" defer></script>
    <script src="../scripts/darkmode.js" defer></script>
  <title>Login</title>
</head>

<body class="h-100">
  <main class="d-flex h-100">
    <?php 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = mysqli_real_escape_string($conexao, $_POST['login']);
        $senha = mysqli_real_escape_string($conexao, $_POST['password']);

        $sql = "SELECT * FROM cadastrou WHERE login = '$login'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
          $usuario = mysqli_fetch_assoc($resultado);

          if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: 2fa.php");
            exit;
          } else {
            echo "<p>Senha incorreta</p>";
          }
        } else {
          echo "<p>Usuário não encontrado</p>";
        }
      }
    ?>
    <section class="container d-flex flex-column justify-content-center align-items-center">
      <div class="d-flex align-items-center justify-content-center w-75 h-75 shadow loginArea">
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
          <div class="d-flex flex-column-reverse align-items-center gap-2">
            <h1 class="fw-semibold text-primary-emphasis">Faça o Login!</h1>
            <a href="/Projeto-Backend-Unisuam/index.php"><img src="images/logoI.png" alt="Logo Unilivros"
                class="logoImg" id="imagemTema2"></a>
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
            <p>Esqueceu sua senha? <a href="alterar_senha.php" class="text-decoration-none">Redefinir senha</a></p>
          </div>
          <div class="">
            <p>Ainda não possui um login? <a href="cadastro_usuario.php" class="text-decoration-none">Cadastre-se</a>
            </p>
          </div>

        </form>
      </div>
    </section>
    <section class="container d-none d-lg-flex align-items-center justify-content-center pe-0">
      <img src="../images/library.png" alt="Livraria" class="img-fluid">
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>

</body>

</html>