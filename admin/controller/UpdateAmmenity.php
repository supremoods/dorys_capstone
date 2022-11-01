<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class UpdateAmmenity extends SqlAdminQuery{
        public function updateAmmenity($token, $ammenityName, $ammenityDesc, $ammenityRate ){
            if($this->updateAmmenityItem($token, $ammenityName, $ammenityDesc, $ammenityRate )){
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed'));
            }
        }

    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $updateAmmenity = new UpdateAmmenity();

    $token = $decode['token'];
    $ammenityName = $decode['name'];
    $ammenityDesc = trim($decode['description']);
    $ammenityRate = $decode['rate'];

    $updateAmmenity->updateAmmenity($token, $ammenityName, $ammenityDesc, $ammenityRate);

?>