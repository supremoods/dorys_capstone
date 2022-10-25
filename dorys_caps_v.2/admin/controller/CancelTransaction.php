<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class CancelTransaction extends SqlAdminQuery{
        public function cancel($reservation_token){
            if($this->updateRequestReservation("cancelled", $reservation_token)){
                echo json_encode(array('status' => 'success'));
            }            
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $cancelTransaction = new CancelTransaction;
    $token = $decode['token'];


    $cancelTransaction->cancel($token);


?>