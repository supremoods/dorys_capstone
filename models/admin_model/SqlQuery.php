<?php

    // Path: models\admin_model\SqlQuery.php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/ConfigDB.php');

    class SqlQuery extends ConfigDB{

        public function loginAdmin($username, $password){
            $sql = "SELECT * FROM admin WHERE username = '$username'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if(strcmp($password, $row['password']) == 0){
                        session_start();
                        $_SESSION['admin_id'] = $row['admin_id'];
                        return true;
                    }
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }    

    }

?>