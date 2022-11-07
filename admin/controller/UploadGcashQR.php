<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');
   
   class UploadGcashQR extends SqlAdminQuery{
       public function uploadQR($image, $number, $name){

         $fetchGcashDetails = $this->fetchPaymentDetails();

         if(!$fetchGcashDetails){
            if($this->insertGcashQrCode($image, $number, $name)){ 
               // upload image
               $target_dir = $_SERVER['DOCUMENT_ROOT'].'/public/images/qrCode/';
               $target_file = $target_dir . basename($image);

               if(move_uploaded_file($_FILES["gcash-qr"]["tmp_name"], $target_file)){
                  echo json_encode(array("status" => 'success'));
               }else{
                  echo json_encode(array("status" => 'failed'));
               }
            }else{
               echo json_encode(array("status" => 'failed'));
            }
         }else{
            if($this->updatePaymentDetails($fetchGcashDetails['id'], $image, $number, $name)){
               // upload image
               $target_dir = $_SERVER['DOCUMENT_ROOT'].'/public/images/qrCode/';
               $target_file = $target_dir . basename($image);

               if(move_uploaded_file($_FILES["gcash-qr"]["tmp_name"], $target_file)){
                  // delete old image
                  $old_image = $_SERVER['DOCUMENT_ROOT'].'/public/images/qrCode/'.$fetchGcashDetails['gcash_qr'];
                  if(file_exists($old_image)){
                     unlink($old_image);
                  }
                  echo json_encode(array("status" => 'success'));
               }else{
                  echo json_encode(array("status" => 'failed'));
               }
            }else{
               echo json_encode(array("status" => 'failed'));
            }
         }
           
       }
   }

   $image = $_FILES['gcash-qr']['name'];
   $number = $_POST['gcash-number'];
   $name = $_POST['gcash-name'];

   $upload_qr = new UploadGcashQR();

   $upload_qr->uploadQR($image, $number, $name);

?>