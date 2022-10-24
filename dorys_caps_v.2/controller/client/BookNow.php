<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class BookNow extends SqlClientQuery{
        public function bookNow(
            $service_token,
            $start_datetime,
            $end_datetime,
            $mode_of_payment,
            $total_amount,
            $message,
            ){
                session_start();
                $user_token = $_SESSION['user_token'];
                $reservation_token = $this->generate_token();
                if($this->BookNowDetails(
                    $user_token,
                    $service_token,
                    $reservation_token,
                    $start_datetime,
                    $end_datetime,
                    $mode_of_payment,
                    $total_amount,
                    $message
                    )){
                        echo json_encode(array('status' => 'success'));
                    }else{
                        echo json_encode(array('status' => 'failed'));
                    }
            }

            public function generate_token(){
                //Generate a random string.
                $token = openssl_random_pseudo_bytes(8);
                //Convert the binary data into hexadecimal representation.
                return bin2hex($token);
            }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $service_token = $decode['service-token'];
    $start_datetime = $decode['checkin'];
    $end_datetime = $decode['checkout'];
    $mode_of_payment = $decode['mode-of-payment'];
    $total_amount = $decode['total-rate'];
    $message = $decode['client_message'];

    $bookNow = new BookNow();

 // remove the peso sign from the total amount
    $total_amount = str_replace('₱', '', $total_amount);  

    $bookNow->bookNow($service_token, 
                    $start_datetime,
                    $end_datetime,
                    $mode_of_payment,
                    $total_amount,
                    $message
                );



?>