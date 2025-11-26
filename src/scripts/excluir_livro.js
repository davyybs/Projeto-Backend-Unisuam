<?php
require '../config/conexao.php';

// Verifica se veio o ID
if (!isset($_GET['id'])) {
    die("ID do livro não informado.");
}

$id = intval($_GET['id']);

// 1️⃣ Buscar o livro para saber se existe e qual é a capa
$sql = "SELECT capa FROM livros WHERE id = $id";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Livro não encontrado.');
            window.location.href = 'editar_livros.php';
          </script>";
    exit;
}

$livro = mysqli_fetch_assoc($result);
$capa = $livro['capa'];

// 2️⃣ Excluir arquivo da capa se for upload local (não apaga se for link)
if (!empty($capa) && !preg_match('/^https?:\/\//', $capa)) {
    $caminhoArquivo = "../uploads/" . $capa;

    if (file_exists($caminhoArquivo)) {
        unlink($caminhoArquivo);
    }
}

// 3️⃣ Excluir do banco de dados
$sqlDelete = "DELETE FROM livros WHERE id = $id";

if (mysqli_query($conexao, $sqlDelete)) {
    echo "<script>
            alert('Livro excluído com sucesso!');
            window.location.href = 'editar_livros.php';
          </script>";
} else {
    echo "<script>
            alert('Erro ao excluir livro!');
            window.location.href = 'editar_livros.php';
          </script>";
}
?>
