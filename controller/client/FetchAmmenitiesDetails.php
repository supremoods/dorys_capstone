<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class FetchAmmenities extends SqlClientQuery{
        public function loadAmmenities($service_token){
            
            $ammenities = $this->fetchAmmenitiesDetail($service_token);

            $ammenitiesList = array();
            if($ammenities->num_rows > 0){
                while($row = $ammenities->fetch_assoc()){
                    $ammenitiesList[] = $row;
                }
                echo json_encode(array('status' => 'success', 'ammenities' => $ammenitiesList));    
            }else{
                echo json_encode(array('status' => 'failed'));
            }

        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fetchAmmenities = new FetchAmmenities();

    $fetchAmmenities->loadAmmenities($decode['services_token']);

?>