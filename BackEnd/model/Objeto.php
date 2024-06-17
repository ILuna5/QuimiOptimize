<?php

    require_once "Banco.php";

    class Objeto implements JsonSerializable{

        private $Codigo;
        private $Produto;

        public function jsonSerialize(){

            $json = array();
            $json['Codigo'] = $this->Codigo;
            $json['Produto'] = $this->Produto;
        
            return $json;
        }

        public function cadastrar(){

            $meuBanco = new Banco();
            $stm = $meuBanco->getConexao()->prepare(
            "INSERT INTO objeto (Codigo, Produto)
            VALUES
            (?, ?)");
    
            $stm-> bind_param("is", $this->Codigo, $this->Produto);
            $resposta = $stm->execute();
            $CodigoCadastrado = $meuBanco->getConexao()->insert_id;
            $this->Codigo = $CodigoCadastrado;
    
            return $resposta;
        }

        public function read(){

            $meuBanco = new Banco();
            $stm = $meuBanco->getConexao()->prepare(
            "SELECT * FROM Objeto");
            $stm->execute();
    
            $matrizObjeto = $stm->get_result();
            $i = 0;
            $vetorObjeto = array();
    
            while ($linha = mysqli_fetch_object($matrizObjeto)){
                
                $vetorObjeto[$i] = new Objeto();
                $vetorObjeto[$i]->setCodigo($linha->Codigo);
                $vetorObjeto[$i]->setProduto($linha->Produto);
    
                $i++;
            }
    
            return $vetorObjeto;
    
        }

        public function readProduto(){

            $meuBanco = new Banco();
    
            $Produto = $this->Produto;
    
            $stm = $meuBanco->getConexao()->prepare(
            "SELECT * FROM objeto where Produto = ?");
    
            $stm-> bind_param("s", $this->Produto);
            $stm->execute();
    
            $matrizClientes = $stm->get_result();
    
            while ($linha = mysqli_fetch_object($matrizClientes)){
                
                $this->setCodigo($linha->Codigo);
                $this->setProduto($linha->Produto);
                    
            }
        }

        public function delete(){

            $meuBanco = new Banco();
    
            $Produto = $this->Produto;
    
            $stm = $meuBanco->getConexao()->prepare(
            "DELETE FROM objeto WHERE (Produto = ?);
            ");
    
            $stm-> bind_param("s", $this->Produto);
            $stm->execute();
            
            return true;
        }


        /**
         * Get the value of Codigo
         */ 
        public function getCodigo()
        {
                return $this->Codigo;
        }

        /**
         * Set the value of Codigo
         *
         * @return  self
         */ 
        public function setCodigo($Codigo)
        {
                $this->Codigo = $Codigo;

                return $this;
        }

        /**
         * Get the value of Produto
         */ 
        public function getProduto()
        {
                return $this->Produto;
        }

        /**
         * Set the value of Produto
         *
         * @return  self
         */ 
        public function setProduto($Produto)
        {
                $this->Produto = $Produto;

                return $this;
        }
    }


?>