<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DeleteMessage extends SqlAdminQuery{
        public function delete($token){
            if($this->deleteMessageClient($token)){
                echo json_encode(array('status' => 'success'));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }
    
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $delete = new DeleteMessage;

    $delete->delete($decode['id']);


?>