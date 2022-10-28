<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    class UploadImage extends SqlAdminQuery{

        public function upload($token, $upload_image){
            
            // fetch the ammenity
            $ammenity = $this->fetchAmmenitiesDetail($token);

            // get the images
            if($ammenity->num_rows > 0){
                while($row = $ammenity->fetch_assoc()){
                    $images = $row['images'];
                }
            }

            // convert the images to array
            $images = explode(",", $images);

            $updated_images = array();

            
            // push the old images to the array
            for($i = 0; $i < count($images); $i++){
                array_push($updated_images, $images[$i]);
            }

            // push the new images to the array
            for($i = 0; $i < count($upload_image); $i++){
                array_push($updated_images, $upload_image[$i]);
            }

            // update the ammenity

            if($this->UpdateAmmmenityImages($token, implode(",", $updated_images))){
                $path = $this->path($upload_image);

                if($this->moveImages($path)){
                    echo json_encode(array("status" => 'success'));
                }else{
                    echo json_encode(array("status" => 'failed'));
                }
            }



        }

        public function path($service_images){
            $path = array();
            for($i = 0; $i < count($service_images); $i++){
                array_push($path, $_SERVER['DOCUMENT_ROOT']."/vendors/images/services/".basename($service_images[$i]));
            } 
            return $path;
        }

        public function moveImages($path){
            for($i = 0; $i < count($path); $i++){
               if(!move_uploaded_file($_FILES["images"]["tmp_name"][$i], $path[$i])){
                     return false;
               }
            }
            return true;
        }

    }


    $ammenity_token = $_POST['service-token'];
    $ammenityImages = $_FILES['images']['name'];

    $upload = new UploadImage;

    $upload->upload($ammenity_token, $ammenityImages);
    
?>