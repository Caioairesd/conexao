<?php
    // FUNÇÃO PARA DIMENSIONAR A IMAGEM
    function redimensionar_imagem($imagem, $largura, $altura) {
        // OBTÉM AS DIMENSÕES ORIGINAIS DA IMAGEM
        // getimagesize() -- RETORNA A LARGURA E ALTURA DE UMA IMAGEM
        list($largura_original, $altura_original) = getimagesize($imagem);

        // CRIA UMA NOVA IMAGEM EM BRANCO COM AS NOVAS DIMENSOES
        // imagecreatetruecolor() -- CRIA UMA NOVA IMAGEM EM BRANCO COM ALTA QUALIDADE
        $nova_imagem = imagecreatetruecolor($largura, $altura);

        // CARREGA A IMAGEM ORIGINAL (jpeg) A PARTIR DO ARQUIVO
        // imagecreatefromjpeg() -- CRIA A IMAGEM PHP A PARTIR DE UM JPEG
        $imagem_original = imagecreatefromjpeg($imagem);

        // COPIA E REDIMENSIONA A IMAGEM ORIGINAL PARA A NOVA
        // imagecopyresampled() -- CÓPIA E REDIMENSIONAMENTO E SUAVIZAÇÃO 
        imagecopyresampled($nova_imagem, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);

        // INICIA UM BUFFER PARA GUARDAR A IMAGEM COMO TEXTO BINÁRIO
        // ob_start() -- INICIA O "output buffering" GUARDANDO A SAIDA
        ob_start();

        // imagejpeg() ENVIA A IMAGEM PARA O OUTPUT (que vai pro BUFFER)
        imagejpeg($nova_imagem);

        // ob_get_clean() -- PEGA O CONTEUDO DO BUFFER E LIMPA
        $dados_imagem = ob_get_clean();

        // LIBERA A MEMORIA USADA PELAS IMAGENS
        // imagedestroy() -- LIMPA A MEMORIA DA IMAGEM CRIADA
        imagedestroy($nova_imagem);
        imagedestroy($imagem_original);

        // RETORNA A IMAGEM REDIMENSIONADA EM FORMATO BINARIO
        return $dados_imagem;
    }

    $host = "localhost";
    $database = "armazena_imagens";
    $user = "root";
    $pass = "";

    try {
        // CONEXAO COM O BANCO USNADO 'PDO'
        $pdo = new PDO("mysql:host=$host; dbname=$database", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {

            if($_FILES['foto']['error'] == 0) {
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $nome_foto = $_FILES['foto']['name']; // PEGA O NOME ORIGINAL DO ARQUIVO
                $tipo_foto = $_FILES['foto']['type']; // PEGA O TIPO mime DA IMAGEM

                // REDIMENSIONA A IMAGEM
                // O CODIGO ABAIXO CUJA VARIAVEL É 'tmp_name" É O CAMINHO TEMPORÁRIO DO ARQUIVO
                $foto = redimensionar_imagem($_FILES['foto']['tmp_name'], 300, 400);

                // INSERE NO BANCO DE DADOS USANDO O SQL PREPARED
                $query = "INSERT INTO funcionarios (nome, telefone, nome_foto, tipo_foto, foto) VALUES (:nome, :telefone, :nome_foto, :tipo_foto, :foto)";
                
                $stmt = $pdo->prepare($query); // RESPONSÁVEL POR PREPARAR A QUERY PARA EVITAR ATAQUES SQL INJECTION

                $stmt->bindParam(':nome', $nome); // LIGA OS PARAMETROS AS VARIAVEIS
                $stmt->bindParam(':telefone', $telefone); // LIGA OS PARAMETROS AS VARIAVEIS
                $stmt->bindParam(':nome_foto', $nome_foto); // LIGA OS PARAMETROS AS VARIAVEIS
                $stmt->bindParam(':tipo_foto', $tipo_foto); // LIGA OS PARAMETROS AS VARIAVEIS
                $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB); // 'LOB' = Large Object, USADO PARA DADOS BINARIOS COMO IMAGEM

                if ($stmt->execute()) {
                    echo "Funcionário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o funcionário.";
                }
            } else {
                echo "Erro ao fazer upload da foto! Código: ".$_FILES['foto']['error'];
            }
        }
    } catch(PDOException $e) {
        echo "Erro: ".$e->getMessage(); // MOSTRA O ERRO (SE HOUVER)
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Imagens</title>
</head>
<body>
    <h1>Lista de Imagens</h1>

    <a href="consulta_funcionario.php">Listar Funcionários</a>
</body>
</html>