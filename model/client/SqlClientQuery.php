<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/config/ConfigDB.php');

    class SqlClientQuery extends ConfigDB{
        public function insertClientAccount(
            $user_token,
            $full_name,
            $email,
            $password
        ){

            $sql = "INSERT INTO client (
                user_token,
                fullname, 
                email, 
                password,
                status
                ) VALUES (
                    '$user_token',
                    '$full_name',
                    '$email',
                    '$password',
                    'inactive'
                    )";
            
            $result = $this->dbConnection()->query($sql);
            
            if ($result) {
                // if the query is successful, return true
                return true;
            } else {
                // if the query is not successful, return false
                return false;
            }
        }

        public function loginClient($email, $password){

            $sql = "SELECT * FROM client WHERE email = '$email'";

            $result = $this->dbConnection()->query($sql);
            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if(password_verify($password, $row['password'])){
                            // decrypt the password
                            $user_token = $row['user_token'];
                            if($this->login_stamp($user_token)){
                               return true;
                            }
                        }
                    }
                } 
            } 
       }


       public function login_stamp($token){
           date_default_timezone_set("Asia/Manila");
           $session_token = $this->generate_token();
           $date = date('y-m-d h:i:s');

           $sql = "INSERT INTO client_log_history(
               session_id,
               user_token,
               log_in_stamp
           ) VALUES (
               '$session_token',
               '$token',
               '$date'
               )
           ";

           $result = $this->dbConnection()->query($sql);
           
           if($result){
               session_start();
               $_SESSION['user_token'] = $token;
               $_SESSION['session_token'] = $session_token;
               if($this->update_client_status($token, 'active')){
                   return true;
               }
           }
       }

       public function update_client_status($token, $status){
           $sql = "UPDATE client SET status = '$status' WHERE user_token = '$token'";
           $result = $this->dbConnection()->query($sql);
           if($result){
               return true;
           }
       }

       public function generate_token(){
           //Generate a random string.
           $token = openssl_random_pseudo_bytes(8);
           //Convert the binary data into hexadecimal representation.
           return bin2hex($token);
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

        public function logout_stamp($token){
            date_default_timezone_set("Asia/Manila");
            $date = date('y-m-d h:i:s');

            $sql = "UPDATE client_log_history SET log_out_stamp = '$date' WHERE session_id = '$token'";

            $result = $this->dbConnection()->query($sql);
            
            if($result){
                session_start();
                $user_id = $_SESSION['user_token'];
                if($this->update_client_status($user_id, 'inactive')){
                    return true;
                }
            }
        }

        public function UpdateClientProfile(
            $fullname,
            $email,
            $address,
            $number,
            $user_token
        ){
            $sql = "UPDATE client SET fullname = '$fullname', email = '$email', address = '$address', number = '$number' WHERE user_token = '$user_token'";

            $result = $this->dbConnection()->query($sql);
            
            if($result){
                return true;
            }   
        }


        public function UpdateClientAvatar($user_token, $avatar){
            $sql = "UPDATE client SET avatar = '$avatar' WHERE user_token = '$user_token'";

            $result = $this->dbConnection()->query($sql);
            
            if($result){
                return true;
            }   
        }

        public function UpdateClientPassword($user_token, $password){
            $sql = "UPDATE client SET password = '$password' WHERE user_token = '$user_token'";

            $result = $this->dbConnection()->query($sql);
            
            if($result){
                return true;
            }   
        }

        public function VerifyClientPassword($user_token, $password){
            $sql = "SELECT * FROM client WHERE user_token = '$user_token'";

            $result = $this->dbConnection()->query($sql);
            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if(password_verify($password, $row['password'])){
                        return true;
                    }
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


        public function InsertClientQueries(
            $email,
            $phone,
            $message,
            $date
        ){
            $sql = "INSERT INTO queries(
                email,
                phone,
                message,
                timeStamp
                ) VALUES (
                    '$email',
                    '$phone',
                    '$message',
                    '$date'
                    )";
            
            $result = $this->dbConnection()->query($sql);
            
            if ($result) {
                // if the query is successful, return true
                return true;
            } else {
                // if the query is not successful, return false
                return false;
            }
        }
        
        public function FetchAmmenities(){
            $sql = "SELECT * FROM services";
            $result = $this->dbConnection()->query($sql);
            if($result){
                return $result;
            }
        }
        
        public function fetchAnnouncements(){
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

        public function trackReservation($client_token){
            $sql = "SELECT reservation.reservation_token,  
                        services.name, 
                        reservation.start_datetime, 
                        reservation.end_datetime, 
                        reservation.mode_of_payment, 
                        services.price, 
                        reservation.settlement_fee, 
                        request_reservation.status,
                        reservation.gcash_ref_num,
                        reservation.payment_type,
                        reservation.paid_amount

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

        public function fetchEvents(){
            $sql = "SELECT * FROM events";
    
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

        public function TransactDetails($reservation_token){
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
                        reservation.gcash_ref_num,
                        reservation.payment_type,
                        reservation.paid_amount
                    FROM reservation 
                    LEFT JOIN request_reservation ON 
                        reservation.reservation_token = request_reservation.reservation_token 
                    LEFT JOIN services ON 
                        services.services_token = reservation.service_token
                        WHERE reservation.reservation_token = '$reservation_token'";

            $result = $this->dbConnection()->query($sql);
            if ($result) {
                // if the query is successful, rezturn true
                    return $result;
            }
        }

        public function UpdateTransactionDetails($reservation_token,
        $start_datetime,
        $end_datetime,
        $mode_of_payment,
        $total_amount,
        $message,
        $service_token,
        $refNum,
        $payment_type,
        $paid_amount){

            // remove the peso sign from the total amount and convert it to float
            $sql = "UPDATE reservation SET 
            start_datetime = '$start_datetime',
            end_datetime = '$end_datetime',
            mode_of_payment = '$mode_of_payment',
            settlement_fee = '$total_amount',
            message = '$message',
            service_token = '$service_token',
            gcash_ref_num = '$refNum',
            payment_type = '$payment_type',
            paid_amount = '$paid_amount'
            WHERE reservation_token = '$reservation_token'";

            $result = $this->dbConnection()->query($sql);
            
            if($result){
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


        public function BookNowDetails(
            $user_token,
            $service_token,
            $reservation_token,
            $start_datetime,
            $end_datetime,
            $mode_of_payment,
            $total_amount,
            $message,
            $refNum,
            $payment_type,
            $paid_amount){

            $sql = "INSERT INTO reservation (
                user_token,
                service_token,
                reservation_token,
                start_datetime,
                end_datetime,
                mode_of_payment,
                settlement_fee,
                message,
                gcash_ref_num,
                payment_type,
                paid_amount
            ) VALUES (
                '$user_token',
                '$service_token',
                '$reservation_token',
                '$start_datetime',
                '$end_datetime',
                '$mode_of_payment',
                '$total_amount',
                '$message',
                '$refNum',
                '$payment_type',
                '$paid_amount'
            )";
                
            $result = $this->dbConnection()->query($sql);
            
            if ($result) {
                // if the query is successful, return true
                if($this->insertReservationStatus($reservation_token)){
                    return true;
                }else{
                    return false;
                }
            } else {
                return false;
            }

        }

        public function insertReservationStatus($reservation_token){
            $sql = "INSERT INTO request_reservation (
                reservation_token,
                status
            ) VALUES (
                '$reservation_token',
                'pending'
            )";
                
            $result = $this->dbConnection()->query($sql);
            
            if ($result) {
                // if the query is successful, return true
                return true;
            } else {
                // if the query is not successful, return false
                return false;
            }
        }

        public function deleteTransactionDetails($reservation_token){
            $sql = "DELETE FROM reservation WHERE reservation_token = '$reservation_token'";
            $result = $this->dbConnection()->query($sql);
            if($result){
                if($this->deleteRequestReservation($reservation_token)){
                    return true;
                }else{
                    return false;
                }
            }
        }   

        public function deleteRequestReservation($reservation_token){
            $sql = "DELETE FROM request_reservation WHERE reservation_token = '$reservation_token'";
            $result = $this->dbConnection()->query($sql);
            if($result){
                return true;
            }
        }

        public function fetchMaintenance(){
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

        public function fetchOccupiedTime($date, $ammenity){
            $sql = "SELECT * FROM reservation WHERE start_datetime LIKE '%$date%' AND service_token = '$ammenity'";
    
            $result = $this->dbConnection()->query($sql);
    
            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    // if the query is not successful, return false
                    return false;
                }
            }
        }

        public function fetchServiceTokenAmmenity($ammenity){
            $sql = "SELECT * FROM services WHERE name = '$ammenity'";
    
            $result = $this->dbConnection()->query($sql);
    
            if ($result) {
                // if the query is successful, return true
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row['services_token'];
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

    }




?>