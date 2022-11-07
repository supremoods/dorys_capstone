<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class CheckIfAccountIsVerified extends SqlClientQuery{
        public function checkVerified($user_token){
            $fetch = $this->fetchClientDetails($user_token);

            if(empty($fetch['number']) && empty($fetch['address'])){
                echo json_encode(array(
                    'status' => 'not_verified',
                    'message' => 'Please complete your profile details'
                ));
            }else{
                echo json_encode(array(
                    'status' => 'verified',
                    'message' => 'Account is verified'
                ));
            }
        }
    }


    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $user_token = $decode['user_token'];

    $checkIfAccountIsVerified = new CheckIfAccountIsVerified();

    $checkIfAccountIsVerified->checkVerified($user_token);

?>