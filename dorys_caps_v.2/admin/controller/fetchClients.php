<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class fetchClients extends SqlAdminQuery{
        public function loadClients(){
            $res = $this->fetchClients();
            
            echo json_encode($res);
            
            // if($res->num_rows>0){
            //     while($row = $res->fetch_assoc()){
            //         $clients[] = $row;
            //     }
            //     echo json_encode(array('status' => 'success', 'clients' => $clients));

            // }else{
            //     echo json_encode(array('status' => 'failed'));
            // }
        }
    }

    $fetchClients = new fetchClients();
    $fetchClients->loadClients();

?>