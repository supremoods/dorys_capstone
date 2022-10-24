<?php

$fetchTransactionDetails = new SqlClientQuery();

$reservation_tokn = $_GET['reservation_token'];

$transactionDetails = $fetchTransactionDetails->TransactDetails($reservation_tokn);

if ($transactionDetails->num_rows > 0) {
    $row = $transactionDetails->fetch_assoc();
    $images = explode(',', $row['images']);
?>
    <div class="transact-form" data-token="<?=$row['reservation_token']?>">
        <form class="elem-form" id="elem-form" method="post">
            <div class="elem-group">
                <div class="elem-item">
                    <label for="checkin-date">Check-in Date</label>
                    <input type="datetime-local" id="checkin-date" name="checkin" value="<?= $row['start_datetime'] ?>">
                </div>
                <div class="elem-item">
                    <label for="checkout-date">Check-out Date</label>
                    <input type="datetime-local" id="checkout-date" name="checkout" value="<?= $row['end_datetime'] ?>">
                </div>
            </div>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="ammenities-selection">Select Ammenity Preference</label>
                    <select id="ammenities-selection" data-service_token="<?=$row['service_token']?>" name="ammenities-selection">
                        <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                        <?php
                        $ammenities = $fetchTransactionDetails->FetchAmmenities();
                        if ($ammenities->num_rows > 0) {
                            while ($ammen = $ammenities->fetch_assoc()) {
                                if ($ammen['name'] != $row['name']) {
                        ?>
                                    <option value="<?= $ammen['name'] ?>"><?= $ammen['name'] ?></option>
                        <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="mode-of-payment">Select Payment Method</label>
                    <select id="mode-of-payment" name="mode-of-payment">
                        <?php
                        if($row['mode_of_payment'] == 'cash'){
                        ?>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                        <?php
                        }else{
                        ?>
                            <option value="card">Card</option>
                            <option value="cash">Cash</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="hourly-rate">Hourly Rate</label>
                    <input type="text" id="hourly-rate" value="₱<?= $row['price'] ?>" name="hourly-rate" value="₱ 600" disabled>
                </div>
                <div class="elem-item">
                    <label for="total-rate">Total Rate</label>
                    <input type="text" id="total-rate" name="total-rate" value="₱1500" disabled>
                </div>
            </div>
            <hr>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="message">Anything Else?</label>
                    <textarea id="message" name="visitor_message" ><?= $row['message'] ?></textarea>
                </div>
            </div>
            <div class="elem-group">
                <button type="button" class="cancel-transact-btn">Cancel</button>
                <button type="submit">Update Transaction</button>
            </div>
        </form>
    </div>
<?php
}
?>

<div class="container">
    <div class="gallery">
        <?php
        foreach ($images as $image) {
        ?>
        <div class="gallery-item" tabindex="0">
            <img src="/vendors/images/services/<?= $image ?>" class="gallery-image" alt="">
        </div>
        <?php
        }
        ?>
    </div>
</div>