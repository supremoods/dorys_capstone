<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class FetchWebStats extends SqlQuery{
        public function fetchRow(){
            if(!$this->fetchWebStats()){
                return false;
            }
            $row = $this->fetchWebStats();
            return $row;
        }
    }

    $fetchWebStats = new FetchWebStats;

    if($row = $fetchWebStats->fetchRow()){
        echo json_encode([
            'status' => true,
            'toggle' => $row['shutdown'],
        ]);
    } else {
        echo json_encode([
            'status' => false
        ]);
    }

?>