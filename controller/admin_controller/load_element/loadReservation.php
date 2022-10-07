<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class LoadReservation extends SqlQuery{
        public function loadReservation(){
            $query = "SELECT * FROM reservation";
            $result = $this->connect()->query($query);
            $numRows = $result->num_rows;
            if($numRows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
    }
?>