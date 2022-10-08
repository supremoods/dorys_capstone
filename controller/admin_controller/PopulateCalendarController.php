<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class PopulateCalendarController extends SqlQuery{
        public function populate(){
            $this->fetchAllReservation();
            $data = array();

            while($row = $this->fetchAllReservation()->fetch_assoc()){
                array_push($data, array(
                    'name' => $row['name'],
                    'user_token' => $row['user_token'],
                    'service_token' => $row['service_token'],
                    'reservation_token' => $row['reservation_token'],
                    'start_datetime' => $row['start_datetime'],
                    'end_datetime' => $row['end_datetime'],
                ));
            }


            echo json_encode($data);
        }
    }

    $populateCalendar = new PopulateCalendarController; 

?>