<?php
    require_once "model/Usuario.php";

    $jsonRecebidoBodyRequest = file_get_contents('php://input');
    $obj = json_decode($jsonRecebidoBodyRequest);

    $Usuario = $obj->Usuario;
    $Senha = $obj->Senha;

    $resposta = array();

    if ($Usuario == ""){

            $resposta['cod'] = 2;
            $resposta['msg'] = "Usuario não pode ser nulo";

    }else if ($Senha == ""){

            $resposta['cod'] = 3;
            $resposta['msg'] = "Senha não pode ser nula";

    }else{
        $usuario = new Usuario();

        $usuario->setUsuario($Usuario);
        $usuario->setSenha($Senha);
            

        $resultado = $usuario->cadastrar();
    
        if ($resultado == true) {
            header('HTTP/1.1 201 Created');
            $resposta['cod'] = 4;
            $resposta['msg'] = "Cadastrado com sucesso";
            $resposta['Usuario'] = $usuario;
        }else{
            header('HTTP/1.1 200 Ok');
            $resposta['cod'] = 5;
            $resposta['msg'] = "Erro ao cadastrar Usuario";
        }
    }

    echo json_encode($resposta);


?>