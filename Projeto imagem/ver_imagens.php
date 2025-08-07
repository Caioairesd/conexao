<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ob_clean(); // LIMPA QUALQUER SAÍDA INESPERADA ANTES DO HEADER

    // INCLUI A CONEXÃO COM O BANDO DE DADOS
    require_once 'conecta.php';

    // OBTÉM O ID DA IMAGEM DA URL, GARANTINDO QUE SEJA UM NÚMERO INTEIRO
    $id_imagem = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // CRIA A CONSULTA PARA BUSCAR A IMAGEM NO BANCO DE DADOS
    $query_select = "SELECT imagem, tipo_imagem FROM tabela_imagens WHERE codigo = ?";

    // CRIA A SEGURANÇA UTILIZANDO 'prepared statement' PARA MAIOR SEGURANÇA
    $stmt = $conexao->prepare($query_select);
    $stmt->bind_param("i", $id_imagem);
    $stmt->execute();

    $resultado = $stmt->get_result();

    // VERIFICAR SE A IMAGEM EXISTE NO BANCO DE DADOS
    if ($resultado->num_rows > 0) {
        $imagem = $resultado->fetch_object();
        
        // DEFINE O TIPO CORRETO DA IMAGEM ('fallback' PARA 'jpeg' CASO ESTEJA VAZIO)
        $tipo_imagem = !empty($imagem->tipo_imagem) ? $imagem->tipo_imagem: "image/jpeg";
        header("Content-type:".$tipo_imagem);

        // EXIBE A IMAGEM ARMAZENADA NO BANCO DE DADOS
        echo $imagem->imagem;
    } else {
        echo "Imagem não encontrada!";
    }

    // FECHA A CONSULTA
    $stmt->close();
?>