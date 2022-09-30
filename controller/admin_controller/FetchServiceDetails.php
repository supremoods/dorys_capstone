<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class FetchServiceDetails extends SqlQuery{
        public function fetchRow($token){
            if(!$this->fetchServiceDetails($token)){
                return false;
            }

            $row = $this->fetchServiceDetails($token);
            
            echo json_encode($row);
        }
        
    }

    $fetchServiceDetails = new FetchServiceDetails; 
    $token = $_POST['service_token'];

    $fetchServiceDetails->fetchRow($token); 

?>
