<?php
    require_once "model/Objeto.php";
    $jsonRecebidoBodyRequest = file_get_contents('php://input');
    $obj = json_decode($jsonRecebidoBodyRequest);

    $Codigo = $obj->Codigo;
    $Produto = $obj->Produto;

    $resposta = array();
    if ($Produto == ""){
        $resposta['cod'] = 6;
        $resposta['msg'] = "Produto não pode ser nulo";
    }else{
        $Objeto = new Objeto();

        $Objeto->setCodigo($Codigo);
        $Objeto->setProduto($Produto);

        $resultado = $Objeto->cadastrar();
    
        if ($resultado == true) {
            header('HTTP/1.1 201 Created');
            $resposta['cod'] = 7;
            $resposta['msg'] = "Cadastrado com sucesso";
            $resposta['cliente'] = $Objeto;
        }else{
            header('HTTP/1.1 200 Ok');
            $resposta['cod'] = 8;
            $resposta['msg'] = "Erro ao cadastrar Objeto";
    }
    }

    echo json_encode($resposta);

?>