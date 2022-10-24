<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class UpdateTransaction extends SqlClientQuery{
        public function updateTransact(
            $reservation_token,
            $start_datetime,
            $end_datetime,
            $mode_of_payment,
            $total_amount,
            $message,
            $service_token
            ){
                if($this->UpdateTransactionDetails(
                    $reservation_token,
                    $start_datetime,
                    $end_datetime,
                    $mode_of_payment,
                    $total_amount,
                    $message,
                    $service_token
                    )){
                        echo json_encode(array('status' => 'success'));
                    }else{
                        echo json_encode(array('status' => 'failed'));
                    }
            }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $updateTransaction = new UpdateTransaction();
    $updateTransaction->updateTransact($decode['reservation_token'], 
                                    $decode['start_datetime'],
                                    $decode['end_datetime'],
                                    $decode['mode-of-payment'],
                                    $decode['total-rate'],
                                    $decode['message'],
                                    $decode['service_token']
                                );    

?>