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
            $service_token,
            $refNum,
            $payment_type,
            $paid_amount
            ){
                if($this->UpdateTransactionDetails(
                    $reservation_token,
                    $start_datetime,
                    $end_datetime,
                    $mode_of_payment,
                    $total_amount,
                    $message,
                    $service_token,
                    $refNum,
                    $payment_type,
                    $paid_amount
                    )){
                        echo json_encode(array('status' => 'success'));
                    }else{
                        echo json_encode(array('status' => 'failed'));
                    }
            }
    }



    $total_amount = $_POST['total-rate'];
    $payment_type = $_POST['payment-type'];

    $total_amount = str_replace('₱', '', $total_amount);  
    if($payment_type == 'Downpayment'){
        $paid_amount = $total_amount * 0.3;
    }else{
        $paid_amount = $total_amount;
    }

    $updateTransaction = new UpdateTransaction();
    $updateTransaction->updateTransact($_POST['reservation_token'], 
                                    $_POST['start_datetime'],
                                    $_POST['end_datetime'],
                                    $_POST['mode-of-payment'],
                                    $total_amount,
                                    $_POST['client_message'],
                                    $_POST['service_token'],
                                    $_POST['reference_number'],
                                    $_POST['payment-type'],
                                    $paid_amount
                                );    

?>