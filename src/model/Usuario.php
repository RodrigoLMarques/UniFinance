<?php 
    require_once("Banco.php"); 
    class Usuario {
        private $idUsuario;
        private $username;
        private $email;
        private $senha;
        private $banco;

        public function __construct($usuario="") {
            $this->banco = new Banco();
            if ($usuario != "") {
                return $this->buscarPorId($usuario);
            }
        }

        public function cadastrar() {
            $stmt = $this->banco->getConexao()->prepare("INSERT INTO usuario (username, email, senha) VALUES (?,?,?)");
            $stmt->bind_param("sss", $this->username, $this->email, $this->senha);
            $stmt->execute();
            $this->idUsuario = $this->banco->getConexao()->insert_id;
            return !$stmt->get_result();
        }

        public function listar($sql="") {
            $stmt = $this->banco->getConexao()->prepare("SELECT * FROM usuario $sql");
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuarios = array();
            $i = 0;
            while ($linha = mysqli_fetch_object($resultado)) {
                $usuarios[$i] = new Usuario();
                $usuarios[$i]->setIdUsuario($linha->idUsuario);
                $usuarios[$i]->setUsername($linha->username);
                $usuarios[$i]->setEmail($linha->email);
                $usuarios[$i]->setSenha($linha->senha);
                $i++;
            }
            return $usuarios;
        }

        public function buscarPorId($id) {
            $stmt = $this->banco->getConexao()->prepare("SELECT * FROM usuario WHERE idusuario = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()) { 
                $this->setIdUsuario($linha->idUsuario);
                $this->setUsername($linha->username);
                $this->setEmail($linha->email);
            }
            return $this;     
        }

        public function buscarPorEmail($email) {
            $stmt = $this->banco->getConexao()->prepare("SELECT * FROM usuario WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()) { 
                $this->setIdUsuario($linha->idUsuario);
                $this->setUsername($linha->username);
                $this->setEmail($linha->email);
                $this->setSenha($linha->senha);
            }
            return $this;     
        }

        public function buscarPorUsername($username) {
            $stmt = $this->banco->getConexao()->prepare("SELECT * FROM usuario WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while ($linha = $resultado->fetch_object()) { 
                $this->setIdUsuario($linha->idUsuario);
                $this->setUsername($linha->username);
                $this->setEmail($linha->email);
                $this->setSenha($linha->senha);
            }
            return $this;     
        }

        public function validarLogin() {
            $stmt = $this->banco->getConexao()->prepare("SELECT count(*) as qtd from usuario WHERE username = ? and senha = ?");
            $stmt->bind_param("ss", $this->username, $this->senha);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado->fetch_object()->qtd > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function validarUsername() {
            $stmt = $this->banco->getConexao()->prepare("SELECT count(*) as qtd from usuario WHERE username = ?");
            $stmt->bind_param("s", $this->username);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado->fetch_object()->qtd > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function validarEmail() {
            $stmt = $this->banco->getConexao()->prepare("SELECT count(*) as qtd from usuario WHERE email = ?");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado->fetch_object()->qtd > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getIdUsuario() { 
            return $this->idUsuario; 
        }
        public function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }
        public function getUsername() {
            return $this->username;
        }
        public function setUsername($username) {
            $this->username = $username;
        }
        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function getSenha() {
            return $this->senha;
        }
        public function setSenha($senha) {
            $this->senha = $senha;
        }
    }
?>