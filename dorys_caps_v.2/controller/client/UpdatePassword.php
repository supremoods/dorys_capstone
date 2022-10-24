<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class UpdatePassword extends SqlClientQuery{
        public function updatePassword($user_token, $password){
            if($this->UpdateClientPassword($user_token, $password)){
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Password updated successfully'
                )); 
            }else{
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Password not updated'
                )); 
            }
        }
    }   

    session_start();
    $user_token = $_SESSION['user_token'];

    // Fetch POST data
    $password = $_POST['confirm-password'];

    if(isset($password)){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $updatePassword = new UpdatePassword();
        $updatePassword->updatePassword($user_token, $password);
    }else{
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Password not updated'
        )); 
    }
?>

