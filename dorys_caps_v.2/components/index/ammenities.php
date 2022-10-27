<?php
$fetchAmmenities = $ammenities->FetchAmmenities();
?>
<div class="ammenities" id="ammenities">
    <div class="header-title">
        <h1>Ammenities</h1>
    </div>
    <div class="wrapper">
    <?php
    $count = 0;
    if ($fetchAmmenities->num_rows > 0) {
        while ($row = $fetchAmmenities->fetch_assoc()) {
            if($count < 3){
            $images = explode(",", $row['images']);
            $features = explode(",", $row['features']);

    ?>
        <div class="card">
            <div class="content">
                <h2 class="title"><?= $row['name'] ?></h2>
                <p class="copy"><?= $row['description'] ?></p>
                <button data-amemnities="<?= $row['services_token']?>" class="btn" onclick="bookNow('<?= $row['services_token']?>')">Book Now</button>
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
        <button class="btn" onclick="viewMore()">View More</button>
    </div>
</div>