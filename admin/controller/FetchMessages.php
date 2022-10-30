<?php
    
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class FetchMessages extends SqlAdminQuery{
        public function loadMessages(){
            $messages = $this->fetchMessages();
            if(!$messages){
                echo json_encode(array('status' => 'failed'));
            }else{
                if($messages->num_rows > 0){
                    $msg = array();
                    while($row = $messages->fetch_assoc()){
                        array_push($msg, $row);
                    }
                   echo json_encode(array('status' => 'success', 'messages' => $msg));
                }
            }

        }
    }

    $fetch = new FetchMessages;

    $fetch->loadMessages();
?>