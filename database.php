<?php 
class myDBClass {
    private $sn = "localhost";
    private $urs = "root";
    private $pwd = "";
    private $db = "MyDB";
    private $conn;

    function __construct() {
        $this->conn = new mysqli($this->sn, $this->urs, $this->pwd, $this->db);
        if ($this->conn->connect_error) {
            throw new Exception("Kết nối thất bại: " . $this->conn->connect_error);
        } else {
            echo "Kết nối thành công";
        }
    }
    function connectDB() {
        return $this->conn;
    }
    function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    // Close the database connection
    function closeDB() {
        if ($this->conn) {
            $this->conn->close();
            echo "Đóng kết nối";
        }
    }
}