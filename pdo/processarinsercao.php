<?php
require_once 'conexap.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = conectarBanco();

    $sql = "INSERT into cliente (nome,endereco,telefone,email)values(:nome,:endereco,:telefone,:email)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $_POST["nome"]);
    $stmt->bindParam(":endereco", $_POST["endereco"]);
    $stmt->bindParam(":telefone", $_POST["telefone"]);
    $stmt->bindParam(":email", $_POST["email"]);

    try {
        $stmt->execute();
        echo "Cliente cadastrado com sucesso!";
    } catch (PDOException $e) {
        error_log("Erro a inserir cliente" . $e->getMessage());
        echo "Erro ao cadastrar cliente";
    }

}

?>