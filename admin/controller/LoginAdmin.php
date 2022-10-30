<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class LoginAdmin extends SqlAdminQuery{
        public function login($username, $password){
            if ($this->loginAdmin($username, $password)) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Login Successful'
                ));
            } else {
                echo json_encode(array(
                    'status' => 'failed',
                    'message' => 'Please check your username and password'
                ));
            }
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $username = $decode['username'];
    $password = $decode['password'];

    $loginController = new LoginAdmin();

    $loginController->login($username, $password);

?>