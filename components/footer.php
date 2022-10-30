<?php

$contactDetails = new SqlClientQuery();

$fetch = $contactDetails->fetchContactDetails();

?>

<footer class="footer-distributed">
    <div class="footer-left">
        <img src="/public/images/logo/dorys_logo.png" alt="logo" class="logo">
        <p class="footer-links">
            <a href="#" class="link-1">Home</a>
            <a href="#">Amenities</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </p>
        <p class="footer-company-name">Dory's Private Resort © 2022</p>
    </div>
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p><span><?=$fetch['address']?></span></p>
        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p><span><?=$fetch['phone_number_1']?></span><span><?=$fetch['phone_number_2']?></span></p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:support@company.com"><?=$fetch['email']?></a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span>About the company</span>
            Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus
            vehicula sit amet.
        </p>
        <div class="footer-icons">
            <a href="<?=$fetch['facebook']?>"><i class="fa fa-facebook"></i></a>
            <a href="<?=$fetch['twitter']?>"><i class="fa fa-twitter"></i></a>
        </div>
    </div>
</footer>