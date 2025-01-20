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
    

}

?>