<?php
   class ConfigDB{
        // Properties
        public $host = "localhost";
        public $user = "u376903371_dorys";
        public $pass = "@SupremoodAdmin25";
        public $db = "u376903371_dorys_db";
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