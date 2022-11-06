<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');


    class SMSFetchInfo extends SqlAdminQuery{
      public function loadClientTransaction($token, $reservation_token){
         $res = $this->trackClientReservation($token, $reservation_token);
         // append api key to the array
         array_push($res, array('api_key' => '249cd51019d3a608d1173e80a6aec1357f5941d6rpwjYBbIeiFCKiqiXBfdIXddg'));
         if(!$res){
            echo json_encode(array('status' => 'failed'));
         }else{
            echo json_encode(array('status' => 'success', 'info' => $res));
         }
      }

    }


      $input=file_get_contents("php://input");
      $decode=json_decode($input,true);

      $SMSFetchInfo = new SMSFetchInfo();

      $reservation_token = $decode['token'];
      $user_token = $decode['user_token'];

      $SMSFetchInfo->loadClientTransaction($user_token, $reservation_token);


?>