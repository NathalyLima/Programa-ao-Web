<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'sistema_banco';
    private $username = 'root';
    private $password = '';
    private $DBConn;
 
    public function __construct($servidor, $nomeBanco, $usuario, $senha) {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
    }
 
    public function getConnection() {
        $this->DBConn = null;
        try {
            $this->DBConn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
        return $this->DBConn;
    }
}