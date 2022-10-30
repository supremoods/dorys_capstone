<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class DeleteAmmenityImage extends SqlAdminQuery{
        public function deleteAmmenityImage($token, $selectedImg){
            if($this->deleteAmmenityImageItem($token, $selectedImg)){
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $deleteAmmenityImage = new DeleteAmmenityImage();

    $token = $decode['token'];
    $selectedImg = $decode['name'];

    $deleteAmmenityImage->deleteAmmenityImage($token, $selectedImg);


?>