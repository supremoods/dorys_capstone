<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config/ConfigDB.php');

class SqlAdminQuery extends ConfigDB
{

    public function loginAdmin($username, $password)
    {
        $sql = "SELECT * FROM admin WHERE username = '$username'";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (strcmp($password, $row['password']) == 0) {
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
            } else {
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
        $service_price
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

    public function deleteAmmnenity($token)
    {
        if ($this->deleteAmmenityImages($token)) {
            $sql = "DELETE FROM services WHERE services_token = '$token'";
            $result = $this->dbConnection()->query($sql);
            if ($result) {
                return true;
            }
        }
    }

    public function deleteAmmenityImages($token)
    {
        $sql = "SELECT * FROM services WHERE services_token = '$token'";

        $result = $this->dbConnection()->query($sql);
        if ($result) {
            // fetch row images
            $row = $result->fetch_assoc();
            $images = $row['images'];
            $images = explode(",", $images);

            // check if images is not empty

            if (!$images[0] == "") {
                foreach ($images as $image) {
                    if (!unlink($_SERVER['DOCUMENT_ROOT'] . "/public/images/services/" . trim($image))) {
                        return false;
                    }
                }
            }

            return true;
        }
    }

    public function fetchAmmenitiesDetail($service_token)
    {
        $sql = "SELECT * FROM services WHERE services_token = '$service_token'";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return $result;
        }
    }

    public function deleteAmmenityImageItem($token, $selectedImg)
    {
        $sql = "SELECT * FROM services WHERE services_token = '$token'";

        $result = $this->dbConnection()->query($sql);
        if ($result) {
            // fetch row images
            $row = $result->fetch_assoc();
            $images = trim($row['images'], "");
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
            if ($result) {
                // delete image
                if (unlink($_SERVER['DOCUMENT_ROOT'] . "/public/images/services/" . trim($selectedImg))) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }


    public function updateAmmenityItem($token, $ammenityName, $ammenityDesc, $ammenityRate)
    {
        $sql = "UPDATE services SET name = '$ammenityName', description = '$ammenityDesc', price = '$ammenityRate' WHERE services_token = '$token'";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return true;
        }
    }


    public function fetchAllReservation()
    {
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

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                return $result;
            }else{
                return false;
            }
        }
    }


    public function fetchEvents()
    {
        $sql = "SELECT * FROM events";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                return $result;
            }
        }
    }

    public function deleteEvent($token)
    {
        $sql = "DELETE FROM events WHERE id = '$token'";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return true;
        }
    }

    public function DisableAppoint($start_datetime)
    {
        $sql = "INSERT INTO events (title, start) VALUES ('Unavailable','$start_datetime')";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return true;
        }
    }

    public function UpdateAmmmenityImages($token, $images)
    {
        $sql = "UPDATE services SET images = '$images' WHERE services_token = '$token'";

        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return true;
        }
    }

    public function fetchMessages()
    {
        $sql = "SELECT * FROM queries";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function deleteMessageClient($token)
    {
        $sql = "DELETE FROM queries WHERE id = '$token'";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return true;
        }
    }

    public function updateAnnouncement($admin_token, $announcement)
    {
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

    public function fetchAnnouncement()
    {
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


    public function insertAnnouncement($admin_token, $announcement)
    {
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

    public function DeleteAnnouncement($token)
    {
        $sql = "DELETE FROM announcement WHERE admin_id = '$token'";
        $result = $this->dbConnection()->query($sql);
        if ($result) {
            return true;
        }
    }

    public function updateMaintenance($token, $mode)
    {
        $sql = "UPDATE website_stats SET mode = '$mode' WHERE admin_id = '$token'";

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

    public function fetchMaintenance()
    {
        $sql = "SELECT * FROM website_stats";

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

    public function fetchContactDetails()
    {
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

    public function updateContactDetails(
        $admin_token,
        $address,
        $gmap,
        $phone_number_1,
        $phone_number_2,
        $email,
        $twitter,
        $facebook,
        $instagram,
        $iframe
    ) {

        $sql = "UPDATE contact_details SET address = '$address', 
                    gmap = '$gmap',
                    phone_number_1 = '$phone_number_1', 
                    phone_number_2 = '$phone_number_2', 
                    email = '$email', 
                    twitter = '$twitter', 
                    facebook = '$facebook', 
                    instagram='$instagram', 
                    iframe = '$iframe' 
                WHERE admin_id = '$admin_token'";

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

    public function insertContactDetails(
        $admin_token,
        $address,
        $gmap,
        $phone_number_1,
        $phone_number_2,
        $email,
        $twitter,
        $facebook,
        $instagram,
        $iframe
    ) {

        $sql = "INSERT INTO contact_details (admin_id, 
                    address, 
                    gmap, 
                    phone_number_1, 
                    phone_number_2, 
                    email, 
                    twitter, 
                    facebook, 
                    instagram, 
                    iframe) VALUES ('$admin_token', 
                        '$address', 
                        '$gmap', 
                        '$phone_number_1', 
                        '$phone_number_2', 
                        '$email', 
                        '$twitter', 
                        '$facebook', 
                        '$instagram', 
                        '$iframe')";

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

    
    public function fetchCountClients(){
        $sql = "SELECT COUNT(*) AS total FROM client ";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['total'];
            } else {
                // if the query is not successful, return false
                return false;
            }
        }
    }

    public function fetchCountPendingRequest(){
        $sql = "SELECT COUNT(*) AS total FROM request_reservation WHERE status = 'pending'";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['total'];
            } else {
                // if the query is not successful, return false
                return false;
            }
        }
    }

    public function fetchCountMessages(){
        $sql = "SELECT COUNT(*) AS total FROM queries";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['total'];
            } else {
                // if the query is not successful, return false
                return false;
            }
        }
    }

    public function fetchMaintenanceMode(){
        $sql = "SELECT * FROM website_stats";

        $result = $this->dbConnection()->query($sql);

        if ($result) {
            // if the query is successful, return true
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['mode'];
            } else {
                // if the query is not successful, return false
                return false;
            }
        }
    }

    public function trackClientReservation($token, $reservation_token){
        $sql = "SELECT client.fullname, 
        client.number, 
        reservation.reservation_token, 
        reservation.payment_type,
        reservation.paid_amount,
        reservation.settlement_fee,
        services.name 
        FROM client
        INNER JOIN reservation ON client.user_token = reservation.user_token
        INNER JOIN services ON services.services_token = reservation.service_token
        WHERE client.user_token = '$token' AND reservation.reservation_token = '$reservation_token'";

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

    public function insertGcashQrCode($image, $number, $name){
        $sql = "INSERT INTO payment_details (gcash_qr, number, name) VALUES ('$image', '$number', '$name')";

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

    public function fetchPaymentDetails(){
        $sql = "SELECT * FROM payment_details";

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

    public function updatePaymentDetails($id, $image, $number, $name){
        $sql = "UPDATE payment_details SET gcash_qr = '$image', number = '$number', name = '$name' WHERE id = '$id'";

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
}