<?php
$servidor = "localhost:3306";
$usuario = "root";
$senha = "Mddr1605.";
$banco = "unilivros";
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>