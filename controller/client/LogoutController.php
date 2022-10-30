<?php
    session_start();
    
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class LogoutController extends SqlClientQuery{
        public function logout(){
            if(isset($_SESSION['session_token'])){
                $token = $_SESSION['session_token'];
                if($this->logout_stamp($token)){
                    unset($_SESSION['session_token']);
                    unset($_SESSION['user_token']);
                    return true;
                }
            }
        }
    }

    $logoutController = new LogoutController;

    if($logoutController->logout()){
        header ('Location: /');
    }


?>