<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');


    class AddAmmenity extends SqlAdminQuery{
        public function addServices($service_name, 
                        $service_description,
                        $service_images,
                        $service_price,
                        ){
                            $token = $this->generate_token();
                            
                            if( $this->insertAmmenity(
                                $token,
                                $service_name,
                                $service_description,
                                implode(",",$service_images),
                                $service_price
                            )){
                                $path = $this->path($service_images);

                                if($this->moveImages($path)){
                                    echo json_encode(true);
                                }else{
                                    echo json_encode(false);
                                }
        
                            }
                        }

        public function generate_token(){
            //Generate a random string.
            $token = openssl_random_pseudo_bytes(8);
            //Convert the binary data into hexadecimal representation.
            return bin2hex($token);
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

    $name = $_POST['ammenity-name'];
    $ammenity_images = $_FILES['images']['name'];
    $ammenity_images_tmp = $_FILES['images']['tmp_name'];
    $ammenity_description = $_POST['ammenity-description'];
    $ammenity_rates = $_POST['ammenity-rates'];

    $addAmmenity = new AddAmmenity();

    $addAmmenity->addServices($name, 
        $ammenity_description,
        $ammenity_images, 
        $ammenity_rates
    );


?>