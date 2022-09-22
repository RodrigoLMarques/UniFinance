<?php
    require_once "Banco.php";
    class Acao {
        private $idAcao;
        private $nome;
        private $symbol;
        private $open;
        private $high;
        private $low;
        private $price;
        private $volume;
        private $previousClose;
        private $change;
        private $changePercent;
        private $companyName;
        private $document;
        private $descricao;
        private $website;
        private $banco;

        public function __construct() {
            $this->banco = new Banco();
        }

        public function cadastrar() {
            $stmt = $this->banco->getConexao()->prepare("INSERT INTO acao (nome, symbol, `open`, high, low, price, volume, previous_close, `change`, change_percent, company_name, document, descricao, website) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdddddsddssss", $this->nome, $this->symbol, $this->open,  $this->high,  $this->low,  $this->price, $this->volume,  $this->previousClose,  $this->change,  $this->changePercent, $this->companyName, $this->document, $this->descricao, $this->website);
            $stmt->execute();
            $this->idUsuario = $this->banco->getConexao()->insert_id;
            return !$stmt->get_result();
        }

        public function atualizar(){
            $stmt =$this->banco->getConexao()->prepare("update moeda set nome, symbol, `open`, high, low, price, volume, previous_close, `change`, change_percent, company_name, document, descricao, website where symbol = ?");
            $stmt->bind_param("ssdddddsddsssss", $this->nome, $this->symbol, $this->open,  $this->high,  $this->low,  $this->price, $this->volume,  $this->previousClose,  $this->change,  $this->changePercent, $this->companyName, $this->document, $this->descricao, $this->website, $this->symbol);
            $stmt->execute();
        }

        public function listar($sql="") {
            $stmt = $this->banco->getConexao()->prepare("SELECT * FROM acao $sql");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $acoes = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)) {
                $acoes[$i] = new Acao();
                $acoes[$i]->setIdAcao($linha->idAcao);
                $acoes[$i]->setNome($linha->nome);
                $acoes[$i]->setSymbol($linha->symbol);
                $acoes[$i]->setOpen($linha->open);
                $acoes[$i]->setHigh($linha->high);
                $acoes[$i]->setLow($linha->low);
                $acoes[$i]->setPrice($linha->price);
                $acoes[$i]->setVolume($linha->volume);
                $acoes[$i]->setPreviousClose($linha->previous_close);
                $acoes[$i]->setChange($linha->change);
                $acoes[$i]->setChangePercent($linha->change_percent);
                $acoes[$i]->setCompanyName($linha->company_name);
                $acoes[$i]->setDocument($linha->document);
                $acoes[$i]->setDescricao($linha->descricao);
                $acoes[$i]->setWebsite($linha->website);
                $i++;
            }
            return $acoes;
        }

        public function getIdAcao() {
            return $this->idAcao;
        }

        public function setIdAcao($idAcao) {
            $this->idAcao = $idAcao;
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

        public function getOpen() {
            return $this->open;
        }

        public function setOpen($open) {
            $this->open = $open;
        }

        public function getHigh() {
            return $this->high;
        }

        public function setHigh($high) {
            $this->high = $high;
        }

        public function getLow() {
            return $this->low;
        }

        public function setLow($low) {
            $this->low = $low;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function getVolume() {
            return $this->volume;
        }

        public function setVolume($volume) {
            $this->volume = $volume;
        }

        public function getPreviousClose() {
            return $this->previousClose;
        }

        public function setPreviousClose($previousClose) {
            $this->previousClose = $previousClose;
        }

        public function getChange() {
            return $this->change;
        }

        public function setChange($change) {
            $this->change = $change;
        }

        public function getChangePercent() {
            return $this->changePercent;
        }

        public function setChangePercent($changePercent) {
            $this->changePercent = $changePercent;
        }

        public function getCompanyName() {
            return $this->companyName;
        }

        public function setCompanyName($companyName) {
            $this->companyName = $companyName;
        }

        public function getDocument() {
            return $this->document;
        }

        public function setDocument($document) {
            $this->document = $document;

            return $this;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function getWebsite() {
            return $this->website;
        }

        public function setWebsite($website) {
            $this->website = $website;
        }
    }
?>