<?php
require_once"conexao.php";

$conexao = conectarBanco();

$busca = $_GET["busca"]??'';

if (!$busca) {


?>
<form action="pesquisarCliente.php" method="get">
    <label for="busca">Digite o ID ou Nome:</label>
    <input type="text" id="id" name="busca" required>
    <button  type="submit">Pesquisar</button>

</form>

<?php
exit;
}

//Escolha entre o ID e o Nome e faz a consulta diretamente

if(is_numeric($busca)) {
    $stmt = $conexao->prepare('SELECT id_cliente,nome,endereco,telefone,email FROM cliente WHERE id_cliente = :id');
    $stmt->bindparam(':id', $busca,pdo::PARAM_INT);
}else{









    
}