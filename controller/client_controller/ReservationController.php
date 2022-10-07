<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

    class ReservationController extends SqlQuery{
        public function insertReservation(
            
        )

    }

    $reservation = new ReservationController();

    $user_token = $_SESSION['user_token'];
    $reservation_token = $_POST['service_token'];
    $start_datetime = $_POST['dateStart'];
    $end_datetime = $_POST['dateEnd'];
    $status = $_POST['status'];
    $settlement_fee = $_POST['settlement_fee'];
    $payment_method = $_POST['payment_method'];



    $reservation->insertReservation($reservation_token, $user_token, $start_datetime, $end_datetime, $status, $settlement_fee, $payment_method);






?>