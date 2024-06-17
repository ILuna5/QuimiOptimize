<?php
require_once "model/Objeto.php";

$objeto = new Objeto();

$arrayResposta = $objeto->read();

header("HTTP/1.1 200 OK");
echo json_encode($arrayResposta);

?>