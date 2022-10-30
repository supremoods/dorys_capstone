<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DeleteAnnouncement extends SqlAdminQuery{
        public function announcement($admin_id){
            if($this->deleteAnnouncement($admin_id)){
                echo json_encode(array("status" => 'success'));
            }else{
                echo json_encode(array("status" => 'failed'));
            }
        }
    }

    session_start();

    $admin_id = $_SESSION['admin_id'];

    $delete_announcement = new DeleteAnnouncement();
    $delete_announcement->announcement($admin_id);

?>