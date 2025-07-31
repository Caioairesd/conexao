<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h1>Caio Vinicius Aires da Silva</h1>

        <br>

        <h2>Formulário inseguro</h1>

            <form action="login_inseguro.php" method="post">
                <input type="text" name="nome" placeholder="digite seu nome">
                <button type="submit">Entrar</button>



            </form>

            <br>
            <br>
            <br>
            <br>

            <h2>Formulário seguro</h1>

                <form action="login_seguro.php" method="post">
                    <input type="text" name="nome" placeholder="digite seu nome">
                    <button type="submit">Entrar</button>
                </form>

    </center>

</body>

</html>