<?php
class Database{

    private $host = "127.0.0.1";
    private $db = "api_web";
    private $username = "homestead";
    private $password = "secret";
    public $conn;

    //Get database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}