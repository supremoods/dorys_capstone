<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class TrackReservation extends SqlAdminQuery{
        public function loadTracks($token){
            $res = $this->trackReservation($token);
            $reservation = array();
            if($res->num_rows>0){
                while($row = $res->fetch_assoc()){
                    $reservation[] = $row;
                }
                echo json_encode(array('status' => 'success', 'reservation' => $reservation));

            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }
    }

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $trackReservation = new TrackReservation();
    $trackReservation->loadTracks($decode['token']);
    
?>