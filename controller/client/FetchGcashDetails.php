<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

   class FetchGcashDetails extends SqlClientQuery{
       public function fetchGcashDetails(){
          $fetchGcashDetails = $this->fetchPaymentDetails();
          echo json_encode(array("status" => 'success', "res" => $fetchGcashDetails));
       }
   }

   $fetchGcashDetails = new FetchGcashDetails();
   $fetchGcashDetails->fetchGcashDetails();

?>