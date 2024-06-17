<?php
require_once "model/Objeto.php";

$Objeto = new Objeto();

$Objeto->setProduto($rota[3]);
$Objeto->readProduto();

header("HTTP/1.1 200 OK");
echo json_encode($Objeto);

?>