
<?php
    // CONFIGURAÇÃO DO BANCO DE DADOS
    $host = "localhost";
    $database = "armazena_imagens";
    $user = "root";
    $pass = "";

    try {
        // CONEXAO COM O BANCO USNADO 'PDO'
        $pdo = new PDO("mysql:host=$host; dbname=$database", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // RECUPERA TODOS OS FUNCIONARIOS DO BANCO DE DADOS
        $query = "SELECT id, nome FROM funcionarios";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC); // BUSCA TODOS OS RESULTADOS COMO UMA MATRIZ ASSOCIATIVA

        // VERIFICA SE FOI SOLICITADO A EXCLUSÃO DE UM FUNCIONARIO
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir_id'])) {
            $excluir_id = $_POST['excluir_id'];

            $query_exclusao = "DELETE FROM funcionarios WHERE id=:id";

            $stmt_exclusao = $pdo->prepare($query_exclusao);
            $stmt_exclusao->bindParam(':id', $excluir_id, PDO::PARAM_INT);
            $stmt_exclusao->execute();

            // REDIRECIONA PARA EVITAR REENVIO DO FORMUALRIO
            header('Location: '.$_SERVER['PHP_SELF']);
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: ".$e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Funcionarios</title>
</head>
<body>
    <h1>Consulta de Funcionários</h1>

    <ul>
        <?php foreach($funcionarios as $funcionario): ?>
            <li>
                <!-- O CÓDIGO ABAIXO CRIA LINK PARA VISUALIZAR DETALHES DO FUNCIONÁRIO -->
                <a href="visualizar_funcionario.php?id=<?= $funcionario['id'] ?>">
                    <?= htmlspecialchars($funcionario['nome' ])?>
                </a>
                
                <!-- FORMULARIO PARA EXCLUIR FUNCIONARIO -->
                 <form method="POST" style="display: inline;">
                    <input type="hidden" name="excluir_id" value="<?= $funcionario['id'] ?>">

                    <button type="submit">Excluir</button>
                 </form>
            </li>
            <?php endforeach; ?>
    </ul>
</body>
</html>
