<?php
// Habilita relatório detalhado de erros no MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function conectardb()
{
    $endereco = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "empresa";

    try {
        $con = new mysqli($endereco, $usuario, $senha, $banco);

        $con -> set_charset("utf8mb4"); // Para evitar problemas com acentuação
        return $con;
    } catch (Exception $e) {
        die("Erro na conexão" . $e->getMessage());

    }

    if ($result -> num_rows > 0) {

        while ($linha = $result -> fetch_assoc()) {
            echo"ID". $linha["id_cliente"] ."Nome". $row["nome"]."Email".$linha["email"]."<br/>";
        }
    } else {
        echo "Nenhum cliente cadastrado.";

        $conexao -> mysqli_close ();

}
}

?>