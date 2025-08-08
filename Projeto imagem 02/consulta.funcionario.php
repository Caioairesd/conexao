<?php
//Configuraçao do banco de dados
$host = 'localhost';
$dbname = 'armazena_imagem';
$username = 'root';
$password = '';

try {
    //Conexao com o banco usando pdo
    $pdo = new pdo("mysql:host=$host;dbname:$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //recupera todos os funcionarios
    $sql = "SELECT id,nome FROM funcionarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC); //Busca todos os funcionários como uma matriz associativa

    //Verifiva se foi solicitado a exclusão de um funcionário

    if ($_SERVER["REQUET_METHOD"] == "POST" && isset($_POST["excluir_id"])) {
        $excluir_id = $_POST["excluir_id"];
        $sql_excluir = "DELETE FROM funcionarios WHERE  id=:id";
        $stmt_excluir->bindParam(":id");
        $stmt_excluir->bindParam(":id", $excluir_id, PDO::PARAM_INT);
        $stmt_excluir->execute();


        //Redireciona para evitar reenvio do formulario
        header("Location" . $_SERVER["PHP_SELF"]);
        exit();

    }
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();

}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de funcionários</title>
</head>

<body>

    <h1>Consulta de Funcionários</h1>

    <!-- Código abaixo responsável por exibir os dados do funcionario desejado  -->

    <ul>
        <?php foreach ($funcionarios as $funcionario): ?>
            <li>
                <a href="visualizar_funcionarios.php?id=<? $funcionario['id'] ?>">
                    <?= htmlspecialchars($funcionarios["nome"]) ?>
                </a>



                <!-- Formulario para excluir funcionario  -->

                <form action="POST" style="display: inline;">
                    <input type="hidden" name="excluir_id" value="<?= $funcionario['id'] ?>">
                    <button type="submit"> Excluir</button>



                </form>
            </li>
        <?php endforeach; ?>


    </ul>

</body>

</html>