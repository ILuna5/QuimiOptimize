<?php

    require_once "Banco.php";

    class Usuario implements JsonSerializable{

        private $Usuario;
        private $Senha;

        public function jsonSerialize(){

            $json = array();
            $json['Usuario'] = $this->Usuario;
            $json['Senha'] = $this->Senha;
        
            return $json;
        }

        public function cadastrar(){

            $meuBanco = new Banco();
            $stm = $meuBanco->getConexao()->prepare(
            "INSERT INTO cadastro (Usuario, Senha)
            VALUES
            (?, ?)");
    
            $stm-> bind_param("ss", $this->Usuario, $this->Senha);
            $resposta = $stm->execute();
            $UsuarioCadastrado = $meuBanco->getConexao()->insert_Usuario;
            $this->Usuario = $UsuarioCadastrado;
    
            return $resposta;
        }

        public function read(){

            $meuBanco = new Banco();
            $stm = $meuBanco->getConexao()->prepare(
            "SELECT * FROM cadastro order by Usuario");
            $stm->execute();
    
            $matrizUsuario = $stm->get_result();
            $i = 0;
            $vetorUsuario = array();
    
            while ($linha = mysqli_fetch_object($matrizUsuario)){
                
                $vetorUsuario[$i] = new Usuario();
                $vetorUsuario[$i]->setUsuario($linha->Usuario);
                $vetorUsuario[$i]->setSenha($linha->Senha);               
    
                $i++;
            }
    
            return $vetorUsuario;
    
        }
    
        public function readUsuario(){
    
            $meuBanco = new Banco();
    
            $Usuario = $this->Usuario;
    
            $stm = $meuBanco->getConexao()->prepare(
            "SELECT * FROM cadastro where Usuario = ?");
    
            $stm-> bind_param("i", $this->Usuario);
            $stm->execute();
    
            $matrizUsuario = $stm->get_result();
    
            while ($linha = mysqli_fetch_object($matrizUsuario)){
                
                $this->setUsuario($linha->Usuario);
                $this->setSenha($linha->Senha);
                    
            }
        }



        /**
         * Get the value of Usuario
         */ 
        public function getUsuario()
        {
                return $this->Usuario;
        }

        /**
         * Set the value of Usuario
         *
         * @return  self
         */ 
        public function setUsuario($Usuario)
        {
                $this->Usuario = $Usuario;

                return $this;
        }

        /**
         * Get the value of Senha
         */ 
        public function getSenha()
        {
                return $this->Senha;
        }

        /**
         * Set the value of Senha
         *
         * @return  self
         */ 
        public function setSenha($Senha)
        {
                $this->Senha = $Senha;

                return $this;
        }
    }


?>