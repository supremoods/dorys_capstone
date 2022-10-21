<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/config/ConfigDB.php');

    class SqlClientQuery extends ConfigDB{
        public function insertClientAccount(
            $user_token,
            $full_name,
            $email,
            $password
        ){

            $sql = "INSERT INTO client (
                user_token,
                fullname, 
                email, 
                password,
                status
                ) VALUES (
                    '$user_token',
                    '$full_name',
                    '$email',
                    '$password',
                    'inactive'
                    )";
            
            $result = $this->dbConnection()->query($sql);
            
            if ($result) {
                // if the query is successful, return true
                return true;
            } else {
                // if the query is not successful, return false
                return false;
            }
        }

        public function loginClient($email, $password){

            $sql = "SELECT * FROM client WHERE email = '$email'";

            $result = $this->dbConnection()->query($sql);
            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if(password_verify($password, $row['password'])){
                            // decrypt the password
                            $user_token = $row['user_token'];
                            if($this->login_stamp($user_token)){
                               return true;
                            }
                        }
                    }
                } 
            } 
       }


       public function login_stamp($token){
           date_default_timezone_set("Asia/Manila");
           $session_token = $this->generate_token();
           $date = date('y-m-d h:i:s');

           $sql = "INSERT INTO client_log_history(
               session_id,
               user_token,
               log_in_stamp
           ) VALUES (
               '$session_token',
               '$token',
               '$date'
               )
           ";

           $result = $this->dbConnection()->query($sql);
           
           if($result){
               session_start();
               $_SESSION['user_token'] = $token;
               $_SESSION['session_token'] = $session_token;
               if($this->update_client_status($token, 'active')){
                   return true;
               }
           }
       }

       public function update_client_status($token, $status){
           $sql = "UPDATE client SET status = '$status' WHERE user_token = '$token'";
           $result = $this->dbConnection()->query($sql);
           if($result){
               return true;
           }
       }

       public function generate_token(){
           //Generate a random string.
           $token = openssl_random_pseudo_bytes(8);
           //Convert the binary data into hexadecimal representation.
           return bin2hex($token);
       }

       
       public function fetchClientDetails($token){
            $sql = "SELECT * FROM client WHERE user_token = '$token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function logout_stamp($token){
            date_default_timezone_set("Asia/Manila");
            $date = date('y-m-d h:i:s');

            $sql = "UPDATE client_log_history SET log_out_stamp = '$date' WHERE session_id = '$token'";

            $result = $this->dbConnection()->query($sql);
            
            if($result){
                session_start();
                $user_id = $_SESSION['user_token'];
                if($this->update_client_status($user_id, 'inactive')){
                    return true;
                }
            }
        }

    }




?>