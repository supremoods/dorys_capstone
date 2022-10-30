<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/client/SqlClientQuery.php');

    class EditProfile extends SqlClientQuery{
        public function editProfile(
            $fullname,
            $email,
            $address1,
            $address2,
            $number
        ){
            session_start();
            $user_token = $_SESSION['user_token'];
            $address = $address1 . '/' . $address2;
            if($this->UpdateClientProfile(
                $fullname,
                $email,
                $address,
                $number,
                $user_token
            )){
                echo json_encode( array(
                    'status' => 'success',
                    'message' => 'Profile updated successfully'
                ));
            }else{
                echo json_encode( array(
                    'status' => 'error',
                    'message' => 'Profile update failed'
                ));
            }
        }
    }


    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $fullname = $decode['name'];
    $email = $decode['email'];
    $address1 = $decode['address-line-1'];
    $address2 = $decode['address-line-2'];
    $number = $decode['number'];

    $editProfile = new EditProfile();

    $editProfile->editProfile(
        $fullname,
        $email,
        $address1,
        $address2,
        $number
    );

?>