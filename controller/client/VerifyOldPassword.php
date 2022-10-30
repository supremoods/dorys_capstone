<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class VerifyOldPassword extends SqlClientQuery{
        public function verifyPassword($user_token, $password){
            if($this->VerifyClientPassword($user_token, $password)){
                return true;
            }else{
                return false;
            }
        }
    }

    // $input=file_get_contents("php://input");
    // $decode=json_decode($input,true);

    session_start();
    $user_token = $_SESSION['user_token'];  

    // Fetch POST data

    $password = $_POST['old-password'];

    $verifyPassword = new VerifyOldPassword();

    if($verifyPassword->verifyPassword($user_token, $password)){
        echo json_encode(array(
            'status' => 'success',
            'message' => 'Password verified'
        ));
    }else{
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Password not verified'
        ));
    }


?>