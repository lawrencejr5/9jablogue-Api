<?php

class Database
{
    private $db_name = "9jablogue";
    private $db_user = 'root';
    private $db_host = 'localhost:3325';
    private $db_pass = '';

    public $conn;

    public function __construct()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->db_host; dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
        return $this->conn;
    }
}
