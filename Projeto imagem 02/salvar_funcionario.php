<?php
function redimensionar($imagem, $largura, $altura)
{
    //Obtém as dimensões originais da imagem 
    //Getimagesize() Retorna a largura e altura de uma imagem

    list($largura, $alturaOriginal, $larguraOriginal) = getimagesize($imagem);

    //Cria uma nova imagem de acordo com as novas dimensões
    //imagecreatetruecolor = cria uma nova imagem em branco com alta qualidade


    $nova_imagem = imagecreatetruecolor($largura, $largura);

    //Carrega a imagem origina (jpeg) a partir do arquivp 
    //imagecreatefromjpeg() cria a imagem php

    $imagemOriginal = imagecreatefromjpeg($imagem);

    //copia e redmensiona a imagem original para a nova 
    //imagecopyresampled()-- copia o redimensionamento e suavização

    imagecopyresampled($nova_imagem, $imagemOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);

    //Inicia um buffer para guardar a imagem com texto binário
    //ob-start()-- iniciar o "output buffering" guardando a saida

    ob_start();

    //imagejep()Envia a imagem para o output(que vai pro buffer)

    imagejpeg($nova_imagem);

    //Ob_get_clean() -- Pegar o conteudo do buffer e limpa
    $dadosImagem = ob_clean();

    //Libera a memória usada pelas imagens
    //imagedestroy() -- limpa a memoria da imagem criada
    imagedestroy($nova_imagem);
    imagedestroy($imagemOriginal);

    //Retorna a imagem redmensionada em formato binario
    return $dadosImagem;

}

//Configuraçao do banco de dados
$host = 'localhost';
$dbname = 'armazena_imagem';
$username = 'root';
$password = '';

try {
    //Conexao com o banco usando pdo
    $pdo = new pdo("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["foto"])) {
        if ($_FILES["foto"]["error"] == 0) {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $nomeFoto = $_FILES['foto']['name']; // Pega o nome original do arquivo
            $tipoFoto = $_FILES['foto']['type']; // Pega o tipo mime do arquivo


            //Redimensiona a imagem
            $foto = redimensionar($_FILES['foto']['tmp_name'], 300, 400);

            //insere no banco dados usando o SQL prepared
            $sql = 'INSERT INTO funcionarios(nome,telefone,nome_foto,tipo_foto,foto)
        values(:nome,:telefone,:nome_foto,:tipo_foto,:foto)';

            $stmt = $pdo->prepare($sql);

            //Liga os parametros às variáveis
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':nome_foto', $nomeFoto);
            $stmt->bindParam(':tipo_foto', $tipoFoto);

            $stmt->bindParam(':foto', $foto, $pdo::PARAM_LOB); //Lob = large Object Usado apra dados binários como imagem

            if ($stmt->execute()) {
                echo 'Funcionario cadastrado com sucesso!';
            } else {
                echo 'Erro ao fazer o upload da foto! código' . $_FILES['foto']['error'];
            }


        }
    }
} catch (PDOException $e) {
    echo 'error' . $e->getMessage();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de imagens</title>

</head>

<body>

    <h1>Lista de imagens</h1>
    <a href="consulta_funcionario.php">Listar funcionarios</a>

</body>

</html>