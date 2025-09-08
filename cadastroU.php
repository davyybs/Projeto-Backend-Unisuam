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
</head>
<body>
  <h1>Cadastro de Usuário</h1>
  <div class="cadastrocontainer">


    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="formCadastro">

      
    
      <div class="formL">
        <label for="nome">Nome completo*</label>
        <input type="text" id="nome" name="nome" required pattern="[A-Za-zÀ-ÿ\s]{15,80}" title="Digite entre 15 e 80 letras" 
          value="<?php echo htmlspecialchars($dados['nome']); ?>">
      </div>

     
      <div class="formL">
        <label for="data_nasc">Data de nascimento*</label>
        <input type="date" id="data_nasc" name="data_nasc" required max="<?php echo date('Y-m-d'); ?>"
          value="<?php echo htmlspecialchars($dados['data_nasc']); ?>">
      </div>

      <div class="formL">
        <label for="sexo">Sexo*</label>
        <select id="sexo" name="sexo" required>
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


      <div class="formL">
        <label for="nomeM">Nome Materno*</label>
        <input type="text" id="nomeM" name="nomeM" required pattern="[A-Za-zÀ-ÿ\s]{15,80}" title="Digite entre 15 e 80 letras"
          value="<?php echo htmlspecialchars($dados['nomeM']); ?>">
      </div>

      <div class="formL">
        <label for="cpf">CPF*</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" required onblur="validarCpf()"
          value="<?php echo htmlspecialchars($dados['cpf']); ?>">
        <small id="cpfErro" class="erro" style="display:none;">CPF inválido.</small>
      </div>

      <div class="formL">
        <label for="email">E-mail*</label>
        <input type="email" id="email" name="email" required
          value="<?php echo htmlspecialchars($dados['email']); ?>">
      </div>

      <div class="formL">
        <label for="celular">Telefone celular*</label>
        <input type="tel" id="celular" name="celular" required pattern="^\(\+55\)\d{2}-\d{8,9}$" title="Formato: (+55)XX-XXXXXXXXX" oninput="formatarTelefone(this)"
          value="<?php echo htmlspecialchars($dados['celular']); ?>">
      </div>

      <div class="formL">
        <label for="cep">CEP*</label>
        <input type="text" id="cep" name="cep" maxlength="9" required onblur="buscarEndereco()"
          value="<?php echo htmlspecialchars($dados['cep']); ?>">
      </div>

      <div class="formL">
        <label for="rua">Rua*</label>
        <input type="text" id="rua" name="rua" required
          value="<?php echo htmlspecialchars($dados['rua']); ?>">
      </div>

      <div class="formL">
        <label for="numero">Número*</label>
        <input type="text" id="numero" name="numero" required
          value="<?php echo htmlspecialchars($dados['numero']); ?>">
      </div>

      <div class="formL">
        <label for="complemento">Complemento</label>
        <input type="text" id="complemento" name="complemento"
          value="<?php echo htmlspecialchars($dados['complemento']); ?>">
      </div>

      <div class="formL">
        <label for="bairro">Bairro*</label>
        <input type="text" id="bairro" name="bairro" required
          value="<?php echo htmlspecialchars($dados['bairro']); ?>">
      </div>

      <div class="formL">
        <label for="cidade">Cidade*</label>
        <input type="text" id="cidade" name="cidade" required
          value="<?php echo htmlspecialchars($dados['cidade']); ?>">
      </div>

      <div class="formL">
        <label for="estado">Estado*</label>
        <select id="estado" name="estado" required>
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

      <div class="formL">
        <label for="login">Login*</label>
        <input type="text" id="login" name="login" required pattern="[A-Za-z]{6}" title="O login deve conter exatamente 6 letras (sem números ou símbolos)"
          value="<?php echo htmlspecialchars($dados['login']); ?>">
      </div>

      <div class="formL">
        <label for="senha">Senha*</label>
        <input type="password" id="senha" name="senha" required pattern=".{8,}" title="Senha deve conter no mínimo 8 caracteres">
        <button type="button" onclick="toggleSenha(event)">Mostrar</button>

        <label for="confirma_senha">Confirmar Senha*</label>
        <input type="password" id="confirma_senha" name="confirma_senha" required
          value="<?php echo htmlspecialchars($dados['confirma_senha']); ?>">
        <button type="button" onclick="toggleCSenha(event)">Mostrar</button>

        <ul id="requisitosSenha" class="requisitos">
          <li id="min">Mínimo 8 caracteres</li>
          <li id="letras">Contém letras</li>
          <li id="senhaN">Contém números</li>
          <li id="especial">Contém caractere especial</li>
        </ul>
      </div>
      <input type="hidden" name="tipo_usuario" value="usuario">
      <button type="submit"  id="btnCadastrar">Cadastrar</button>
    </form>
  </div>
</body>
</html>