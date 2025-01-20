<?php

class Database {
    private $host="localhost";
    private $user= "root";
    private $pass= "";
    private $dbname= "db_onedek";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host,$this->user,$this->pass,$this->dbname);
    }
    public function query($sql) {
        return $this->conn->query($sql);
    }
}
?>