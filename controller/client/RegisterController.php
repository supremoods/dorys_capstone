<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class RegisterController extends SqlClientQuery{
        public function registerClientAccount(
            $full_name,
            $email,
            $password
        ){
            if($this->checkEmail($email)){
                echo json_encode(array('status' => 'email-exist'));
            }else{
                $user_token = uniqid();
                $result = $this->insertClientAccount(
                    $user_token,
                    $full_name,
                    $email,
                    $password
                );

                if ($result) {
                    // if the query is successful, return true
                    echo json_encode( array(
                        'status' => 'success',
                        'message' => 'Account created successfully'
                    ));
                } else {
                    // if the query is not successful, return false
                    echo json_encode( array(
                        'status' => 'error',
                        'message' => 'Account not created'
                    )); 
                }
            }
        }

        // check if email is existing
        public function checkEmail($email){
            $result = $this->checkEmailExist($email);
            if ($result) {
                // if the query is successful, return true
                return true;
            } else {
                // if the query is not successful, return false
                return false;
            }
        }
    }
    

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $full_name = $decode['name'];
    $email = $decode['email'];
    $password = $decode['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $register = new RegisterController();
    $register->registerClientAccount(
        $full_name,
        $email,
        $password
    );



?>