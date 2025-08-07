<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionario</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container">
        <h1>Cadastros</h1>
        <h2>funcionarios</h2>
        <!--Formulario para cadadastrar um funcionario-->
        <form action="salvar_funcionario.php" method="post" enctype="multipart/form-data"></form>
        <label for="name">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <br>

        <label for="name">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required>
        <br>
        <br>

        <label for="name">Foto:</label>
        <input type="text" name="foto" id="foto" required>
        <br>
        <br>

        <button type="submit">Cadastrar</button>
    </div>


</body>

</html>