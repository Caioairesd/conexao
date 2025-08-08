<?php

//Configuraçao do banco de dados
$host = 'localhost';
$dbname = 'armazena_imagem';
$username = 'root';
$password = '';


try {
    //Conexao com o banco usando pdo
    $pdo = new pdo("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $sql = "SELECT nome,telefone,tipo_foto,foto FROM funcionarios WHERE id= :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, $pdo::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir_id"])) {
                $excluir_id = $_POST["excluir_id"];

                $sql_excluir = "DELETE FROM funcionarios WHERE id = :id";

                $stmt_excluir = $pdo->prepare($sql_excluir_id);

                $stmt_excluir->bindParam(":id", $excluir_id, PDO::PARAM_INT);
                $stmt_excluir->execute();

                header("Location: consulta.php");
                exit();
            }

        }
    }

}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar funcionario</title>
</head>
<body>



<h1>Dados dos funcionarios</h1>
<p>Nome: <?htmlspecialchars($funcionario['nome'])?></p>
    
</body>
</html>