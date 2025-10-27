<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "unilivros";
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
} else {
    // echo "Conexão feita com suceso";
}   
?>