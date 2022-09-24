<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class FetchContact extends SqlQuery{
        public function fetchRow(){
            if(!$this->fetchContactDetails()){
                return false;
            }
            $row = $this->fetchContactDetails();
            return $row;
        }
    }

    $fetchContact = new FetchContact;

    if($row = $fetchContact->fetchRow()){
        echo json_encode([
            'contact_details' => $row,
            'status' => true
        ]);
    } else {
        echo json_encode([
            'status' => false
        ]);
    }
?>