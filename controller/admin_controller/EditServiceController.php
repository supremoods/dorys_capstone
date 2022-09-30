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
                            echo json_encode($this->fetchOldImages($service_token));  
                        }

        public function fetchOldImages($token){
            if(!$this->fetchServiceDetails($token)){
                return false;
            }

            $row = $this->fetchServiceDetails($token);
            $images = explode(",", $row['images']);
            return $images;
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