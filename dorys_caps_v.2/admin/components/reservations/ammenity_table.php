<?php
    $ammenity = $_GET['ammenity'];
    $token = $_GET['service_token'];
?>
<div class="ammenity-trans-list" data-ammenity="<?=$token?>">
    <div class="wrapper">
        <div class="wrapper-header">
            <div class="left-header">
                <a href="/admin/dashboard/manage_reservation.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
                <h1><?=$ammenity?></h1>
            </div>
            <div class="right-header">
                <div class="price-ammenity">
                    <h4>Hourly Rate:</h4>
                    <h4 class="ammenity-rate"></h4>
                </div>
            </div>
        </div>
        <hr>
        <div class="wrapper-body">
            <table id="transact-list" class="display responsive wrap" style="width: 100%;">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Reservation Token</td>
                        <td>Event Start</td>
                        <td>Event End</td>
                        <td>Mode of Payment</td>
                        <td>Total Rate</td>
                        <td>Status</td>
                        <td>Message</td>
                        <td>Profile</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody id="transact-table">
                </tbody>
            </table>
        </div>
    </div>
</div>
