<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');


    class PopulateCalendar extends SqlAdminQuery{
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

            $events = $this->fetchEvents();

            while($row = $events->fetch_assoc()){
                array_push($data, array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'start' => $row['start'],
                ));
            }


            echo json_encode($data);
        }
    }

    $populateCalendar = new PopulateCalendar; 
    $populateCalendar->populate();  
?>