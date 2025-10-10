<?php
  session_start();
  require 'conexao.php';
?>

<?php
 require 'conexao.php';

$erro = '';
$dados = [
  'nome' => '',
  'data_nasc' => '',
  'sexo' => '',
  'nomeM' => '',
  'cpf' => '',
  'email' => '',
  'celular' => '',
  'cep' => '',
  'rua' => '',
  'numero' => '',
  'complemento' => '',
  'bairro' => '',
  'cidade' => '',
  'estado' => '',
  'login' => '',
  'senha' => '',
  'confirma_senha' => '',
];
  function validarCPFFormatado($cpf) {
    if (strlen($cpf) !== 14) {
        return false;
    }
    if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
        return false;
    }
    $cpfNumeros = preg_replace('/[^0-9]/', '', $cpf);
    if (preg_match('/(\d)\1{10}/', $cpfNumeros)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += $cpfNumeros[$i] * (($t + 1) - $i);
        }
        $digito = (10 * $soma) % 11;
        if ($digito == 10) {
            $digito = 0;
        }
        if ($cpfNumeros[$t] != $digito) {
            return false;
        }
    }
    return true;
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($dados as $key => &$valor) {
        $valor = trim($_POST[$key] ?? '');
    }
    unset($valor);

    if (!$erro) {
        $checkCpf = mysqli_prepare($conexao, "SELECT id FROM cadastroU WHERE cpf = ?");
        mysqli_stmt_bind_param($checkCpf, "s", $dados['cpf']);
        mysqli_stmt_execute($checkCpf);
        mysqli_stmt_store_result($checkCpf);
        if (mysqli_stmt_num_rows($checkCpf) > 0) {
            $erro = "CPF já cadastrado!";
        }
        mysqli_stmt_close($checkCpf);
    }
    if (empty($dados['cpf'])) {
    $erro = 'O CPF deve ser preenchido!';
  } elseif (!validarCPFFormatado($dados['cpf'])) {
    $erro = 'CPF inválido! Use o formato 000.000.000-00 e um número válido.';
  } elseif ($dados['senha'] !== $dados['confirma_senha']) {
    $erro = 'As senhas não coincidem!';
  }
    if (!$erro) {
        $checkEmail = mysqli_prepare($conexao, "SELECT id FROM cadastroU WHERE email = ?");
        mysqli_stmt_bind_param($checkEmail, "s", $dados['email']);
        mysqli_stmt_execute($checkEmail);
        mysqli_stmt_store_result($checkEmail);
        if (mysqli_stmt_num_rows($checkEmail) > 0) {
            $erro = "Email já cadastrado!";
        }
        mysqli_stmt_close($checkEmail);
    }
    if (!$erro) {
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $tipo_usuario = $_POST['tipo_usuario'] ?? 'usuario';

        $sql = "INSERT INTO cadastroU 
            (nome, data_nasc, sexo, nomeM, cpf, email, celular, cep, rua, numero, complemento, bairro, cidade, estado, login, senha, tipo_usuario)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssssssssssss",
            $dados['nome'],
            $dados['data_nasc'],
            $dados['sexo'],
            $dados['nomeM'],
            $dados['cpf'],
            $dados['email'],
            $dados['celular'],
            $dados['cep'],
            $dados['rua'],
            $dados['numero'],
            $dados['complemento'],
            $dados['bairro'],
            $dados['cidade'],
            $dados['estado'],
            $dados['login'],
            $senhaHash,
            $tipo_usuario
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);

        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8"/>
    <script src="js/cadastro_usuario.js" defer></script>
    <script src="js/fonte.js" defer></script>
    <script src="js/darkmode.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cadastro_usuario.css"/>
    <title>Cadastro</title>
  </head>
  <body>
    <main class="container d-flex justify-content-center align-items-center h-100 p-4 my-4">
      
      <?php if($erro): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
      <?php endif; ?>

      <div class="cadArea shadow p-5">
        <section class="d-flex mb-5 justify-content-between">
          <h1 class="text-primary-emphasis fw-semibold">Cadastre-se</h1>
          <a href="index.php"><img src="images/logoI.png" alt="Logo UniLivros" class="logoImg" id="imagemTema2"></a>
        </section>
      
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

          <!-- Seção Informações Pessoais -->
          <section class="my-4">
            <div class="row">
              <div class="col-12">
                <h2 class="fs-4 mb-4 text-primary-emphasis">Informações Pessoais</h2>
              </div>
            </div>

            <!-- Primeira linha -->
            <div class="row">
              <!-- Nome Completo -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="nome" class="form-label">Nome completo</label>
                <input class="form-control form-control" type="text" id="nome" name="nome"
                      value="<?php echo htmlspecialchars($dados['nome']); ?>" required>
              </div>
              <!-- Nome Materno -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="nomeM" class="form-label">Nome Materno</label>
                <input class="form-control form-control" type="text" id="nomeM" name="nomeM"
                      value="<?php echo htmlspecialchars($dados['nomeM']); ?>" required>
              </div>
              <!-- Data de Nascimento -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="data_nasc" class="form-label">Data de nascimento</label>
                <input class="form-control form-control" type="date" id="data_nasc" name="data_nasc"
                      max="<?php echo date('Y-m-d'); ?>"
                      value="<?php echo htmlspecialchars($dados['data_nasc']); ?>" required>
              </div>
            </div>

            <!-- Segunda linha -->
            <div class="row">
              <!-- CPF -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input class="form-control form-control" type="text" id="cpf" name="cpf" maxlength="14"
                      value="<?php echo htmlspecialchars($dados['cpf']); ?>" required>
              </div>
              <!-- Telefone Celular -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="celular" class="form-label">Telefone Celular</label>
                <input class="form-control form-control" type="tel" id="celular" name="celular"
                      value="<?php echo htmlspecialchars($dados['celular']); ?>" 
                      oninput="formatarTelefone(this)" required>
              </div>
              <!-- Sexo -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                  <option value="" disabled <?php echo $dados['sexo'] === '' ? 'selected' : ''; ?>>Selecione</option>
                  <?php
                    $sexos = ['Masculino','Feminino','Prefiro não informar'];
                    foreach ($sexos as $sexo) {
                      $selected = $dados['sexo'] === $sexo ? 'selected' : '';
                      echo "<option value=\"$sexo\" $selected>$sexo</option>";
                    }
                    ?>
                </select>
              </div>
            </div>

          </section>
          <hr>
          
          <!-- Seção Endereço -->
          <section class="my-4">
            <div class="row">
              <div class="col-12">
                <h2 class="fs-4 mb-4 text-primary-emphasis">Endereço</h2>
              </div>
            </div>

            <!-- Primeira linha -->
            <div class="row">
              <!-- CEP -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="cep" class="form-label">CEP</label>
                <input class="form-control" type="text" id="cep" name="cep" maxlength="9" required 
                        value="<?php echo htmlspecialchars($dados['cep']); ?>" onblur="buscarEndereco()">
              </div>
              <!-- Estado -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                  <option value="">Selecione</option>
                  <?php
                    $estados = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
                    foreach ($estados as $sigla) {
                      $selected = $dados['estado'] === $sigla ? 'selected' : '';
                      echo "<option value='$sigla' $selected>$sigla</option>";
                    }
                  ?>
                </select>
              </div>
              <!-- Cidade -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input class="form-control" type="text" id="cidade" name="cidade" required 
                      value="<?php echo htmlspecialchars($dados['cidade']); ?>">
              </div>
              
              
            </div>

            <!-- Segunda linha -->
            <div class="row">
              <!-- Bairro -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="bairro" class="form-label">Bairro</label>
                <input class="form-control" type="text" id="bairro" name="bairro" required 
                      value="<?php echo htmlspecialchars($dados['bairro']); ?>">
              </div>
              <!-- Rua -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="rua" class="form-label">Rua</label>
                <input class="form-control" type="text" id="rua" name="rua" required 
                        value="<?php echo htmlspecialchars($dados['rua']); ?>">
              </div>
              <!-- Número -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="numero" class="form-label">Número</label>
                <input class="form-control" type="text" id="numero" name="numero" required 
                        value="<?php echo htmlspecialchars($dados['numero']); ?>">
              </div>
            </div>

            <!-- Terceira linha -->
            <div class="row">
              <!-- Complemento -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="complemento" class="form-label">Complemento</label>
                <input class="form-control" type="text" id="complemento" name="complemento" 
                        value="<?php echo htmlspecialchars($dados['complemento']); ?>">
              </div>
            </div>

          </section>
          <hr>
          
          <!-- Seção Acesso -->
          <section class="my-4 w-100">
            <div class="row">
              <div class="col-12">
                <h2 class="fs-4 mb-4 text-primary-emphasis">Acesso</h2>
              </div>
            </div>
            <!-- Primeira linha -->
            <div class="row">
              <!-- Login -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="login" class="form-label">Login</label>
                <input class="form-control" type="text" id="login" name="login" required
                      value="<?php echo htmlspecialchars($dados['login']); ?>">
              </div>
              <!-- E-mail -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="email" id="email" name="email" required
                value="<?php echo htmlspecialchars($dados['email']); ?>">
              </div>
              <div class="col-lg-4 col-md-6 col-12 mb-3 d-flex justify-content-center align-items-end">
                <input type="hidden" name="tipo_usuario" value="usuario">
                <button type="submit" class="btn btn-primary btn-lg w-75">Cadastrar</button>
              </div>
            </div>
          
            <!-- Segunda linha -->
            <div class="row">
              <!-- Senha -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="senha" class="form-label">Senha</label>
                <div class="d-flex align-items-center">
                  <input class="form-control me-2" type="password" id="senha" name="senha" required
                  value="<?php echo htmlspecialchars($dados['senha']); ?>">
                  <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha('senha')">Mostrar</button>
                </div>
              </div>
              <!-- Confirmar Senha -->
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                <div class="d-flex align-items-center">
                  <input class="form-control me-2" type="password" id="confirma_senha" name="confirma_senha" required
                  value="<?php echo htmlspecialchars($dados['confirma_senha']); ?>">
                  <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha('confirma_senha')">Mostrar</button>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12 mb-3 d-flex justify-content-center align-items-end">
                <p>Já possui uma conta? <a href="login.php"> Faça o Login</a></p>
              </div>    
            </div>
          </section>
        </form>
      </div>
    </main>
  </body>
</html>
      