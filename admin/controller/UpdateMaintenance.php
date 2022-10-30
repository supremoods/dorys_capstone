<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class UpdateMaintenance extends SqlAdminQuery{
        public function maintenance($token, $mode){
            if($this->updateMaintenance($token, $mode)){
                echo json_encode(array("status" => 'success'));
            }else{
                echo json_encode(array("status" => 'failed'));
            }
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    session_start();
    $token = $_SESSION['admin_id'];

    $mode = $decode['mode'];

    $update_maintenance = new UpdateMaintenance();
    $update_maintenance->maintenance($token, $mode);

?>