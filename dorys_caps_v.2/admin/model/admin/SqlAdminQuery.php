<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/config/ConfigDB.php');

    class SqlAdminQuery extends ConfigDB{
 
        public function fetchClients(){
            $sql = "SELECT client.user_token, 
            client.fullname, 
            client.email, 
            client.address, 
            client.number, 
            client.avatar, 
            client.status, 
            COUNT(request_reservation.status) AS request FROM client 
            LEFT JOIN reservation 
                ON client.user_token = reservation.user_token 
            LEFT JOIN request_reservation 
                ON reservation.reservation_token = request_reservation.reservation_token 
                WHERE request_reservation.status = 'pending' 
                GROUP BY client.user_token";

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

        public function trackReservation($client_token){
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


    }

?>