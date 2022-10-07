<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

    class ReservationController extends SqlQuery{
        public function registerReservation(
            $user_token,
            $service_token,
            $start_datetime,
            $end_datetime,
            $settlement_fee,
            $payment_method
        ){
            $reservation_token = $this->generate_token();

            if($this->insertReservation(
                $user_token,
                $service_token,
                $reservation_token,
                $start_datetime,
                $end_datetime,
                $settlement_fee,
                $payment_method
            )){
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Reservation successfully registered'
                ));
            }else{
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Reservation not registered'
                ));
            }
           
        }

        public function generate_token(){
            //Generate a random string.
            $token = openssl_random_pseudo_bytes(8);
            //Convert the binary data into hexadecimal representation.
            return bin2hex($token);
        }
    }
         
    $reservation = new ReservationController();
    session_start();
    $user_token = $_SESSION['user_token'];
    $service_token = $_POST['service_token'];
    $start_datetime = $_POST['dateStart'];
    $end_datetime = $_POST['dateEnd'];
    $payment_method = $_POST['payment_method'];
    $settlement_fee = $_POST['settlement_fee'];
    

    $reservation->registerReservation($user_token, $service_token, $start_datetime, $end_datetime, $settlement_fee, $payment_method);

?> 