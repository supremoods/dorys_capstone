<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class PopulateCalendar extends SqlClientQuery{
        public function populate(){
            $result = $this->fetchAllReservation();
            $data = array();

            if(!$result){
                $events = $this->fetchEvents();
            
                if(!$events){
                    echo json_encode($data);    
                }else{
                    while($row = $events->fetch_assoc()){
                        array_push($data, array(
                            'id' => $row['id'],
                            'title' => $row['title'],
                            'start' => $row['start'],
                        ));
                    }
                    echo json_encode($data);
                }
            }else{
                while($row = $result->fetch_assoc()){
                    array_push($data, array(
                        'id' => $row['reservation_token'],
                        'title' => $row['name'],
                        'start' => $row['start_datetime'],
                        'end' => $row['end_datetime']
                    ));
                }

                $events = $this->fetchEvents();
            
                if(!$events){
                    echo json_encode($data);    
                }else{
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

        }
    }

    $populateCalendar = new PopulateCalendar; 
    $populateCalendar->populate();  
?>