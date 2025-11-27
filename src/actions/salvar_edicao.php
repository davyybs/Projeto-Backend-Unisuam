<?php
require '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $paginas = $_POST['paginas'];
    $edicao = $_POST['edicao'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $quantidade = $_POST['quantidade'];

   
    $sqlAtual = "SELECT capa FROM livros WHERE id = $id";
    $queryAtual = mysqli_query($conexao, $sqlAtual);
    $livroAtual = mysqli_fetch_assoc($queryAtual);
    $capaAtual = $livroAtual['capa'];


    $capa_url = trim($_POST['capa_url']);
    $novaCapa = $capaAtual; 

    if (!empty($capa_url)) {

        if (filter_var($capa_url, FILTER_VALIDATE_URL)) {
            $novaCapa = $capa_url;
        }
    }


    if (isset($_FILES['capa_upload']) && $_FILES['capa_upload']['error'] === UPLOAD_ERR_OK) {

        $ext = pathinfo($_FILES['capa_upload']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . "." . $ext;
        $destino = "../uploads/" . $nomeArquivo;

        if (move_uploaded_file($_FILES['capa_upload']['tmp_name'], $destino)) {
            $novaCapa = $nomeArquivo;
        }
    }


    $sql = "UPDATE livros SET
                isbn = '$isbn',
                titulo = '$titulo',
                autor = '$autor',
                genero = '$genero',
                paginas = '$paginas',
                edicao = '$edicao',
                ano_publicacao = '$ano_publicacao',
                quantidade = '$quantidade',
                capa = '$novaCapa'
            WHERE id = $id";

    if (mysqli_query($conexao, $sql)) {
        header("Location: ../pages/visualizar_livros.php?msg=ok");
        exit;
    } else {
        echo "Erro ao salvar: " . mysqli_error($conexao);
    }

}
?>