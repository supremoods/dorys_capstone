<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class FetchAnnouncements extends SqlQuery{
        public function fetchRow(){
            if(!$this->fetchAnnouncement()){
                return false;
            }

            $row = $this->fetchAnnouncement();
            return $row;
        }
    }

    $fetchAnnouncements = new FetchAnnouncements;

    if($fetchAnnouncements->fetchRow()){
        $row = $fetchAnnouncements->fetchRow();
        echo json_encode([
            'status' => true,
            'announcement' => $row['announcement']
        ]);
    } else {
        echo json_encode([
            'status' => false
        ]);
    }
?>