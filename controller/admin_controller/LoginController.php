<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/function/Essentials.php');

    class LoginController extends SqlQuery{
        public function isEmpty($username, $password){
            $essential = new Essentials();

            if (!empty($username) && !empty($password)) {
                if ($this->loginAdmin($username, $password)) {
                    $essential->redirect("admin/dashboard/");
                } else {
                    $essential->alert("danger", "Invalid username or password");
                }
            }else{
                $essential->alert("danger", "Please fill in all fields");
            }
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginController = new LoginController();

    $loginController->isEmpty(
        $username,
        $password
    );

?>