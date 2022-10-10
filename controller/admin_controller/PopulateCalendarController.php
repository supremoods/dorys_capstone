<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class PopulateCalendarController extends SqlQuery{
        public function populate(){
            $result = $this->fetchAllReservation();
            $data = array();
            while($row = $result->fetch_assoc()){
                array_push($data, array(
                    'title' => $row['name'],
                    // 'user_token' => $row['user_token'],
                    // 'service_token' => $row['service_token'],
                    // 'reservation_token' => $row['reservation_token'],
                    'start' => $row['start_datetime'],
                    'end' => $row['end_datetime']
                ));
            }

            echo json_encode($data);
        }
    }

    $populateCalendar = new PopulateCalendarController; 
    $populateCalendar->populate();  

?>