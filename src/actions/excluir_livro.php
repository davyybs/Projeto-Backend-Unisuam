<?php
include 'conexao.php';

// Verifica se veio o ID pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara o comando SQL para excluir
    $sql = "DELETE FROM livros WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redireciona de volta para a página que lista os livros
            header("Location: editar_livros.php?msg=Livro excluído com sucesso");
            exit();
        } else {
            echo "Erro ao excluir o livro.";
        }
    } else {
        echo "Erro na preparação da query.";
    }

    $stmt->close();
} else {
    echo "ID não informado.";
}

$conn->close();
?>
