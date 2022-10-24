<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class FetchClient extends SqlClientQuery{
        public function fetchRow($token){
            return $this->fetchClientDetails($token);;
        }
    }

    $fetchClient = new FetchClient();
    session_start();
    echo json_encode($fetchClient->fetchRow($_SESSION['user_token']));  

?>