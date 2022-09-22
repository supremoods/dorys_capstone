<?php
    session_start();
    
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

    class LogoutController extends SqlQuery{
        public function logout(){
            if(isset($_SESSION['admin_id'])){
                unset($_SESSION['admin_id']);
                return true;
            }
        }
    }

    $logoutController = new LogoutController;

    if($logoutController->logout()){
        $essential->redirect("admin/");
    }
?>