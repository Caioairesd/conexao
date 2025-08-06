<?php

//Inclui arquivo de conexao com o banco de dados
require_once("conecta.php");

//Cria a consulta sql para selecionar o dados principais (sem coluna imagem)
$querySelecao = "SELECT codigo,evento,descricao,nome_imagem,tamanho_imagem FROM tabela_imagens ";

$resultado = mysqli_query($conexao, $querySelecao);

if (!$resultado) {
    die("Erro na consulta." . mysqli_error($conexao));

}

?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aramazenamento de imagens no BD Mysql </title>
</head>

<body>
    <h2>Selecione um novo arquivo de imagem</h2>
    <form enctype="multipart/form-data" action="upload.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="999999999">
        <input type="text" name="evento" placeholder="nome do evento">
        <input type="text" name="descricao" placeholder="Descrição">
        <input type="file" name="imagem">
        <input type="submit" value="Salvar">
    </form>

    <br>

    <table border="1">
        <tr>
            <td align="center">Código</td>
            <td align="center">Eventos</td>
            <td align="center">Descrição</td>
            <td align="center">Nome da imagem</td>
            <td align="center">Tamanho/td</td>
            <td align="center">Vizualizar imagem</td>
            <td align="center">Excluir imagem</td>
        </tr>


</body>

</html>

<?php
while ($arquivos = mysqli_fetch_array($resultado)) { ?>

    <tr>
        <td align="center"><?php echo $arquivos['codigo'] ?></td>
        <td align="center"><?php echo $arquivos['evento'] ?></td>
        <td align="center"><?php echo $arquivos['descricao'] ?></td>
        <td align="center"><?php echo $arquivos['nome_imagem'] ?></td>
        <td align="center"><?php echo $arquivos['tamanho_imagem'] ?></td>
        <td align="center"><a href="ver_imagens.php?id=<?php echo $arquivos['codigo']; ?>">Visualizar imagens</a></td>
        <td align="center"><a href="excluir_imagem.php?id=<?php echo $arquivos['codigo']; ?>">Excluir</a></td>


    </tr>
 



<?php } ?>

    </table>