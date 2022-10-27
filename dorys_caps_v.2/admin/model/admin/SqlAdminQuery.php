<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config/ConfigDB.php');

class SqlAdminQuery extends ConfigDB
{


    public function fetchClients()
    {
        $sql = "SELECT * FROM client";

        $result = $this->dbConnection()->query($sql);

        $clientArray = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientArray[] = $row;
            }
        }

        $count_request = array();

        // get the count of request from clientArray user_token
        foreach ($clientArray as $key => $value) {
            $user_token = $value['user_token'];
            $sql = "SELECT COUNT(request_reservation.status) AS request FROM client 
                LEFT JOIN reservation 
                    ON client.user_token = reservation.user_token 
                LEFT JOIN request_reservation 
                    ON reservation.reservation_token = request_reservation.reservation_token 
                    WHERE request_reservation.status = 'pending' 
                    AND client.user_token = '$user_token' 
                    GROUP BY client.user_token";

            $result = $this->dbConnection()->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $count_request[] = $row;
                }
            }else{
                $count_request[] = array('request' => 0);
            }
        }

        return array('status' => 'success', 'clients' => $clientArray, 'count_request' => $count_request);

    }

    public function deleteClientDetails($token)
    {
        $sql = "DELETE FROM client WHERE user_token = '$token'";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchCountRequestClient($token)
    {
        $sql = "SELECT COUNT(request_reservation.status) AS request FROM client 
            LEFT JOIN reservation 
                ON client.user_token = reservation.user_token 
            LEFT JOIN request_reservation 
                ON reservation.reservation_token = request_reservation.reservation_token 
                WHERE request_reservation.status = 'pending' 
                AND client.user_token = '$token' 
                GROUP BY client.user_token";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                return $result;
            }
        }
    }

    public function fetchClientDetails($token)
    {
        $sql = "SELECT * FROM client WHERE user_token = '$token'";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            return $result;
        }
    }

    public function trackReservation($client_token)
    {
        $sql = "SELECT reservation.reservation_token,  
                        services.name,
                        reservation.service_token,
                        reservation.start_datetime, 
                        reservation.end_datetime, 
                        reservation.mode_of_payment, 
                        services.price,
                        reservation.settlement_fee, 
                        request_reservation.status,
                        services.images,
                        reservation.message
                    FROM reservation 
                    LEFT JOIN request_reservation ON 
                        reservation.reservation_token = request_reservation.reservation_token 
                    LEFT JOIN services ON 
                        services.services_token = reservation.service_token
                        WHERE reservation.user_token = '$client_token'";

        $result = $this->dbConnection()->query($sql);
        if ($result) {
            // if the query is successful, rezturn true
            return $result;
        }
    }

    public function trackAmmenityReservation($service_token)
    {
        $sql = "SELECT reservation.reservation_token,  
                        services.name,
                        reservation.service_token,
                        reservation.start_datetime, 
                        reservation.end_datetime, 
                        reservation.mode_of_payment, 
                        services.price,
                        reservation.settlement_fee, 
                        request_reservation.status,
                        services.images,
                        reservation.message,
                        reservation.user_token
                    FROM reservation 
                    LEFT JOIN request_reservation ON 
                        reservation.reservation_token = request_reservation.reservation_token 
                    LEFT JOIN services ON 
                        services.services_token = reservation.service_token
                        WHERE services.services_token = '$service_token'";

        $result = $this->dbConnection()->query($sql);
        if ($result) {
            // if the query is successful, rezturn true
            return $result;
        }
    }


    public function FetchAmmenities()
    {
        $sql = "SELECT * FROM services";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return $result;
        }
    }

    public function updateRequestReservation($status, $token)
    {
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

    public function deleteRequestReservation($token)
    {
        // multiple query

        $sql = "DELETE FROM request_reservation WHERE reservation_token = '$token';";
        $sql .= "DELETE FROM reservation WHERE reservation_token = '$token';";

        $result = $this->dbConnection()->multi_query($sql);

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

    public function fetchRequest($token)
    {
        $sql = "SELECT COUNT(request_reservation.status) AS request 
            FROM client 
            LEFT JOIN reservation 
                ON client.user_token = reservation.user_token 
            LEFT JOIN request_reservation 
                ON reservation.reservation_token = request_reservation.reservation_token 
                WHERE request_reservation.status = 'pending' AND reservation.service_token = '$token'
                GROUP BY reservation.service_token";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['request'];
            }
        }
    }

    public function insertAmmenity(
        $token,
        $service_name,
        $service_description,
        $service_images,
        $service_price,
    ) {

        $sql = "INSERT INTO services (
            services_token, 
            name, 
            description, 
            images,
            price) VALUES 
            ('$token', 
            '$service_name', 
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

    public function deleteAmmnenity($token){
        if($this->deleteAmmenityImages($token)){
            $sql = "DELETE FROM services WHERE services_token = '$token'";
            $result = $this->dbConnection()->query($sql);
            if($result){
                return true;
            }
        }
    }

    public function deleteAmmenityImages($token){
        $sql = "SELECT * FROM services WHERE services_token = '$token'";

        $result = $this->dbConnection()->query($sql);
        if($result){
            // fetch row images
            $row = $result->fetch_assoc();
            $images = $row['images'];
            $images = explode(",", $images);

            // check if images is not empty
            
            if(!$images[0] == ""){
                foreach($images as $image){
                    if(!unlink($_SERVER['DOCUMENT_ROOT']."/vendors/images/services/".trim($image))){
                        return false;
                    }
                 }
            }

            return true;
        }
    }
    
    public function fetchAmmenitiesDetail($service_token){
        $sql = "SELECT * FROM services WHERE services_token = '$service_token'";
        $result = $this->dbConnection()->query($sql);
        if($result){
            return $result;
        }
    }

    public function deleteAmmenityImageItem($token, $selectedImg){
        $sql = "SELECT * FROM services WHERE services_token = '$token'";

        $result = $this->dbConnection()->query($sql);
        if($result){
            // fetch row images
            $row = $result->fetch_assoc();
            $images = trim($row['images'],"");
            $images = explode(",", $images);

            // trim all the white space in the array
            $images = array_map('trim', $images);

            // remove selected image
            $key = array_search($selectedImg, $images);

            unset($images[$key]);

            // implode array
            $images = implode(",", $images);

            // update images
            $sql = "UPDATE services SET images = '$images' WHERE services_token = '$token'";
            $result = $this->dbConnection()->query($sql);
            if($result){
                // delete image
                if(unlink($_SERVER['DOCUMENT_ROOT']."/vendors/images/services/".trim($selectedImg))){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }


    public function updateAmmenityItem($token, $ammenityName, $ammenityDesc, $ammenityRate){
        $sql = "UPDATE services SET name = '$ammenityName', description = '$ammenityDesc', price = '$ammenityRate' WHERE services_token = '$token'";
        $result = $this->dbConnection()->query($sql);
        if($result){
            return true;
        }
    }
}
