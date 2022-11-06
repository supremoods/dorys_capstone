<?php

$fetchTransactionDetails = new SqlClientQuery();

$service_token = $_GET['service_token'];
$start_date;
$end_date;
if (
    isset($_GET['date']) &&
    isset($_GET['start_time']) &&
    isset($_GET['end_time']) &&
   isset($_GET['hours'])
) {
    $date = $_GET['date'];
    $start_time = $_GET['start_time'];
    $end_time = $_GET['end_time'];
      $hours = $_GET['hours'];

    //conver start time to 24 hour format
    $start_time = date('H:i', strtotime($start_time));
    $end_time = date('H:i', strtotime($end_time));

    // combine date and time
    $start_date = $date . ' ' . $start_time;
    $end_date = $date . ' ' . $end_time;

}

$ammenitiesDetails = $fetchTransactionDetails->fetchAmmenitiesDetail(
    $service_token
);

if ($ammenitiesDetails->num_rows > 0) {

    $row = $ammenitiesDetails->fetch_assoc();
    $images = explode(',', $row['images']);
    ?>
<div class="transact-form" id="transact-form" data-token="<?= $row[
    'services_token'
] ?>">


   <form class="elem-form" id="booking-form" method="post">
      <div class="elem-group">
         <input type="datetime-local" id="checkin-date" value="<?= empty(
             $start_date
         )
             ? ''
             : $start_date ?>" name="checkin" hidden>
         <input type="datetime-local"id="checkout-date" value="<?= empty($end_date)
             ? ''
             : $end_date ?>" name="checkout" hidden>
         <input type="text" name="service-token" value="<?= $row[
             'services_token'
         ] ?>" hidden>
         <div class="elem-item">
            <label for="arrival-date">Select Date</label>
            <input type="date" id="arrival-date" value="<?= empty($date)
                ? ''
                : $date ?>" name="arrival-date" required>
         </div>
         <div class="elem-item">
            <label for="checkout-date">Select Time</label>
            <select name="select-time" id="select-time" required>
               <?php $start_time = date('h:i A', strtotime($start_time)); 
                  echo $start_time;
               ?>
               <!-- // CHECK IF START TIME IS EMPTY -->
               <?php if (!empty($start_time)) { ?>
                  <optgroup>
                     <option value="<?=  date('H:i', strtotime($start_time)) ?>"><?= $start_time ?></option>

                  </optgroup>

               <?php } else { ?>
                  <option value="0">Select Time</option>
               <?php } ?>
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
             'services_token'
         ] ?>" hidden required>
         <div class="elem-item select-hours">
            <label for="select-hours">Select Hours</label>
            <select name="select-hours" id="select-hours" required>
               <?php if (!empty($hours)) { 
                        for ($i = 1; $i <= 24; $i++) { ?>
                     <option value="<?= $i ?>" <?= $i == $hours ? 'selected' : '' ?>>
                        <?= $i ?>
                     </option>
                  <?php 
                        } 
                     } else { ?>
                  
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
               <option value="6">6</option>
               <option value="7">7</option>
               <option value="8">8</option>
               <option value="9">9</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
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
                'services_token'
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
            <input type="text" id="res-fee" name="res-fee" readonly="readonly">
         </div>
      </div>
      <hr>
      <div class="elem-group">
         <div class="elem-item">
            <label for="message">Anything Else?</label>
            <textarea id="message" name="client_message"
               placeholder="Tell us anything else that might be important"></textarea>
         </div>
      </div>
      <!-- terms and conditions -->
      <div class="elem-group">
         <div class="elem-item t-a-cond">
            <input type="checkbox" id="terms-and-conditions" name="terms-and-conditions" required>
            <label for="terms-and-conditions">I agree to the <a onclick="termsCondition()" href="javascript:void(0)">Terms and
                  Conditions</a></label>
         </div>
      </div>
      <div class="elem-group ">
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
      <?php foreach ($images as $image) { ?>
      <div class="gallery-item" tabindex="0">
         <img src="/public/images/services/<?= $image ?>" class="gallery-image" alt="">
      </div>
      <?php } ?>
   </div>
</div>