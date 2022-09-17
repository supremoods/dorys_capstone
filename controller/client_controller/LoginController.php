<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

    class LoginController extends SqlQuery{

        public function isEmpty(
            $email,
            $password,
        ){
            if(
                !empty($email) &&
                !empty($password)
            ){
               if($this->loginClient(
                $email,
                $password
               )){
                echo json_encode(true);
               }else{
                echo json_encode(false);
               }
            }
        }

        
    }

    // Fetch POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginController = new LoginController();
   
    $loginController->isEmpty(
        $email,
        $password
    );