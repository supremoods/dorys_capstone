<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class UpdateAnnouncement extends SqlAdminQuery{
        public function announcement($message, $admin_token){
            if(!$this->fetchAnnouncement()){
                $this->insertAnnouncement($admin_token, $message);
                echo json_encode(array("status" => 'success'));
            }else{
                $this->updateAnnouncement($admin_token, $message);
                echo json_encode(array("status" => 'success'));
            }
        }
    }


    session_start();
    $admin_token =  $_SESSION['admin_id'];
    $message = $_POST['content'];


    $update_announcement = new UpdateAnnouncement();
    $update_announcement->announcement($message, $admin_token);
?>