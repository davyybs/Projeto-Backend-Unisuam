<?php
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

  if (strlen($dados['nome']) < 15) {
    $erro = 'O nome deve ter pelo menos 15 caracteres.';
  } elseif ($dados['senha'] !== $dados['confirma_senha']) {
    $erro = 'As senhas não coincidem.';
  } elseif (strlen($dados['senha']) < 8) {
    $erro = 'A senha deve ter pelo menos 8 caracteres.';
  }

  if (!$erro) {
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
  <link rel="stylesheet" href="css/cadastroU.css"/>
  <script src="js/cadastroU.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <h1 class="text-center my-4">Cadastro de Usuário</h1>

  <div class="container">
    <div class="row g-4">

     
      <div class="col-md-4">
        <form class="form h-80" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <fieldset class="bg-white border rounded p-4 shadow-sm h-100">
            <legend class="fs-5 fw-bold px-2">Informações Pessoais</legend>

            <div class="mb-3">
              <label for="nome">Nome completo*</label>
              <input class="form-control" type="text" id="nome" name="nome" required pattern="[A-Za-zÀ-ÿ\s]{15,80}" title="Digite entre 15 e 80 letras" 
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
                  $sexos = ['Masculino','Feminino','Agênero', 'Bigênero', 'Cisgênero', 'Dois Espíritos', 'Gênero Fluido', 'Gênero Não Conformista', 'Gênero Queer', 'Intergênero', 'Não Binário', 'Pangénero', 'Transgênero', 'Prefiro não informar'];
                  foreach ($sexos as $sexo) {
                    $selected = $dados['sexo'] === $sexo ? 'selected' : '';
                    echo "<option value=\"$sexo\" $selected>$sexo</option>";
                  }
                ?>
              </select>
            </div>
              <div class="mb-3">
              <label for="celular">Telefone celular*</label>
              <input class="form-control" type="tel" id="celular" name="celular" required pattern="^\(\+55\)\d{2}-\d{8,9}$" title="Formato: (+55)XX-XXXXXXXXX" oninput="formatarTelefone(this)"
                value="<?php echo htmlspecialchars($dados['celular']); ?>">
            </div>
            <div class="mb-3">
              <label for="nomeM">Nome Materno*</label>
              <input class="form-control" type="text" id="nomeM" name="nomeM" required pattern="[A-Za-zÀ-ÿ\s]{15,80}" title="Digite entre 15 e 80 letras"
                value="<?php echo htmlspecialchars($dados['nomeM']); ?>">
            </div>

            <div class="formL">
        <label for="cpf">CPF*</label>
        <input class="p-1 w-100 fs-6" type="text" id="cpf" name="cpf" maxlength="14" required onblur="validarCpf()"
          value="<?php echo htmlspecialchars($dados['cpf']); ?>">
        <small id="cpfErro" class="mt-1 text-danger fs-8" style="display:none;">CPF inválido.</small>
      </div>
          </fieldset>
        </form>
      </div>

    
      <div class="col-md-4">
        <form class="form h-80" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <fieldset class="bg-white border rounded p-4 shadow-sm h-100">
            <legend class="fs-5 fw-bold px-2">Endereço</legend>

            <div class="mb-3">
              <label for="cep">CEP*</label>
              <input class="form-control" type="text" id="cep" name="cep" maxlength="9" required onblur="buscarEndereco()"
                value="<?php echo htmlspecialchars($dados['cep']); ?>">
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
        </form>
      </div>

     
      <div class="col-md-4">
        <form class="form h-50 d-flex flex-column" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <fieldset class="bg-white border rounded p-4 shadow-sm flex-grow-1">
            <legend class="fs-5 fw-bold px-2">Acesso</legend>

            <div class="mb-3">
              <label for="email">E-mail*</label>
              <input class="form-control" type="email" id="email" name="email" required
                value="<?php echo htmlspecialchars($dados['email']); ?>">
                </div>

            <div class="mb-3">
              <label for="login">Login*</label>
              <input class="form-control" type="text" id="login" name="login" required pattern="[A-Za-z]{6}" title="O login deve conter exatamente 6 letras (sem números ou símbolos)"
                value="<?php echo htmlspecialchars($dados['login']); ?>">
            </div>

            <div class="mb-3">
              <label for="senha">Senha*</label><button type="button" class="btn btn-sm btn-outline-secondary mb-2" onclick="toggleSenha(event)">Mostrar</button>
              <input class="form-control mb-2" type="password" id="senha" name="senha" required pattern=".{8,}" title="Senha deve conter no mínimo 8 caracteres">
              

              <label for="confirma_senha">Confirmar Senha*</label><button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleCSenha(event)">Mostrar</button>
              <input class="form-control mb-2" type="password" id="confirma_senha" name="confirma_senha" required
                value="<?php echo htmlspecialchars($dados['confirma_senha']); ?>">
              

              <ul id="requisitosSenha" class="list-unstyled ps-0 mt-2 requisitos">
                <li class="fs-6 text-secondary mb-1" id="min">Mínimo 8 caracteres</li>
                <li class="fs-6 text-secondary mb-1" id="letras">Contém letras</li>
                <li class="fs-6 text-secondary mb-1" id="senhaN">Contém números</li>
                <li class="fs-6 text-secondary mb-1" id="especial">Contém caractere especial</li>
              </ul>
            </div>
          </fieldset>

          <input type="hidden" name="tipo_usuario" value="usuario">
          <button type="submit" id="cadastrar"class="btn btn-primary mt-3 w-100 fs-5">Cadastrar</button>
        </form>
      </div>

    </div>
  </div>
</body>
</html>
