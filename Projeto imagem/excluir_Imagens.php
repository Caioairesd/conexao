<?php
require_once "conecta.php";

$id_imagem = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

if ($id_imagem > 0) {
    //Cria uma query segura usando o prepared statement
    $queryExclusao = "DELETE FROM tabela_imagens where codigo =?";

    //Prepara a query
    $stmt = $conexao->prepare($queryExclusao);
    $stmt->bind_param("i", $id_imagem, );

    if ($stmt->execute()) {
        echo "Imagem excluida com sucesso!";
    } else {
        die("Imagem excluida com sucesso!");
    }

    //Fecha a consulta
    $stmt->close();
} else {
    echo "ID inválido!";


}

header("index.php");
exit;


?>