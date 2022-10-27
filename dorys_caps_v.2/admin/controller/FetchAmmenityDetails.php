<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/admin/model/admin/SqlAdminQuery.php');

    class FetchAmmenities extends SqlAdminQuery{
        public function loadAmmenities($service_token){
            
            $ammenity = $this->fetchAmmenitiesDetail($service_token);

            $ammenityDetails = array();
            if($ammenity->num_rows > 0){
                while($row = $ammenity->fetch_assoc()){
                    $ammenityDetails[] = $row;
                }
                echo json_encode(array('status' => 'success', 'ammenity' => $ammenityDetails));    
            }else{
                echo json_encode(array('status' => 'failed'));
            }

        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fetchAmmenities = new FetchAmmenities();

    $fetchAmmenities->loadAmmenities($decode['token']);

?>