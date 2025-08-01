<?php

require_once("conexao.php");

$conexao = conectardb();

$nome = "Caio Vinicius";
$endereco = "Rua Jarivatuba 2120";
$telefone = "(47)99239-4209";
$email = "Caiovini@gmail.com";



$stmt = $conexao->prepare("INSERT INTO cliente (nome,endereco,telefone,email) values (?,?,?,?)");

$stmt->bind_param("ssss", $nome, $endereco, $telefone, $email);


if ($stmt->execute()) {
    echo "Cliente adicionado com sucesso!";
} else {
    echo "Erro ao adicionar cliente" . $stmt->error;
}

$stmt->close();
$conexao->close();
?>