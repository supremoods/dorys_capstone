<?php

    $ammenities = new SqlClientQuery();

    $fetchAmmenities = $ammenities->FetchAmmenities();

  

?>
<div class="slider-cover">
    <div class="media-icons">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></i></a>
    </div>
    <div class="swiper bg-slider">
        <div class="swiper-wrapper">
            <?php

            if ($fetchAmmenities->num_rows > 0) {

                while ($row = $fetchAmmenities->fetch_assoc()) {
                    $images = explode(",", $row['images']);
                    $features = explode(",", $row['features']);
            ?>
            <div class="swiper-slide dark-layer">
                <img src="public/images/services/<?= trim($images[0]) ?>" alt="">
                <div class="text-content">
                    <h2 class="title"><?= $row['name'] ?></h2>
                    <pre><?= $row['description'] ?></pre>
                    <button data-amemnities="<?= $row['services_token']?>" class="book-now-btn" onclick="bookNow('<?= $row['services_token']?>')">Book Now <i class="uil uil-arrow-right"></i></button>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="bg-slider-thumbs" data-swiper-autoplay="2000">
        <div class="swiper-wrapper thumbs-container">
        <?php
        $fetchAmmenities = $ammenities->FetchAmmenities();
        if ($fetchAmmenities->num_rows > 0) {

            while ($row = $fetchAmmenities->fetch_assoc()) {
                $images = explode(",", $row['images']);
                $features = explode(",", $row['features']);
        ?>
            <img src="public/images/services/<?= trim($images[0]) ?>" class="swiper-slide" alt="">
        <?php
            }
        }
        ?>
        </div>
    </div>
</div>