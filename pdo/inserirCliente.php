<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Cliente</title>
    <link rel="stylesheet" href="style.css">
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
    </ul>>

    <div class="titulo">
        <h1>Página principal</h1>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="formularios">

        <h2>Cadastro de Cliente</h2>


        <form action="processarinsercao.php" method="post">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br>

            <label for="nome">Endereço:</label>
            <input type="text" id="nome" name="nome" required>
            <br>

            <label for="nome">Telefone:</label>
            <input type="text" id="nome" name="nome" required>
            <br>

            <label for="nome">Email:</label>
            <input type="email" id="nome" name="nome" required>
            <br>
            <br>

            <button type="submit">Cadastrar</button>
        </form>

    </div>

</body>

</html>