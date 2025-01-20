<?php
require_once 'db.php';

class Test {
    public $nomor;
    public $status;
    public $ip_address;
    public $tag_value;
    public $file_name;
    public $date;

    public $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function read() {
        $query = "SELECT * FROM tb_develop";
        return $this->conn->query($query);
    }
    
    public function create() {
        $query = "INSERT INTO tb_develop (status, ip_address, tag_value, file_name, date) VALUES ('$this->status', '$this->ip_address', '$this->tag_value', '$this->file_name', '$this->date')";
        return $this->conn->query($query);
    }
}
?>