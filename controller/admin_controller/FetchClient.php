<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class FetchClient extends SqlQuery{
        public function fetchRow($token){
            return $this->fetchClientDetails($token);;
        }

        public function fetchRowLogs($token){
            return $this->fetchClientLogs($token);
        }

    }

?>