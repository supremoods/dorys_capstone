<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DisableAppointment extends SqlAdminQuery{
        public function disable($start_datetime){
            
            if($this->DisableAppoint($start_datetime)){
                echo json_encode(array('status' => 'success'));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $start_datetime = $decode['date'];

    $disable = new DisableAppointment;

    $disable->disable($start_datetime);

?>