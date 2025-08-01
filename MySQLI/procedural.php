<?php
$nomeservidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedaodos = "empresa";

$conn = mysqli_connect("$nomeservidor", "$usuario", "$senha", "$bancodedaodos");

if (!$conn) {
    die("Conexão falhou" . mysqli_connect_error());
}

    mysqli_set_charset($conn, "utf8mb4");

    echo "Conexão bem-sucedida";


    $sql = "SELECT id_cliente, nome, email FROM cliente";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($linha = mysqli_fetch_assoc($result)) {
            echo "ID:" . $linha["id_cliente"] . "Nome:" . $linha["nome"] . "Email:" . $linha["email"] . "<br>";
        }
    } else {
        echo "Nenhum resultado encontrado";

        mysqli_close($conn);


    }



?>