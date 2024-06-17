<?php
require_once "model/TesteProcura.php";

$testes = new TesteProcura();

$testes->setProduto($rota[3]);
$testes->readProduto();

header("HTTP/1.1 200 OK");
echo json_encode($testes);

?>