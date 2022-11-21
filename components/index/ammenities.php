<?php
$fetchAmmenities = $ammenities->FetchAmmenities();
?>
<div class="ammenities" id="ammenities">
   <div class="header-title">
      <h1>Amenities</h1>
   </div>
   <div class="wrapper">
      <?php
        $count = 0;
        if ($fetchAmmenities->num_rows > 0) {
            while ($row = $fetchAmmenities->fetch_assoc()) {
                if ($count < 3) {
                    $images = explode(",", $row['images']);
                    $features = explode(",", $row['features']);

        ?>
      <div class="card">
         <div class="content">
            <h2 class="title"><?= $row['name'] ?></h2>
            <p class="copy"><?= $row['description'] ?></p>
            <?php
               if (isset($_SESSION['session_token'])) {
                  if($notVerified){
            ?>
               <button data-amemnities="<?= $row['services_token'] ?>" class="btn" onclick="checkIfAccountIsVerified()">Book Now</button>
            <?php
                  }else{
            ?>
               <button data-amemnities="<?= $row['services_token'] ?>" class="btn" onclick="bookNow('<?= $row['services_token'] ?>')">Book Now</button>
            <?php
                  }
               } else {
            ?>
               <button class="btn" onclick="regModal()">Book Now</button>
            <?php
               }
            ?>
         </div>
      </div>
      <?php
                }
                $count++;
            }
        }
        ?>
   </div>
   <div class="view-more">
      <button class="btn" onclick="window.location.href=` /pages/ammenities.php`">View More</button>
   </div>
</div>