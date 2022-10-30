<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class FetchTransactionList extends SqlClientQuery {
        public function loadTransact(){
            session_start();
            $user_token = $_SESSION['user_token'];

            $transactions = $this->trackReservation($user_token);

            $transactionList = array();
            if($transactions->num_rows > 0){
                while($row = $transactions->fetch_assoc()){
                    $transactionList[] = $row;
                }
                echo json_encode(array('status' => 'success', 'transact' => $transactionList));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $fetchTransactionList = new FetchTransactionList();
    $transactionList = $fetchTransactionList->loadTransact();
?>
