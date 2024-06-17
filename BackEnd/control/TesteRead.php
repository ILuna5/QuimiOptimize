<?php
require_once "model/TesteProcura.php";

$testes = new TesteProcura();

$arrayResposta = $testes->read();

header("HTTP/1.1 200 OK");
echo json_encode($arrayResposta);

?>