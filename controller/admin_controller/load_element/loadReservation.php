<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class LoadReservation extends SqlQuery{
        public function loadReservationContainer($client_token){
            $result = $this->fetchClientReservation($client_token);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  $service_name = $this->fetchServiceDetails($row['service_token']);
                  $client_details = $this->fetchClientDetails($row['user_token']);
                  $status = $this->fetchReservationStatus($row['reservation_token']);
                    ?>
                    <tr>
                        <td><?=$service_name['name']?></td>
                        <td class="d-flex flex-column align-item justify-content-center align-items-center">
                            <span class="border p-1 bg-warning rounded"><?=$row['start_datetime']?></span>
                            <span class="material-symbols-outlined">expand_more</span>
                            <span class="border p-1 bg-warning rounded"><?=$row['end_datetime']?></span>
                        </td>
                        <td><?=$row['mode_of_payment']?></td>
                        <td><?=$client_details['address']?></td>
                        <td><?=$row['settlement_fee']?></td>
                        <td><?=$status['status']?></td>
                        <?php
                        if($status['status'] == 'pending'){
                         ?>
                        <td>
                            <button href="#" class="btn btn-success btn-sm" data-token="<?=$row['reservation_token']?>" onclick="confirmReservation(this.dataset.token)">Confirm</button>
                            <button href="#" class="btn btn-danger btn-sm" data-token="<?=$row['reservation_token']?>" onclick="cancelReservation(this.dataset.token)">Cancel</button>
                        </td>
                        <?php
                        }else if($status['status'] == 'cancelled'){
                        ?>
                        <td>
                            <button href="#" class="btn btn-primary btn-sm" data-token="<?=$row['reservation_token']?>" onclick="undoReservation(this.dataset.token)">Revert</button>
                            <button href="#" class="btn btn-danger btn-sm" data-token="<?=$row['reservation_token']?>">Delete</button>
                        </td>
                        <?php
                        }   
                        ?>
                    </tr>
                    <?php
                }
            }
        }
    }

    $loadReservation = new LoadReservation();

    $client_token = $_POST['client_token'];

    $loadReservation->loadReservationContainer($client_token);

?>