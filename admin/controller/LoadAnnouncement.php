<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class LoadAnnouncement extends SqlAdminQuery{
        public function announcement(){
            $announcement = $this->fetchAnnouncement();
            if(!$announcement){
                echo json_encode(array("status" => 'failed'));
            }else{
                echo json_encode(array("status" => 'success', "announcement" => $announcement));
            }
        }
    }

    $load_announcement = new LoadAnnouncement();
    $load_announcement->announcement();

?>