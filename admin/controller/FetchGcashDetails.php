<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

   class FetchGcashDetails extends SqlAdminQuery{
       public function fetchGcashDetails(){
          $fetchGcashDetails = $this->fetchPaymentDetails();
          echo json_encode(array("status" => 'success', "res" => $fetchGcashDetails));
       }
   }

   $fetchGcashDetails = new FetchGcashDetails();
   $fetchGcashDetails->fetchGcashDetails();

?>