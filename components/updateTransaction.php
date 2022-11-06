<?php

$fetchTransactionDetails = new SqlClientQuery();

$reservation_token = $_GET['reservation_token'];

$transactionDetails = $fetchTransactionDetails->TransactDetails(
    $reservation_token
);

if ($transactionDetails->num_rows > 0) {

    $row = $transactionDetails->fetch_assoc();
    $images = explode(',', $row['images']);
    ?>
<div class="transact-form" id="transact-form" data-token="<?= $row[
    'service_token'
] ?>">

   <form class="elem-form" id="booking-form" method="post">
      <div class="elem-group">
      <input type="text" value="<?= $row['service_token'] ?>" name="service_token" hidden>
      <input type="text" value="<?= $row['reservation_token']?>" name="reservation_token" hidden>
      <input type="datetime-local" id="checkin-date" value="<?= $row[
          'start_datetime'
      ] ?>" name="start_datetime" hidden>
      <input type="datetime-local"id="checkout-date" value="<?= $row[
          'end_datetime'
      ] ?>" name="end_datetime" hidden>
         <input type="text" name="service-token" value="<?= $row[
             'service_token'
         ] ?>" hidden>
         <div class="elem-item">
            <label for="arrival-date">Select Date</label>
            <?php $new_date = date(
                'Y-m-d',
                strtotime($row['start_datetime'])
            ); ?>
            <input type="date" id="arrival-date" value="<?= $new_date ?>" name="arrival-date" required>
         </div>
         <div class="elem-item" >
            <?php
            $start_time = date('H', strtotime($row['start_datetime']));
            $end_time = date('H', strtotime($row['end_datetime']));

            // get the range between start and end time
            $range = range($start_time, $end_time);

            // get the length of the range
            $range_length = count($range) - 1;
            ?>
            <label for="checkout-date">Select Time</label>
            <select name="select-time" id="select-time" required>
               <optgroup label="Morning">
                  <option value="01:00">1:00 AM</option>
                  <option value="02:00">2:00 AM</option>
                  <option value="03:00">3:00 AM</option>
                  <option value="04:00">4:00 AM</option>
                  <option value="05:00">5:00 AM</option>
                  <option value="06:00">6:00 AM</option>
                  <option value="07:00">7:00 AM</option>
                  <option value="08:00">8:00 AM</option>
                  <option value="09:00">9:00 AM</option>
                  <option value="10:00">10:00 AM</option>
                  <option value="11:00">11:00 AM</option>
                  <option value="12:00">12:00 PM</option>
               </optgroup>
               <optgroup label="Afternoon">
                  <option value="13:00">1:00 PM</option>
                  <option value="14:00">2:00 PM</option>
                  <option value="15:00">3:00 PM</option>
                  <option value="16:00">4:00 PM</option>
                  <option value="17:00">5:00 PM</option>
               </optgroup>
               <optgroup label="Evening">
                  <option value="18:00">6:00 PM</option>
                  <option value="19:00">7:00 PM</option>
                  <option value="20:00">8:00 PM</option>
                  <option value="21:00">9:00 PM</option>
                  <option value="22:00">10:00 PM</option>
                  <option value="23:00">11:00 PM</option>
                  <option value="24:00">12:00 AM</option>
               </optgroup>
            </select>
         </div>
      </div>
      <div class="elem-group ">
         <input type="text" name="service-token" value="<?= $row[
             'service_token'
         ] ?>" hidden required>
         <div class="elem-item select-hours">
            <label for="select-hours">Select Hours</label>
            <select name="select-hours" id="select-hours" required>
                <?php for ($i = 1; $i <= 24; $i++) { ?>
                        <option value="<?= $i ?>" <?= $i == $range_length
    ? 'selected'
    : '' ?>><?= $i ?></option>
                    <?php } ?>
            </select>
         </div>
         <div class="elem-group">
            <div class="elem-item">
               <label for="arrival-time">Arrival</label>
               <input readonly id="arrival-time" placeholder="--:-- --" >
            </div>
            <div class="elem-item">
               <label for="departure-time">Departure</label>
               <input readonly id="departure-time" placeholder="--:-- --" >
            </div>
         </div>
      </div>
      <div class="elem-group">
         <div class="elem-item">
            <label for="ammenities-selection">Select Ammenity Preference</label>
            <select id="ammenities-selection" data-service_token="<?= $row[
                'service_token'
            ] ?>"
               name="ammenities-selection">
               <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
               <?php
               $ammenities = $fetchTransactionDetails->FetchAmmenities();
               if ($ammenities->num_rows > 0) {
                   while ($ammen = $ammenities->fetch_assoc()) {
                       if ($ammen['name'] != $row['name']) { ?>
               <option value="<?= $ammen['name'] ?>"><?= $ammen[
    'name'
] ?></option>
               <?php }
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
               <option value="gcash">Gcash</option>
            </select>
         </div>
      </div>
      <div class="elem-group">
         <div class="elem-item">
            <label for="hourly-rate">Hourly Rate</label>
            <input type="text" id="hourly-rate" value="₱<?= $row[
                'price'
            ] ?>" name="hourly-rate" value="₱ 600"
               readonly="readonly">
         </div>
         <div class="elem-item">
            <label for="total-rate">Total Rate</label>
            <input type="text" id="total-rate" name="total-rate" value="₱<?= $row[
                'price'
            ] ?>" readonly="readonly">
         </div>
      </div>
      <div class="elem-group">
         <div class="elem-item">
            <label for="payment-type">Select Payment type</label>
            <select id="payment-type" name="payment-type">
               <option value="Downpayment">Downpayment</option>
               <option value="Fully Paid">Fully Paid in Advance</option>
            </select>
         </div>
         <div class="elem-item">
            <label for="total-rate">Reservation Fee</label>
            <input type="text" id="res-fee" name="res-fee" readonly="readonly" data-paid_amount="<?= $row[
                'paid_amount'
            ] ?>">
         </div>
      </div>
      <hr>
      <div class="elem-group">
         <div class="elem-item">
            <label for="message">Anything Else? (optional)</label>
            <textarea id="message" name="client_message"
               placeholder="Tell us anything else that might be important"></textarea>
         </div>
      </div>

      <div class="elem-group ">
         <button type="button" class="cancel-book-btn">Cancel</button>
         <button type="submit">Save Changes</button>
      </div>
   </form>
</div>
<?php
}
?>
<div class="container">
    <div class="gallery">
        <?php foreach ($images as $image) { ?>
        <div class="gallery-item" tabindex="0">
            <img src="/public/images/services/<?= $image ?>" class="gallery-image" alt="">
        </div>
        <?php } ?>
    </div>
</div>