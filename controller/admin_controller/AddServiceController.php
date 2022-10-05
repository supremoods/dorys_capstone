<?php   

    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/admin_model/SqlQuery.php');


    class AddServiceController extends SqlQuery {
        
        public function addServices($service_name, 
                        $service_features,
                        $service_description,
                        $service_images,
                        $service_price,
                        ){
                            $token = $this->generate_token();
                            
                            if( $this->insertServices(
                                $token,
                                $service_name,
                                $service_features,
                                $service_description,
                                implode(", ",$service_images),
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

    $addServiceController = new AddServiceController();
    $service_name = $_POST['service-title'];
    $service_description = $_POST['service-description'];
    $service_price = $_POST['service-price'];
    $service_features = $_POST['service-features'];
    $service_images = $_FILES['images']['name'];

    $addServiceController->addServices(
        $service_name,
        $service_features,
        $service_description,
        $service_images,
        $service_price,
    );
?>
