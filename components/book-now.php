<?php

$fetchTransactionDetails = new SqlClientQuery();

$service_token = $_GET['service_token'];
$start_date;
$end_date;
if(isset($_GET['date']) && isset($_GET['start_time']) && isset($_GET['end_time'])){
    $date = $_GET['date'];
    $start_time = $_GET['start_time'];
    $end_time = $_GET['end_time'];

    // combine date and time
    $start_date = $date . " " . $start_time;
    $end_date = $date . " " . $end_time;
}

$ammenitiesDetails = $fetchTransactionDetails->fetchAmmenitiesDetail($service_token);


if ($ammenitiesDetails->num_rows > 0) {
    $row = $ammenitiesDetails->fetch_assoc();
    $images = explode(',', $row['images']);
?>
    <div class="transact-form" id="transact-form" data-token="<?=$row['services_token']?>">
        <div class="occupied-time">
            <div class="inner-wrapper">
                <h3>Occupied Time</h3>
                <div class="occupied-time-container">
       
                </div>
            </div>
    
        </div>

        <form class="elem-form" id="booking-form" method="post">
            <div class="elem-group">
                <input type="text" name="service-token" value="<?=$row['services_token']?>" hidden>
                <div class="elem-item">
                    <label for="checkin-date">Check-in Date</label>
                    <input type="datetime-local" id="checkin-date" value="<?=empty($start_date)? '': $start_date?>" name="checkin" >
                </div>
                <div class="elem-item">
                    <label for="checkout-date">Check-out Date</label>
                    <input type="datetime-local" value="<?=empty($start_date)? '': $end_date?>" id="checkout-date" name="checkout" >
                </div>
            </div>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="ammenities-selection">Select Ammenity Preference</label>
                    <select id="ammenities-selection" data-service_token="<?=$row['services_token']?>" name="ammenities-selection">
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
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                    </select>
                </div>
            </div>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="hourly-rate">Hourly Rate</label>
                    <input type="text" id="hourly-rate" value="₱<?= $row['price'] ?>" name="hourly-rate" value="₱ 600"  readonly="readonly" >
                </div>
                <div class="elem-item">
                    <label for="total-rate">Total Rate</label>
                    <input type="text" id="total-rate" name="total-rate" value="₱<?= $row['price'] ?>"  readonly="readonly" >
                </div>
            </div>
            <hr>
            <div class="elem-group">
                <div class="elem-item">
                    <label for="message">Anything Else?</label>
                    <textarea id="message" name="client_message" placeholder="Tell us anything else that might be important" ></textarea>
                </div>
            </div>
            <div class="elem-group">
                <button type="button" class="cancel-book-btn">Cancel</button>
                <button type="submit">Book Now</button>
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
            <img src="/public/images/services/<?= $image ?>" class="gallery-image" alt="">
        </div>
        <?php
        }
        ?>
    </div>
</div>