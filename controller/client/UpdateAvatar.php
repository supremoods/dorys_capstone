<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

    class UpdateAvatar extends SqlClientQuery{
        public function updateAvatar($avatar, $img_path){
            session_start();
            $user_token = $_SESSION['user_token'];

            if($this->UpdateClientAvatar($user_token, $avatar)){
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $img_path);
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Avatar updated successfully'
                )); 
            }else{
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Avatar not updated'
                )); 
            }

            

        }
    }



    // Fetch POST data
    $avatar = $_FILES['avatar']['name'];
    $img_path = $_SERVER['DOCUMENT_ROOT']."/public/images/client/".basename($avatar);

    $updateAvatar = new UpdateAvatar();   

    $updateAvatar->updateAvatar($avatar, $img_path);




?>