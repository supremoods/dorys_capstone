<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class DeleteTransaction extends SqlClientQuery{
        public function deleteTransact($reservation_token){
            if($this->deleteTransactionDetails($reservation_token)){
                echo json_encode(array('status' => 'success'));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    $reservation_token = $decode['reservation_token'];

    $deleteTransaction = new DeleteTransaction();
    $deleteTransaction->deleteTransact($reservation_token);
?>