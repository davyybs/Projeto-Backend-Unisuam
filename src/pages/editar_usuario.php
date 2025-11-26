<?php 
session_start();
require_once '../config/conexao.php';

// Se estiver logado, registra log
if (isset($_SESSION['usuario_id'])) {
    include('../actions/log.php');
}

// Redireciona se não estiver logado ou 2FA não confirmado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
} 
elseif (!isset($_SESSION['2fa_status']) || $_SESSION['2fa_status'] !== true) {
    header("Location: 2fa.php");
    exit;
}

/* ==========================================================
   PROCESSAR EDIÇÃO DO USUÁRIO
   ========================================================== */
if (isset($_POST['salvar'])) {

    $id_usuario = $_POST['id'];

    // Prepared Statement CORRETO
    $sql = "UPDATE cadastrou SET 
        nome = ?, nomeM = ?, data_nasc = ?, cpf = ?, sexo = ?, 
        celular = ?, cep = ?, estado = ?, cidade = ?, bairro = ?, 
        rua = ?, numero = ?, complemento = ?
        WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        // Removido alert, apenas encerramento silencioso
        die("Erro ao preparar statement.");
    }

    $stmt->bind_param(
        "sssssssssssssi",
        $_POST['nome'],
        $_POST['nomeM'],
        $_POST['data_nasc'],
        $_POST['cpf'],
        $_POST['sexo'],
        $_POST['celular'],
        $_POST['cep'],
        $_POST['estado'],
        $_POST['cidade'],
        $_POST['bairro'],
        $_POST['rua'],
        $_POST['numero'],
        $_POST['complemento'],
        $id_usuario
    );

    $stmt->execute();
    $stmt->close();

    header("Location: consulta_usuario.php?edit=ok");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/log.css">
<link rel="stylesheet" href="../css/responsividade.css">
<link rel="stylesheet" href="../css/user.css">
<link rel="stylesheet" href="../css/fonte.css">
<script src="../scripts/fonte.js" defer></script>
<script src="../scripts/darkmode.js" defer></script>
<script src="./scripts/cadastroU.js" defer></script>
<script src="../scripts/editar_usuario.js" defer></script>
<title>UniLivros</title>
</head>

<body>

<?php include('includes/header.php'); ?>

<section>
<div class="container mt-5">
<div class="row">
<div class="col-md-12">
<div class="card">

<?php 
// Verifica se ID do usuário foi passado
if (isset($_GET['id'])) {

    $id_usuario = mysqli_real_escape_string($conexao, $_GET['id']);
    $sql = "SELECT * FROM cadastrou WHERE id = '$id_usuario'";
    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
        $usuario = mysqli_fetch_array($query);
?>

<!-- FORMULÁRIO -->
<form method="POST" action="">
<div class="card-header d-flex justify-content-between align-items-center p-3">
    <input type="text" class="form-control fs-3 fw-semibold text-primary-emphasis" 
           id="nome" name="nome" value="<?= $usuario['nome'] ?>">
    <a href="consulta_usuario.php" class="btn btn-secondary btn-lg ms-3">Voltar</a>
</div>

<div class="card-body p-4">

<input type="hidden" name="id" value="<?= $usuario['id'] ?>">

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Nome Materno</label>
        <input class="form-control" id="nomeM" name="nomeM" value="<?= $usuario['nomeM'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="data_nasc"
               name="data_nasc" value="<?= $usuario['data_nasc'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">CPF</label>
        <input class="form-control" id="cpf" name="cpf" value="<?= $usuario['cpf'] ?>">
        <span id="cpfErro" style="display:none;color:red;font-size:14px;">CPF inválido</span>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Sexo</label>
        <!-- <input class="form-control" id="sexo" name="sexo" value="<?= $usuario['sexo'] ?>"> -->
        <select class="form-select" id="sexo" name="sexo" required>
            <option value="<?= $usuario['sexo'] ?>" disabled>Selecione</option>
            <?php
                $sexos = ['Masculino','Feminino','Prefiro não informar'];
                foreach ($sexos as $sexo) {
                    $selected = $dados['sexo'] === $sexo ? 'selected' : '';
                    echo "<option value=\"$sexo\" $selected>$sexo</option>";
                }
            ?>
        </select>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Telefone Celular</label>
        <input class="form-control" id="celular" name="celular" value="<?= $usuario['celular'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">CEP</label>
        <input class="form-control" id="cep" name="cep" value="<?= $usuario['cep'] ?>">
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Estado</label>
        <input class="form-control" id="estado" name="estado" value="<?= $usuario['estado'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Cidade</label>
        <input class="form-control" id="cidade" name="cidade" value="<?= $usuario['cidade'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Bairro</label>
        <input class="form-control" id="bairro" name="bairro" value="<?= $usuario['bairro'] ?>">
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Rua</label>
        <input class="form-control" id="rua" name="rua" value="<?= $usuario['rua'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Número</label>
        <input class="form-control" id="numero" name="numero" value="<?= $usuario['numero'] ?>">
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <label class="form-label">Complemento</label>
        <input class="form-control" id="complemento" name="complemento" value="<?= $usuario['complemento'] ?>">
    </div>
</div>

<button type="submit" name="salvar" class="btn btn-primary btn-lg mt-3">Salvar</button>

</div>
</form>

<?php 
    } else {
        echo '<h5>Usuário não encontrado</h5>';
    }
}
?>

</div>
</div>
</div>
</div>
</section>

<?php include('includes/footer.php'); ?>

</body>
</html>