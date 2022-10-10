<?php

    // Path: models\admin_model\SqlQuery.php
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/ConfigDB.php');

    class SqlQuery extends ConfigDB{

        public function loginAdmin($username, $password){
            $sql = "SELECT * FROM admin WHERE username = '$username'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if(strcmp($password, $row['password']) == 0){
                        session_start();
                        $_SESSION['admin_id'] = $row['admin_id'];
                        return true;
                    }
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }    

        public function fetchAnnouncement(){
            $sql = "SELECT * FROM announcement";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function updateAnnouncement($admin_token, $announcement){
            $sql = "UPDATE announcement SET message = '$announcement' WHERE admin_id = '$admin_token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function insertAnnouncement($admin_token, $announcement){
            $sql = "INSERT INTO announcement (admin_id, message) VALUES ('$admin_token', '$announcement')";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function updateShutdown($admin_token, $shutdown){
            $sql = "UPDATE website_stats SET shutdown = '$shutdown' WHERE admin_id = '$admin_token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function fetchWebStats(){
            $sql  = "SELECT * FROM website_stats";

            $result = $this->dbConnection()->query($sql);
            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }


        public function insertContactDetails($admin_token,
                                $address, 
                                $gmap, 
                                $phone_number_1, 
                                $phone_number_2, 
                                $email, 
                                $twitter, 
                                $facebook, 
                                $iframe){

            $sql = "INSERT INTO contact_details (admin_id, address, gmap, phone_number_1, phone_number_2, email, twitter, facebook, iframe) VALUES ('$admin_token', '$address', '$gmap', '$phone_number_1', '$phone_number_2', '$email', '$twitter', '$facebook', '$iframe')";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function updateContactDetails($admin_token,
                                    $address, 
                                    $gmap, 
                                    $phone_number_1, 
                                    $phone_number_2, 
                                    $email, 
                                    $twitter, 
                                    $facebook, 
                                    $iframe){

            $sql = "UPDATE contact_details SET address = '$address', gmap = '$gmap', phone_number_1 = '$phone_number_1', phone_number_2 = '$phone_number_2', email = '$email', twitter = '$twitter', facebook = '$facebook', iframe = '$iframe' WHERE admin_id = '$admin_token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function fetchContactDetails(){
            $sql = "SELECT * FROM contact_details";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function fetchClients(){
            $sql = "SELECT * FROM client";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    return $result;
                }
            }
        }


        public function fetchClientDetails($token){
            $sql = "SELECT * FROM client WHERE user_token = '$token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }


        public function fetchClientLogs($token){
            $sql = "SELECT * FROM client_log_history WHERE user_token = '$token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    return $result;
                }
            }
        }

        public function InsertServices(
                                    $token,
                                    $service_name,
                                    $service_features,
                                    $service_description,
                                    $service_images,
                                    $service_price,){    

            $sql = "INSERT INTO services (
                            services_token, 
                            name, 
                            features, 
                            description, 
                            images,
                            price) VALUES 
                            ('$token', 
                            '$service_name', 
                            '$service_features', 
                            '$service_description', 
                            '$service_images',
                            '$service_price')";

            $result = $this->dbConnection()->query($sql);
            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }



        public function fetchServices(){
            $sql = "SELECT * FROM services";
            $result = $this->dbConnection()->query($sql);
            if($result){
                return $result;
            }
        }

        public function fetchServiceDetails($token){
            $sql = "SELECT * FROM services WHERE services_token = '$token'";
            $result = $this->dbConnection()->query($sql);
            if($result){
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }   

        public function UpdateServiceDetails($service_name, 
        $service_features,
        $service_description,
        $service_images,
        $service_price,
        $service_token){
                $sql = "UPDATE services SET name = '$service_name', features = '$service_features', description = '$service_description', images = '$service_images', price = '$service_price' WHERE services_token = '$service_token'";
    
                $result = $this->dbConnection()->query($sql);
    
                if ($result) {
                    // if the query is successful, return true
                    if ($result) {
                        return true;
                    } else {
                        // if the query is not successful, return false
                        return false;
                    }
                }
        }

        public function DeleteService($token){

            if($this->deleteServiceImages($token)){
                $sql = "DELETE FROM services WHERE services_token = '$token'";
                $result = $this->dbConnection()->query($sql);
                if($result){
                    return true;
                }
            }

        }

        public function deleteServiceImages($token){
            $sql = "SELECT * FROM services WHERE services_token = '$token'";

            $result = $this->dbConnection()->query($sql);
            if($result){
                // fetch row images
                $row = $result->fetch_assoc();
                $images = $row['images'];
                $images = explode(",", $images);
                foreach($images as $image){
                   if(!unlink($_SERVER['DOCUMENT_ROOT']."/vendors/images/services/".trim($image))){
                       return false;
                   }
                }

                return true;
            }
        }

        public function fetchClientReservation($token){
            $sql = "SELECT * FROM reservation WHERE user_token = '$token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    return $result;
                }
            }   
        }


        public function fetchReservationStatus($token){
            $sql = "SELECT * FROM request_reservation WHERE reservation_token = '$token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function updateRequestReservation($status, $token){
            $sql = "UPDATE request_reservation SET status = '$status' WHERE reservation_token = '$token'";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result) {
                    return true;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }   
        }

        public function fetchAllReservation(){
            $sql = "SELECT reservation.user_token, 
                        reservation.service_token, 
                        reservation.reservation_token, 
                        reservation.start_datetime, 
                        reservation.end_datetime, 
                        services.name 
                        FROM reservation 
                        LEFT JOIN request_reservation ON reservation.reservation_token = request_reservation.reservation_token 
                        LEFT JOIN services ON services.services_token = reservation.service_token;
            ";

            // $sql = "SELECT * FROM reservation";

            $result = $this->dbConnection()->query($sql);

            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    return $result;
                }
            }
        }
        
    }

?>