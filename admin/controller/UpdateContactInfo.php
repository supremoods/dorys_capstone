<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class UpdateContactInfo extends SqlAdminQuery{
        public function updateContactInfo($admin_token,
        $address, 
        $gmap, 
        $phone_number_1, 
        $phone_number_2, 
        $email, 
        $twitter, 
        $facebook,
        $instagram,
        $iframe){
            if(!$this->fetchContactDetails()){
               if($this->insertContactDetails($admin_token, 
               $address, 
               $gmap, 
               $phone_number_1, 
               $phone_number_2, 
               $email, $twitter, 
               $facebook, 
               $instagram, 
               $iframe)){
                    echo json_encode(array('status' => 'success', 'message' => 'Contact details updated successfully'));
               }else{
                    echo json_encode(array('status' => 'error', 'message' => 'Contact details not updated'));
               }
            } else {
                if($this->updateContactDetails($admin_token, 
                $address, 
                $gmap, 
                $phone_number_1, 
                $phone_number_2, 
                $email, 
                $twitter, 
                $facebook, 
                $instagram, 
                $iframe)){
                    echo json_encode(array('status' => 'success', 'message' => 'Contact details updated successfully'));
                }else{
                    echo json_encode(array('status' => 'error', 'message' => 'Contact details not updated'));
                }
            }
        }
    }
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    session_start();

    $admin_token = $_SESSION['admin_token'];

    $address = $decode['address'];
    $gmap = $decode['gmap'];
    $phone_number_1 = $decode['phoneNumber1'];
    $phone_number_2 = $decode['phoneNumber2'];
    $email = $decode['email'];
    $twitter = $decode['twitter'];
    $facebook = $decode['facebook'];
    $instagram = $decode['instagram'];
    $iframe = $decode['iframe'];

    $updateContactInfo = new UpdateContactInfo();

    $updateContactInfo->updateContactInfo($admin_token, 
                                $address, 
                                $gmap, 
                                $phone_number_1, 
                                $phone_number_2, 
                                $email, 
                                $twitter, 
                                $facebook, 
                                $instagram, 
                                $iframe);



?>