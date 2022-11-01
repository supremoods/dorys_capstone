<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class fetchOccupiedTime extends SqlClientQuery{
        public function loadOccupiedTime($date, $ammenity){

            // get the service token of the ammenity
            $serviceToken = $this->fetchServiceTokenAmmenity($ammenity);

            $occupiedTime = $this->fetchOccupiedTime($date, $serviceToken); 
            
            $data = array();

            if(!$occupiedTime){
                echo json_encode(array('status' => 'failed'));
            }else{
                while($row = $occupiedTime->fetch_assoc()){
                    array_push($data, array(
                        'reservation_token' => $row['reservation_token'],
                        'start' => $row['start_datetime'],
                        'end' => $row['end_datetime']
                    ));
                }
    
                echo json_encode($data);
            }
       

        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fetchOccupiedTime = new fetchOccupiedTime();
    $fetchOccupiedTime->loadOccupiedTime($decode['date'], $decode['ammenity']);



?>