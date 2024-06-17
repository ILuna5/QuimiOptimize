<?php

    require_once "Banco.php";

    class TesteProcura implements JsonSerializable{

        private $Produto;
        private $Ph;
        private $Viscosidade;
        private $Densidade;
        private $Ativo;
        private $Umidade;
        private $PontoDeFusao;
        private $SubstanciasEstranhas;
        private $Obs;

        public function jsonSerialize(): mixed{

            $array = array();
            $array['Produto'] = $this->Produto;
            $array['Ph'] = $this->Ph;
            $array['Viscosidade'] = $this->Viscosidade;
            $array['Densidade'] = $this->Densidade;
            $array['Ativo'] = $this->Ativo;
            $array['Umidade'] = $this->Umidade;
            $array['PontoDeFusao'] = $this->PontoDeFusao;
            $array['SubstanciasEstranhas'] = $this->SubstanciasEstranhas;
            $array['Obs'] = $this->Obs;

            return $array;
        }

        public function read(){

            $meuBanco = new Banco();
            $stm = $meuBanco->getConexao()->prepare(
            "SELECT * FROM consultatotal");
            $stm->execute();
    
            $matrizTestes = $stm->get_result();
            $i = 0;
            $vetorTestes = array();
    
            while ($linha = mysqli_fetch_object($matrizTestes)){
                
                $vetorTestes[$i] = new TesteProcura();
                $vetorTestes[$i]->setProduto($linha->Produto);
                $vetorTestes[$i]->setPh($linha->Ph);
                $vetorTestes[$i]->setViscosidade($linha->Viscosidade);
                $vetorTestes[$i]->setDensidade($linha->Densidade);
                $vetorTestes[$i]->setAtivo($linha->Ativo);
                $vetorTestes[$i]->setUmidade($linha->Umidade);
                $vetorTestes[$i]->setPontoDeFusao($linha->PontoDeFusao);
                $vetorTestes[$i]->setSubstanciasEstranhas($linha->SubstanciasEstranhas);
                $vetorTestes[$i]->setObs($linha->Obs);
    
                $i++;
            }
    
            return $vetorTestes;
    
        }

        public function readProduto(){

            $meuBanco = new Banco();
    
            $Produto = $this->Produto;
    
            $stm = $meuBanco->getConexao()->prepare(
            "SELECT * FROM consultatotal where Produto = ?");
    
            $stm-> bind_param("s", $this->Produto);
            $stm->execute();
    
            $matrizTestes = $stm->get_result();
    
            while ($linha = mysqli_fetch_object($matrizTestes)){
                
                $this->setProduto($linha->Produto);
                $this->setPh($linha->Ph);
                $this->setViscosidade($linha->Viscosidade);
                $this->setDensidade($linha->Densidade);
                $this->setAtivo($linha->Ativo);
                $this->setUmidade($linha->Umidade);
                $this->setPontoDeFusao($linha->PontoDeFusao);
                $this->setSubstanciasEstranhas($linha->SubstanciasEstranhas);
                $this->setObs($linha->Obs);
    
            }
        }



 


        /**
         * Get the value of Ph
         */ 
        public function getPh()
        {
                return $this->Ph;
        }

        /**
         * Set the value of Ph
         *
         * @return  self
         */ 
        public function setPh($Ph)
        {
                $this->Ph = $Ph;

                return $this;
        }

        /**
         * Get the value of Viscosidade
         */ 
        public function getViscosidade()
        {
                return $this->Viscosidade;
        }

        /**
         * Set the value of Viscosidade
         *
         * @return  self
         */ 
        public function setViscosidade($Viscosidade)
        {
                $this->Viscosidade = $Viscosidade;

                return $this;
        }

        /**
         * Get the value of Densidade
         */ 
        public function getDensidade()
        {
                return $this->Densidade;
        }

        /**
         * Set the value of Densidade
         *
         * @return  self
         */ 
        public function setDensidade($Densidade)
        {
                $this->Densidade = $Densidade;

                return $this;
        }

        /**
         * Get the value of Ativo
         */ 
        public function getAtivo()
        {
                return $this->Ativo;
        }

        /**
         * Set the value of Ativo
         *
         * @return  self
         */ 
        public function setAtivo($Ativo)
        {
                $this->Ativo = $Ativo;

                return $this;
        }

        /**
         * Get the value of Umidade
         */ 
        public function getUmidade()
        {
                return $this->Umidade;
        }

        /**
         * Set the value of Umidade
         *
         * @return  self
         */ 
        public function setUmidade($Umidade)
        {
                $this->Umidade = $Umidade;

                return $this;
        }

        /**
         * Get the value of PontoDeFusao
         */ 
        public function getPontoDeFusao()
        {
                return $this->PontoDeFusao;
        }

        /**
         * Set the value of PontoDeFusao
         *
         * @return  self
         */ 
        public function setPontoDeFusao($PontoDeFusao)
        {
                $this->PontoDeFusao = $PontoDeFusao;

                return $this;
        }

        /**
         * Get the value of SubstanciasEstranhas
         */ 
        public function getSubstanciasEstranhas()
        {
                return $this->SubstanciasEstranhas;
        }

        /**
         * Set the value of SubstanciasEstranhas
         *
         * @return  self
         */ 
        public function setSubstanciasEstranhas($SubstanciasEstranhas)
        {
                $this->SubstanciasEstranhas = $SubstanciasEstranhas;

                return $this;
        }

        /**
         * Get the value of Obs
         */ 
        public function getObs()
        {
                return $this->Obs;
        }

        /**
         * Set the value of Obs
         *
         * @return  self
         */ 
        public function setObs($Obs)
        {
                $this->Obs = $Obs;

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