<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DeleteTransaction extends SqlAdminQuery{
        public function delete($reservation_token){
            if($this->deleteRequestReservation($reservation_token)){
                echo json_encode(array('status' => 'success'));
            }            
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $deleteTransaction = new DeleteTransaction;
    $token = $decode['token'];

    $deleteTransaction->delete($token);

?>