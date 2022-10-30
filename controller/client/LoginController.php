<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class LoginController extends SqlClientQuery{

        public function loginCLientAccount(
            $email,
            $password,
        ){
            
               if($this->loginClient(
                $email,
                $password
               )){

                echo json_encode( array(
                    'status' => 'success',
                    'message' => 'Login successful'
                ));

               }else{

                echo json_encode( array(
                    'status' => 'error',
                    'message' => 'Login failed'
                ));

               }
        }


        
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    // Fetch POST data
    $email = $decode['email'];
    $password = $decode['password'];

    $loginController = new LoginController();
   
    $loginController->loginCLientAccount(
        $email,
        $password
    );


?>