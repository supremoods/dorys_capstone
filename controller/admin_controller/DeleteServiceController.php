<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/admin_model/SqlQuery.php');

    class DeleteServiceController extends SqlQuery{
        public function deleteServiceItem($token){
            if($this->DeleteService($token)){
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        }
    }


    $deleteService = new DeleteServiceController;

    $token = $_POST['token'];

    $deleteService->deleteServiceItem($token);

?>