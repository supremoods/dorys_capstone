<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/function/Essentials.php');

    class LoginController extends SqlQuery{

        public function isEmpty(
            $email,
            $password,
        ){
            $essential = new Essentials();

            if(
                !empty($email) &&
                !empty($password)
            ){
               if($this->loginClient(
                $email,
                $password
               )){
                $essential->redirect("/index.php");
               }else{
                // echo json_encode(array("status"=>false, "message"=>"failed"));\
                $essential->alert("danger", "Invalid username or password");
               }
            }else{
                $essential->alert("danger", "Please fill up all the fields");
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