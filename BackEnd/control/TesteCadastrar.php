<?php
    require_once "model/Testes.php";

    $jsonRecebidoBodyRequest = file_get_contents('php://input');
    $obj = json_decode($jsonRecebidoBodyRequest);

    
    $Ph = $obj->Ph;
    $Viscosidade = $obj->Viscosidade;
    $Densidade = $obj->Densidade;
    $Ativo = $obj->Ativo;
    $Umidade = $obj->Umidade;
    $PontoDeFusao = $obj->PontoDeFusao;
    $SubstanciasEstranhas = $obj->SubstanciasEstranhas;
    $Obs = $obj->Obs;
    $Objeto_Codigo = $obj->Objeto_Codigo;

    $resposta = array();
    if ($Ph == ""){
        $resposta['cod'] = 9;
        $resposta['msg'] = "Ph não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($Viscosidade == ""){
        $resposta['cod'] = 10;
        $resposta['msg'] = "Viscosidade não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($Densidade == ""){
        $resposta['cod'] = 11;
        $resposta['msg'] = "Densidade não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($Ativo == ""){
        $resposta['cod'] = 12;
        $resposta['msg'] = "Ativo não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($Umidade == ""){
        $resposta['cod'] = 13;
        $resposta['msg'] = "Umidade não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($PontoDeFusao == ""){
        $resposta['cod'] = 14;
        $resposta['msg'] = "PontoDeFusao não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($SubstanciasEstranhas == ""){
        $resposta['cod'] = 15;
        $resposta['msg'] = "SubstanciasEstranhas não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($Obs == ""){
        $resposta['cod'] = 16;
        $resposta['msg'] = "Obs não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else if ($Objeto_Codigo == ""){
        $resposta['cod'] = 17;
        $resposta['msg'] = "Codigo Objeto não pode ser nulo, por favor insira um '-' nas informações que voce não for usar";
    }else{
        $testes = new Testes();

        $testes->setPh($Ph);
        $testes->setViscosidade($Viscosidade);
        $testes->setDensidade($Densidade);
        $testes->setAtivo($Ativo);
        $testes->setUmidade($Umidade);
        $testes->setPontoDeFusao($PontoDeFusao);
        $testes->setSubstanciasEstranhas($SubstanciasEstranhas);
        $testes->setObs($Obs);
        $testes->setCodigoObjeto($Objeto_Codigo);

        $resultado = $testes->cadastrar();
    
        if ($resultado == true) {
        header('HTTP/1.1 201 Created');
        $resposta['cod'] = 18;
        $resposta['msg'] = "Cadastrado com sucesso";
        $resposta['teste'] = $testes;
        }else{
        header('HTTP/1.1 200 Ok');
        $resposta['cod'] = 19;
        $resposta['msg'] = "Erro ao cadastrar Teste";
        }    
    }
    
    echo json_encode($resposta);

?>