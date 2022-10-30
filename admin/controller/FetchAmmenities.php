<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class FetchAmmenitiesController extends SqlAdminQuery{
        public function loadAmmenities(){
            
            $ammenities = $this->fetchAmmenities();

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

    $fetchAmmenities = new FetchAmmenitiesController();
    $fetchAmmenities->loadAmmenities();

?>