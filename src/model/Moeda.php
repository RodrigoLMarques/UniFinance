<?php 
    require_once("Banco.php"); 
    class Moeda {
        private $idMoeda;
        private $nome;
        private $symbol;
        private $buy;
        private $sell;
        private $variation;
        private $pctVariation;
        private $banco;

        public function __construct() {
            $this->banco = new Banco();
        }

        public function cadastrar() {
            $stmt = $this->banco->getConexao()->prepare("INSERT INTO moeda (nome, symbol, buy, sell, variation, pctVariation) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssdddd", $this->nome, $this->symbol, $this->buy, $this->sell, $this->variation, $this->pctVariation);
            $stmt->execute();
            $this->idUsuario = $this->banco->getConexao()->insert_id;
            return !$stmt->get_result();
        }

        public function atualizar(){
            $stmt =$this->banco->getConexao()->prepare("update moeda set nome=?, symbol=?, buy=?, sell=?, variation=?, pctVariation=? where symbol = ?");
            $stmt->bind_param("ssdddd", $this->nome, $this->symbol, $this->buy, $this->sell, $this->variation, $this->pctVariation, $this->symbol);
            $stmt->execute();
        }

        public function listar($sql="") {
            $stmt = $this->banco->getConexao()->prepare("SELECT * FROM moeda $sql");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $moedas = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)) {
                $moedas[$i] = new Moeda();
                $moedas[$i]->setIdMoeda($linha->idMoeda);
                $moedas[$i]->setNome($linha->nome);
                $moedas[$i]->setSymbol($linha->symbol);
                $moedas[$i]->setBuy($linha->buy);
                $moedas[$i]->setSell($linha->sell);
                $moedas[$i]->setVariation($linha->variation);
                $moedas[$i]->setPctVariation($linha->variation);
                $i++;
            }
            return $moedas;
        }

        public function getIdMoeda() {
            return $this->idMoeda;
        }
 
        public function setIdMoeda($idMoeda) {
                $this->idMoeda = $idMoeda;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getSymbol() {
            return $this->symbol;
        }

        public function setSymbol($symbol) {
            $this->symbol = $symbol;
        }

        public function getBuy()
        {
            return $this->buy;
        }

        public function setBuy($buy) {
            $this->buy = $buy;
        }

        public function getSell() {
            return $this->sell;
        }

        public function setSell($sell) {
            $this->sell = $sell;
        }

        public function getVariation() {
            return $this->variation;
        }

        public function setVariation($variation) {
            $this->variation = $variation;
        }

        public function getPctVariation() {
            return $this->pctVariation;
        }

        public function setPctVariation($pctVariation) {
            $this->pctVariation = $pctVariation;
        }
    }
?>