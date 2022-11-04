<?php
   class ConfigDB{
        // Properties
        public $host = "localhost";
        public $user = "root";
        public $pass = "root";
        public $db = "dors_db";
        public $conn;

        // Constructor
        public function __construct() {
            $this->conn = $this->dbConnection();
        }

        public function dbConnection() {
            $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
            return $conn;
        }

        // test if connection is successful
        public function testConnection() {
            if ($this->conn) {
                echo "Connection successful!";
            } else {
                echo "Connection failed!";
            }
        }
        
    }
?>