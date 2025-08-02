<?php
require_once 'conexao.php';

$conexao = conectarBanco();

// Consulta todos os clientes do banco
// Ordena por nome para melhor visualização
$sql = "SELECT id_cliente, nome, endereco, telefone, email FROM cliente ORDER BY nome ASC";

$stmt = $conexao->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Clientes</title>
</head>

<body>
<ul>

<li><a href="Menu.html">Inicio</a>
<li><a href="#">Novidade</a>
<li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Clientes</a>
    <div class="dropdown-content">
        <a href="inserirCliente.php">Novo Cliente </a>
        <a href="atualizaCliente.php">Atualizar Cliente</a>
        <a href="pesquisarCliente.php">Pesquisar cliente</a>
        <a href="listarCliente.php">Listar clientes</a>
        <a href="deletarCliente.php">Deletar cliente</a>
    </div>
</li>
</ul>
    <div class="titulo">
    <h2>Todos os Clientes Cadastrados</h2>
    </div>

    <?php if (!$clientes): ?>
        <p style="color: red;">Nenhum cliente encontrado no banco de dados.</p>
    <?php else: ?>
        <table border>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereco</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($clientes as $cliente): ?>

                <tr>
                    <td><?= htmlspecialchars($cliente["id_cliente"]) ?></td>
                    <td><?= htmlspecialchars($cliente["nome"]) ?></td>
                    <td><?= htmlspecialchars($cliente["endereco"]) ?></td>
                    <td><?= htmlspecialchars($cliente["telefone"]) ?></td>
                    <td><?= htmlspecialchars($cliente["email"]) ?></td>
                    <td>
                        <a href="atualizarCliente.php?id=<? $cliente['id_cliente'] ?>">Editar</a>


                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>



</body>

</html>