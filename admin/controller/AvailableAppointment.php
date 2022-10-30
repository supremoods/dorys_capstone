<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class AvailableAppointment extends SqlAdminQuery{
        public function availableAppointment($id){
            $result = $this->deleteEvent($id);
            
            if($result){
                echo json_encode(array('status' => 'success'));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $id = $decode['dateId'];

    $availableAppointment = new AvailableAppointment;

    $availableAppointment->availableAppointment($id);

?>