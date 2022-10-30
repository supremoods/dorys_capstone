<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class FetchMode extends SqlAdminQuery{
        public function mode(){
            $mode = $this->fetchMaintenance();
            if(!$mode){
                echo json_encode(array("status" => 'failed'));
            }else{
                echo json_encode(array("status" => 'success', "mode" => $mode));
            }
        }
    }

    $fetch_mode = new FetchMode();
    $fetch_mode->mode();

?>