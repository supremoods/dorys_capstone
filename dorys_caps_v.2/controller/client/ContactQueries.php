<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class ContactQueries extends SqlClientQuery{
        public function insertQueries($email,
        $phone,
        $message){
            if($this->InsertClientQueries($email,
            $phone,
            $message)){
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Query submitted successfully'
                ));
            }else{
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Query submission failed'
                ));
            }
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    
    $email = $decode['email'];
    $phone = $decode['phone'];
    $message = $decode['message'];

    $contactQueries = new ContactQueries();

    $contactQueries->insertQueries($email,  
    $phone,
    $message);

?>