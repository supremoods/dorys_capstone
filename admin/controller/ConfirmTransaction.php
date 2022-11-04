<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class ConfirmTransaction extends SqlAdminQuery{
        public function confirm($reservation_token){
            if($this->updateRequestReservation("confirmed", $reservation_token)){
                
                // 

                echo json_encode(array('status' => 'success'));
            }            
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $confirmTransaction = new ConfirmTransaction;
    $token = $decode['token'];

    $confirmTransaction->confirm($token);

?>