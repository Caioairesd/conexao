<?php
    //Definição das credenciais de conexão
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "armazena_imagem";

    //Criando a conexao usando mysqli

    $conexao = new mysqli($servername, $username, $password, $dbname);

    //Verficando se houve erro na conexao

    if ($conexao->connect_error) {
        die("Falha na conexaão: ".$conexao->connect_error);


    }



?>