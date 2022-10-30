<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DeleteClient extends SqlAdminQuery{
        public function deleteClient($token){
            $res = $this->deleteClientDetails($token);
            if($res){
                echo json_encode(array('status' => 'success'));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }
    
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $deleteClient = new DeleteClient();
    $deleteClient->deleteClient($decode['client_id']);

?>