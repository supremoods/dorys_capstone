<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class fetchClientDetails extends SqlAdminQuery{
        public function loadClientDetails($token){
            $res = $this->fetchClientDetails($token);
            
            if($res->num_rows>0){
                $row = $res->fetch_assoc();
                echo json_encode(array('status' => 'success', 'client' => $row));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
            
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fetchClientDetails = new fetchClientDetails();
    $fetchClientDetails->loadClientDetails($decode['token']);

?>