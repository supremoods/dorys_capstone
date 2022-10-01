<?php   

    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/admin_model/SqlQuery.php');


    class EditServiceController extends SqlQuery {
        
        public function editServices($service_name, 
                        $service_features,
                        $service_description,
                        $service_images,
                        $old_images,
                        $service_price,
                        $service_token
                        ){
                            $updatedImages = array();

                            $fetchImages = $this->fetchOldImages($service_token);


                            for($i = 0; $i < count($old_images); $i++){
                                if($old_images[$i] != ""){
                                    array_push($updatedImages, $fetchImages[$old_images[$i]]);
                                }
                            }

                            
                            $this->checkImages($fetchImages, $updatedImages);

                            for($i = 0; $i < count($service_images); $i++){
                                if($service_images[$i] != ""){
                                    array_push($updatedImages, $service_images[$i]);
                                }
                            }

                            if($this->UpdateServiceDetails($service_name,
                            $service_features,
                            $service_description,   
                            implode(",",$updatedImages),
                            $service_price,
                            $service_token
                            )){
                                $path = $this->path($service_images);
                                if($this->moveImages($path)){
                                    echo json_encode(true);
                                }else{
                                    echo json_encode(false);
                                }
                            } else {
                                echo json_encode(false);
                            }
                        }

        public function fetchOldImages($token){
            if(!$this->fetchServiceDetails($token)){
                return false;
            }

            $row = $this->fetchServiceDetails($token);
            $images = explode(",", $row['images']);
            return $images;
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
               if(!move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $path[$i])){
                     return false;
               }
            }
            return true;
        }

        public function checkImages($fetchImages, $updatedImages){
            $result = array_diff($fetchImages, $updatedImages);
            foreach($result as $image){
                unlink($_SERVER['DOCUMENT_ROOT']."/vendors/images/services/".trim($image));
            }
        }
    }

    $editServiceController = new EditServiceController();
    $service_name = $_POST['service-title'];
    $service_description = $_POST['service-description'];
    $service_price = $_POST['service-price'];
    $service_features = $_POST['service-features'];
    $service_images = $_FILES['photos']['name'];
    $old_images = $_POST['old'];
    $service_token = $_POST['service-token'];

    $editServiceController->editServices(
        $service_name,
        $service_features,
        $service_description,
        $service_images,
        $old_images,
        $service_price,
        $service_token
    );

?>