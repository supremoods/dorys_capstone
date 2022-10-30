<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class fetchAmmenityTransaction extends SqlAdminQuery{
        public function loadAmmenityTransaction($token){
            $res = $this->trackAmmenityReservation($token);
            $ammenities = array();
            if($res->num_rows>0){
                while($row = $res->fetch_assoc()){
                    $ammenities[] = $row;
                }
                echo json_encode(array('status' => 'success', 'ammenities' => $ammenities));
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fetchAmmenityTransaction = new fetchAmmenityTransaction();

    $fetchAmmenityTransaction->loadAmmenityTransaction($decode['token']);   
?>