<?php
// INFORMAÇÕES DO BANCO DE DADOS
    $host = "localhost";
    $database = "armazena_imagens";
    $user = "root";
    $pass = "";

    try {
        // CONEXAO COM O BANCO USNADO 'PDO'
        $pdo = new PDO("mysql:host=$host; dbname=$database", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "SELECT nome, telefone, tipo_foto, foto FROM funcionarios WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluir_id'])) {
                    $excluir_id = $_POST['excluir_id'];

                    $query_exclusao = "DELETE FROM funcionarios WHERE id = :id";

                    $stmt_exclusao = $pdo->prepare($query_exclusao);
                    $stmt_exclusao->bindParam(":id", $excluir_id, PDO::PARAM_INT);
                    $stmt_exclusao->execute();

                    header('Location: consulta_funcionario.php');
                    exit();
                }
                ?>
                
                <!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Visualizar Funcionário</title>
                </head>
                <body>
                    <h1>Visualizar Funcionário</h1>

                    <p>Nome: <?= htmlspecialchars($funcionario['nome']) ?></p>
                    <p>Telefone: <?= htmlspecialchars($funcionario['telefone']) ?></p>
                    <p>Tipo foto: <?= htmlspecialchars($funcionario['tipo_foto']) ?></p>
                    <p>Foto:</p>
                    <img src="data:<?=$funcionario['tipo_foto']?>;base64,<?=base64_encode($funcionario['foto'])?>" alt="Foto do funcionário">

                    <form method="POST">
                        <input type="hidden" name="excluir_id" value="<?= $id ?>">

                        <button type="submit">Excluir Funcionário</button>
                    </form>
                </body>
                </html>

                <?php

                
            } else {
                echo "Funcionário não encontrado!";
            }
        } else {
            echo "ID do funcinário não foi fornecido!";
        }
    } catch (PDOException $e) {
        echo "Erro: ".$e->getMessage();
    }
?>