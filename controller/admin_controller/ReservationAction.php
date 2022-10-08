<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class ReservationAction extends SqlQuery{

        public function confirm($reservation_token){
            if($this->updateRequestReservation("confirmed", $reservation_token)){
               json_encode(array("status" => "success"));
            }            
        }

        public function cancel($reservation_token){
            if($this->updateRequestReservation("cancelled", $reservation_token)){
                json_encode(array("status" => "success"));
            }            
        }

        public function undo($reservation_token){
            if($this->updateRequestReservation("pending", $reservation_token)){
                json_encode(array("status" => "success"));
            }            
        }

    }

    $reservationAction = new ReservationAction;
    $action = $_POST['action'];

    if($action == 'confirm'){
        $reservationAction->confirm($_POST['reservation_token']);   
    }else if($action == 'cancel'){
        $reservationAction->cancel($_POST['reservation_token']);
    }else if($action == 'undo'){
        $reservationAction->undo($_POST['reservation_token']);
    }

?>