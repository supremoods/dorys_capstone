<?php
    session_start();
    
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

    class LogoutController extends SqlQuery{
        public function logout(){
            if(isset($_SESSION['session_token'])){
                $token = $_SESSION['session_token'];
                if($this->logout_stamp($token)){
                    unset($_SESSION['session_token']);
                    return true;
                }
            }
        }
    }

    $logoutController = new LogoutController;

    if($logoutController->logout()){
        echo json_encode(array(
            "status" => true
        ));
    }else{
        echo json_encode(array(
            "status" => false
        ));
    }


?>