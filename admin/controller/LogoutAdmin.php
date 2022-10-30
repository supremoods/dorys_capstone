<?php

    class LogoutAdmin{
        public function logout(){
            session_start();
            if(isset($_SESSION['admin_id'])){
                unset($_SESSION['admin_id']);
                return true;
            }
        }
    }

    $logoutController = new LogoutAdmin;

    if($logoutController->logout()){
        header('location: /admin');
    } else {
        header('location: /admin/dashboard');
    }

?>