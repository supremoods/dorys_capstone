<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/ConfigDB.php');

    class SqlQuery extends ConfigDB{
        public function insertClientAccount(
            $user_token,
            $full_name,
            $email,
            $address,
            $number,
            $password,
            $avatar
        ){
            // create a new database object
            $database = new ConfigDB;

            $sql = "INSERT INTO client (
                user_token,
                fullname, 
                email, 
                address, 
                number, 
                password, 
                avatar, 
                status 
                ) VALUES (
                    '$user_token',
                    '$full_name',
                    '$email',
                    '$address',
                    '$number',
                    '$password',
                    '$avatar',
                    NULL
                    )";
            
            $result = $database->dbConnection()->query($sql);
            
            if ($result) {
                // if the query is successful, return true
                return true;
            } else {
                // if the query is not successful, return false
                return false;
            }
        }

        public function loginClient($email, $password){
             // create a new database object
             $database = new ConfigDB();

             $sql = "SELECT * FROM client WHERE email = '$email'";
 
             $result = $database->dbConnection()->query($sql);
             if ($result) {
                 // if the query is successful, return true
                 if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                         if(password_verify($password, $row['password'])){
                             // decrypt the password
                             return true;
                         }
                     }
                 } 
             } 

             return false;
        }
    }

?>