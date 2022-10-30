<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class LoadContactsInfo extends SqlAdminQuery{
        public function loadContactsInfo(){
            $contact_details = $this->fetchContactDetails();
            if($contact_details){
                echo json_encode(array('status' => 'success', 'message' => 'Contact details loaded successfully', 'contact_details' => $contact_details));
            }else{
                echo json_encode(array('status' => 'error', 'message' => 'Contact details not loaded'));
            }
        }
    }

    $load_contacts_info = new LoadContactsInfo();
    $load_contacts_info->loadContactsInfo();
?>