<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');


    class SettingsController extends SqlQuery{
        public function announcement($message, $admin_token){
            if(!$this->fetchAnnouncement()){
                $this->insertAnnouncement($admin_token, $message);
                echo $message;
            }
            else{
                $this->updateAnnouncement($admin_token, $message);
                echo $message;
            }
        }
        
        public function shutdown($toggle, $admin_token){
            if($toggle == 'true'){
                $this->updateShutdown($admin_token, 1);
                echo json_encode([
                    'status' => true,
                    'toggle' => $toggle
                ]);
            }else{
                $this->updateShutdown($admin_token, 0);
                echo json_encode([
                    'status' => false,
                    'toggle' => $toggle
                ]);
            }
        }
        
        public function contact($admin_token,
                        $address, 
                        $gmap, 
                        $phone_number_1, 
                        $phone_number_2, 
                        $email, 
                        $twitter, 
                        $facebook, 
                        $iframe){

            if(!$this->fetchContactDetails()){
                $this->insertContactDetails($admin_token, $address, $gmap, $phone_number_1, $phone_number_2, $email, $twitter, $facebook, $iframe);
            } else {
                $this->updateContactDetails($admin_token, $address, $gmap, $phone_number_1, $phone_number_2, $email, $twitter, $facebook, $iframe);
            }

            $contact_details = $this->fetchContactDetails();
            echo json_encode([
                'contact_details' => $contact_details,
                'status' => true
            ]);
        }
    }

    session_start();

    $admin_token =  $_SESSION['admin_id'];

    $settings = new SettingsController();

    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $settings->announcement($message, $admin_token);
    }

    if (isset($_POST['shutdown'])) {
        $toggle = $_POST['toggle'];
        $settings->shutdown($toggle, $admin_token);
    }

    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        $gmap = $_POST['gmap'];
        $phone_number_1 = $_POST['phone_number_1'];
        $phone_number_2 = $_POST['phone_number_2'];
        $email = $_POST['email'];
        $twitter = $_POST['twitter'];
        $facebook = $_POST['facebook'];
        $iframe = $_POST['iframe'];

        $settings->contact($admin_token,
                        $address, 
                        $gmap, 
                        $phone_number_1, 
                        $phone_number_2, 
                        $email, 
                        $twitter, 
                        $facebook, 
                        $iframe);
    }else{
        echo json_encode([
            'status' => false,
            'message' => 'No data was sent'
        ]);
    }

?>