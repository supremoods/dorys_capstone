<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class PopulateCalendar extends SqlClientQuery{
        public function populate(){
            $result = $this->fetchAllReservation();
            $data = array();
            while($row = $result->fetch_assoc()){
                array_push($data, array(
                    'id' => $row['reservation_token'],
                    'title' => $row['name'],
                    'start' => $row['start_datetime'],
                    'end' => $row['end_datetime']
                ));
            }
            echo json_encode($data);
        }
    }

    $populateCalendar = new PopulateCalendar; 
    $populateCalendar->populate();  
?>