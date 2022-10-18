<?php
        require_once($_SERVER['DOCUMENT_ROOT'].'/models/client_model/SqlQuery.php');

        class LoadTransact extends SqlQuery{
                public function loadTransact($user_token){
                        $result = $this->trackReservation($user_token);

                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                                <th scope="row"><?=$row['reservation_token']?></th>
                                <td><?=$row['name']?></td>
                                <td class="d-flex flex-column align-item justify-content-center align-items-center">
                                        <span class="border p-1 bg-warning rounded"><?=$row['start_datetime']?></span>
                                        <span class="material-symbols-outlined">expand_more</span>
                                        <span class="border p-1 bg-warning rounded"><?=$row['end_datetime']?></span>
                                </td>
                                <td><?=$row['mode_of_payment']?></td>
                                <td><?=$row['settlement_fee']?></td>
                                <td><?=$row['status']?></td>
                                <td>
                                        <button class="btn btn-warning">
                                                <span class="material-symbols-outlined">edit_note</span>
                                        </button>
                                        <button class="btn btn-danger">
                                                <span class="material-symbols-outlined">delete</span>
                                        </button>
                                </td>
                        </tr>
                    <?php
                        }
                }
        }

        $loadTransact = new LoadTransact;

        session_start();
        $user_token = $_SESSION['user_token'];

        $loadTransact->loadTransact($user_token);
?>