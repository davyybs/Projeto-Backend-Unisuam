<?php
require 'conexao.php'; // Conexão com o banco

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($dados as $key => &$valor) {
        $valor = trim($_POST[$key] ?? '');
    }
    unset($valor);

    // Validações básicas
    if (empty($dados['cpf'])) {
        $erro = 'O CPF deve ser preenchido!';
    } elseif ($dados['senha'] !== $dados['confirma_senha']) {
        $erro = 'As senhas não coincidem!';
    }

   
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
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Cadastro de Usuário</title>
  <script src="js/cadastroU.js" defer></script>
  <link rel="stylesheet" href="css/cadastroU.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <h1 class="text-center my-4 fw-semibold">Cadastro de Usuário!</h1>

  <div class="container">
    <?php if($erro): ?>
      <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <div class="row g-4">
        <div class="col-md-4">
          <fieldset class="bg-white border rounded p-4 shadow-sm h-100">
            <legend class="fs-4 px-2">Informações Pessoais</legend>

            <div class="mb-3">
              <label for="nome">Nome completo*</label>
              <input class="form-control" type="text" id="nome" name="nome" required
                     value="<?php echo htmlspecialchars($dados['nome']); ?>">
            </div>

            <div class="mb-3">
              <label for="data_nasc">Data de nascimento*</label>
              <input class="form-control" type="date" id="data_nasc" name="data_nasc" required max="<?php echo date('Y-m-d'); ?>"
                     value="<?php echo htmlspecialchars($dados['data_nasc']); ?>">
            </div>

            <div class="mb-3">
              <label for="sexo">Sexo*</label>
              <select class="form-select" id="sexo" name="sexo" required>
                <option value="" disabled <?php echo $dados['sexo'] === '' ? 'selected' : ''; ?>>Selecione</option>
                <?php
                  $sexos = ['Masculino','Feminino','Agênero','Bigênero','Cisgênero','Dois Espíritos','Gênero Fluido','Gênero Não Conformista','Gênero Queer','Intergênero','Não Binário','Pangénero','Transgênero','Prefiro não informar'];
                  foreach ($sexos as $sexo) {
                      $selected = $dados['sexo'] === $sexo ? 'selected' : '';
                      echo "<option value=\"$sexo\" $selected>$sexo</option>";
                  }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="nomeM">Nome Materno*</label>
              <input class="form-control" type="text" id="nomeM" name="nomeM" required
                     value="<?php echo htmlspecialchars($dados['nomeM']); ?>">
            </div>

            <div class="mb-3">
              <label for="cpf">CPF*</label>
              <input class="form-control" type="text" id="cpf" name="cpf" maxlength="14" required
                     value="<?php echo htmlspecialchars($dados['cpf']); ?>">
            </div>

            <div class="mb-3">
              <label for="celular">Telefone celular*</label>
              <input class="form-control" type="tel" id="celular" name="celular" required
                     value="<?php echo htmlspecialchars($dados['celular']); ?>" oninput="formatarTelefone(this)">
            </div>
          </fieldset>
        </div>

        <!-- Coluna 2: Endereço -->
        <div class="col-md-4">
          <fieldset class="bg-white border rounded p-4 shadow-sm h-100">
            <legend class="fs-4 px-2">Endereço</legend>

            <div class="mb-3">
              <label for="cep">CEP*</label>
              <input class="form-control" type="text" id="cep" name="cep" maxlength="9" required
                     value="<?php echo htmlspecialchars($dados['cep']); ?>" onblur="buscarEndereco()">
            </div>

            <div class="mb-3">
              <label for="rua">Rua*</label>
              <input class="form-control" type="text" id="rua" name="rua" required
                     value="<?php echo htmlspecialchars($dados['rua']); ?>">
            </div>

            <div class="mb-3">
              <label for="numero">Número*</label>
              <input class="form-control" type="text" id="numero" name="numero" required
                     value="<?php echo htmlspecialchars($dados['numero']); ?>">
            </div>

            <div class="mb-3">
              <label for="complemento">Complemento</label>
              <input class="form-control" type="text" id="complemento" name="complemento"
                     value="<?php echo htmlspecialchars($dados['complemento']); ?>">
            </div>

            <div class="mb-3">
              <label for="bairro">Bairro*</label>
              <input class="form-control" type="text" id="bairro" name="bairro" required
                     value="<?php echo htmlspecialchars($dados['bairro']); ?>">
            </div>

            <div class="mb-3">
              <label for="cidade">Cidade*</label>
              <input class="form-control" type="text" id="cidade" name="cidade" required
                     value="<?php echo htmlspecialchars($dados['cidade']); ?>">
            </div>

            <div class="mb-3">
              <label for="estado">Estado*</label>
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
          </fieldset>
        </div>

        <!-- Coluna 3: Acesso -->
        <div class="col-md-4">
          <fieldset class="bg-white border rounded p-4 shadow-sm h-100">
            <legend class="fs-4 px-2">Acesso</legend>

            <div class="mb-3">
              <label for="email">E-mail*</label>
              <input class="form-control" type="email" id="email" name="email" required
                     value="<?php echo htmlspecialchars($dados['email']); ?>">
            </div>

            <div class="mb-3">
              <label for="login">Login*</label>
              <input class="form-control" type="text" id="login" name="login" required
                     value="<?php echo htmlspecialchars($dados['login']); ?>">
            </div>

            <div class="mb-3">
              <label for="senha">Senha*</label>
              <div class="d-flex align-items-center">
                <input class="form-control me-2" type="password" id="senha" name="senha" required
                       value="<?php echo htmlspecialchars($dados['senha']); ?>">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha('senha')">Mostrar</button>
              </div>
            </div>

            <div class="mb-3">
              <label for="confirma_senha">Confirmar Senha*</label>
              <div class="d-flex align-items-center">
                <input class="form-control me-2" type="password" id="confirma_senha" name="confirma_senha" required
                       value="<?php echo htmlspecialchars($dados['confirma_senha']); ?>">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha('confirma_senha')">Mostrar</button>
              </div>
            </div>

            <input type="hidden" name="tipo_usuario" value="usuario">
            <button type="submit" class="btn btn-primary mt-3 w-100 fs-5">Cadastrar</button>
          </fieldset>
        </div>

      </div>
    </form>
  </div>

  <script>
    function formatarTelefone(input) {
        let tel = input.value.replace(/\D/g, '');
        if(!tel.startsWith('55')) tel = '55' + tel;
        if(tel.length > 2) {
            let ddd = tel.slice(2,4);
            let numero = tel.slice(4);
            input.value = `(+55)${ddd}-${numero}`;
        }
    }

    function buscarEndereco() {
        let cep = document.getElementById('cep').value.replace(/\D/g,'');
        if(cep.length !== 8) return;

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
          .then(response => response.json())
          .then(data => {
              if(!data.erro){
                  document.getElementById('rua').value = data.logradouro;
                  document.getElementById('bairro').value = data.bairro;
                  document.getElementById('cidade').value = data.localidade;
                  document.getElementById('estado').value = data.uf;
              }
          });
    }

    function toggleSenha(id) {
        const input = document.getElementById(id);
        if(input.type === 'password'){
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
  </script>
</body>
</html>
