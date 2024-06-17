<?php

Class Banco{

    private $host = "127.0.0.1";
    private $usuario = "root";
    private $senha = "1234567";
    private $banco = "quimioptimize";
    private $port = "3306";
    private $con=null;

    public function conectar(){
        $this->con = new mysqli($this->host, $this->usuario, $this->senha, $this->banco, $this->port);

        if ($this->con->connect_error) {
            $arrayResposta['status'] = "error";
            $arrayResposta['cod'] = "1";
            $arrayResposta['msg'] = "Erro ao estabelecr conexao";
            echo json_encode($arrayResposta);
            die();
        }

    }

    public function getConexao(){
        if ($this->con == null) {
            $this-> conectar();
        }
        return $this->con;
    }

}

?>