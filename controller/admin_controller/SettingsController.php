<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class SettingsController extends SqlQuery{
        public function announcement(){
            $admin_token =  $_SESSION['admin_id'];

            if(!this->fetchAnnouncement()){
                $announcement = "No announcement";

            }
        }
        
        public function shutdown(){
            
        }
        
        public function contact(){
            
        }
    }


    if (isset($_POST['announcement'])) {

    }

?>