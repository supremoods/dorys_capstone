<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class FetchTransactDetails extends SqlClientQuery{
        public function loadTransactDetails($reservation_token){
            $transactionDetails = $this->TransactDetails($reservation_token);

            if($transactionDetails->num_rows > 0){

                $row = $transactionDetails->fetch_assoc();

                echo json_encode(array('status' => 'success', 'transact' => $row));  
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fetchTransactDetails = new FetchTransactDetails();
    $fetchTransactDetails->loadTransactDetails($decode['reservation_token']);


?>