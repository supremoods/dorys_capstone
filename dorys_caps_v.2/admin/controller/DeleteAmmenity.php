<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DeleteAmmenity extends SqlAdminQuery{
        public function deleteAmmenityItem($token){
            if($this->deleteAmmnenity($token)){
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    $deleteAmmenity = new DeleteAmmenity;

    $token = $decode['ammenity'];

    $deleteAmmenity->deleteAmmenityItem($token);
?>