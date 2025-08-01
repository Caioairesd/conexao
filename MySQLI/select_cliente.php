<?php
require_once"conexao.php";

$conexao = conectardb();

$sql = "SELECT id_cliente, nome, email FROM cliente";

$result = $conexao->query($sql);


?>