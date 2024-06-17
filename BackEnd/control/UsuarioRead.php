<?php
require_once "model/Usuario.php";

$usuario = new Usuario();

$arrayResposta = $usuario->read();

header("HTTP/1.1 200 OK");
echo json_encode($arrayResposta);

?>