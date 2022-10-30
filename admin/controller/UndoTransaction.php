<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class UndoTransaction extends SqlAdminQuery{
        public function undo($reservation_token){
            if($this->updateRequestReservation("pending", $reservation_token)){
                echo json_encode(array('status' => 'success'));
            }            
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $undoTransaction = new UndoTransaction;
    $token = $decode['token'];


    $undoTransaction->undo($token);

?>