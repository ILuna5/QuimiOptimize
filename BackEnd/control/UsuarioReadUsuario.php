<?php
require_once "model/Usuario.php";

$usuario = new Usuario();

$usuario->setUsuario($rota[3]);
$usuario->readUsuario();

header("HTTP/1.1 200 OK");
echo json_encode($usuario);

?>