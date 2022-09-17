<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

    class RegistrationController extends SqlQuery{

        public function isEmpty(
            $full_name,
            $email,
            $address,
            $number,
            $password,
            $avatar
        ){
            if(
                !empty($full_name) &&
                !empty($email) &&
                !empty($address) &&
                !empty($number) &&
                !empty($password) &&
                !empty($avatar)
            ){
                $user_token = $this->generate_token();
                $this->insertClientAccount(
                    $user_token,
                    $full_name,
                    $email,
                    $address,
                    $number,
                    $password,
                    $avatar
            );
            
            }else{
                return true;
            }
        }

        public function generate_token(){
            //Generate a random string.
            $token = openssl_random_pseudo_bytes(8);
            //Convert the binary data into hexadecimal representation.
            return bin2hex($token);
        }
        
    }

    // Fetch POST data
    $full_name = $_POST['full_name'];
    $email = $_POST['email_add'];
    $address = $_POST['address'];
    $number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $encryptPass = password_hash($password, PASSWORD_DEFAULT);
    $avatar = $_FILES['avatar']['name'];
    $path = $_SERVER['DOCUMENT_ROOT']."/vendors/images/clients/".basename($avatar);

    $registrationController = new RegistrationController();
   
    if($registrationController->isEmpty(
        $full_name,
        $email,
        $address,
        $number,
        $encryptPass,
        $avatar
    )){
        echo json_encode(false);
    }else{  
        if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $path)){
            echo json_encode(true);
        }
    }

?>