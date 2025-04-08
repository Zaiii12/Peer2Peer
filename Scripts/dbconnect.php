<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname ="tutorlinkup_db";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die ("Connection failed: Programmer Bad." . $this->conn->connect_error);

        }
    }
    public function closeConnection():void {
        $this->conn->close();
    }
}
?>