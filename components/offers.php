<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');
$ammenities = new SqlClientQuery();
$fetchAmmenities = $ammenities->FetchAmmenities();

?>
  <div class="header-title">
    <h1>Ammenities</h1>
  </div>
<div class="offers-container">

  <?php
  $count = 0;
  if($fetchAmmenities->num_rows>0){
      while($row = $fetchAmmenities->fetch_assoc()){
        $images = explode(",", $row['images']);
  ?>
  <div class="blog-card <?= $count % 2 == 0 ? '' : "alt" ?>">
    <div class="meta">
      <div class="photo" style="background-image: url(/public/images/services/<?=trim($images[0])?>)"></div>
    </div>
    <div class="description">
      <h1><?=$row['name']?></h1>
      <h2>Hourly Rate: ₱ <?=$row['price']?></h2>
      <p><?=$row['description']?></p>
      <p class="read-more">
        <?php
          if($notVerified){
        ?>
         <a href="javascript:checkIfAccountIsVerified()">Book Now</a>
        <?php
          }else{
        ?>
        <a href="/pages/book-now.php?service_token=<?=$row['services_token']?>">Book Now</a>
        <?php
          }
          ?>
      </p>
    </div>
  </div>
  <?php
      $count++;
      }
  }
  ?>
</div>

