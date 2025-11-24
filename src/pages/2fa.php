<?php 
  session_start();
  require '../config/conexao.php';

  if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
  }
?>

<!doctype html>
<html lang="pt-BR" class="h-100" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/alterar_senha.css">
  <link rel="stylesheet" href="../css/responsividade.css">
  <script src="../scripts/fonte.js" defer></script>
  <script src="../scripts/darkmode.js" defer></script>
  <title>Confirmar Acesso</title>
</head>

<body class="h-100">
  <main class="d-flex h-100">
    <section class="container d-flex flex-column justify-content-center align-items-center">
      <div class="d-flex align-items-center justify-content-center w-75 h-75 shadow loginArea">
        <?php
          // Lista de opções possíveis
          $opcoes = ["cpf", "cep", "nomeM"];

          // Escolhe uma opção aleatória
          $campoEscolhido = $opcoes[array_rand($opcoes)];

          // Define a mensagem para o usuário
          switch ($campoEscolhido) {
              case "cpf":
                  $mensagem = "Digite seu CPF cadastrado:";
                  $tipo = "CPF";
                  $icon = "bi-file-earmark-fill";
                  break;
              case "cep":
                  $mensagem = "Digite seu CEP cadastrado:";
                  $tipo = "CEP";
                  $icon = 'bi-envelope-fill';
                  break;
              case "nomeM":
                  $mensagem = "Digite o nome da sua mãe:";
                  $tipo = "Nome Materno";
                  $icon = "bi-person-fill";
                  break;
          }

          $_SESSION['2FA'] = $campoEscolhido;

          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $respostaUsuario = trim($_POST['resposta']);
            $campo = $_POST['campo'];
            $userId = $_SESSION['usuario_id'];

            // valida campo
            $permitidos = ["cpf", "cep", "nomeM"];
            if (!in_array($campo, $permitidos)) {
                die("Campo inválido!");
            }

            // monta query com coluna validada
            $sql = "SELECT $campo FROM cadastrou WHERE id = ?";

            // prepara statement
            if ($stmt = mysqli_prepare($conexao, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $userId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $valorCorreto);

                if (mysqli_stmt_fetch($stmt)) {
                    if ($respostaUsuario === $valorCorreto) {
                      $_SESSION['2fa_status'] = true;
                      header("Location: /Projeto-Backend-Unisuam/index.php");
                      exit;

                    } else {
                        echo "Informação incorreta. Tente novamente.";
                    }
                } else {
                    echo "Erro ao buscar dados do usuário.";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Erro na preparação da consulta.";
            }
          }

          mysqli_close($conexao);
        ?>
      <form method="post"  id="formRecuperar">
          <div class="d-flex flex-column-reverse align-items-center gap-2 mb-3">
            <h1 class="fw-semibold text-primary-emphasis fs-2">Confirme seu acesso</h1>
            <a href="/Projeto-Backend-Unisuam/index.php"><img src="../images/logoI.png" alt="Logo Unilivros"
                class="logoImg" id="imagemTema2"></a>
          </div>

          <p class="text-center mb-3"><?=$mensagem?></p>

          <div class="d-flex flex-column pb-4 pt-2">
            <label for="resposta" class="form-label fs-4"><?=$tipo?></label>
            <div class="input-group mb-1">
              <span class="input-group-text">
                <i class="bi <?= $icon?>"></i>
              </span>
              <input type="text" name="resposta" class="form-control" required>
            </div>
            <input type="hidden" name="campo" value="<?= $campoEscolhido?>">
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
      <img src="../images/library.png" alt="Livraria" class="img-fluid">
    </section>
  </main>
</body>

</html>