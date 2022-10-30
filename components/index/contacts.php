<?php

$contactDetails = new SqlClientQuery();

$fetch = $contactDetails->fetchContactDetails();

?>
<div class="contacts" id="contacts">
    <div class="wrapper">
        <span class="big-circle"></span>
        <div class="form">
            <div class="contact-info">
                <h3 class="title">Let's get in touch</h3>
                <p class="text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
                    dolorum adipisci recusandae praesentium dicta!
                </p>

                <div class="info">
                    <div class="information">
                        <i class="fa-solid fa-location-dot"></i>
                        <p><?=$fetch['address']?></p>
                    </div>
                    <div class="information">
                        <i class="fa-solid fa-envelope"></i>
                        <p><?=$fetch['email']?></p>
                    </div>
                    <div class="information">
                        <i class="fa-solid fa-phone"></i>
                        <p><?=$fetch['phone_number_1']?></p>
                    </div>
                    <div class="information">
                        <i class="fa-solid fa-phone"></i>
                        <p><?=$fetch['phone_number_2']?></p>
                    </div>
                </div>

                <div class="social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
                        <a href="<?=$fetch['facebook']?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?=$fetch['twitter']?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <iframe src="<?=$fetch['iframe']?>" frameborder="0"></iframe>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>
    
                <form method="POST" id="contact-form" autocomplete="off">
                    <h3 class="title">Contact us</h3>
                    <?php
                    if (!isset($_SESSION['session_token'])) {
                    ?>  
                    <div class="input-container">
                        <input type="email" name="email" class="input-c-items email" required>
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="phone" class="input-c-items phone" required>
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>
                    <?php
                    }else{
                        $fetchClient = new SqlClientQuery();
                        $client = $fetchClient->fetchClientDetails($_SESSION['user_token']);
                    ?>
                    <div class="input-container">
                        <input type="email" name="email" class="input-c-items email" value="<?=$client['email']?>" readonly required>
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="phone" class="input-c-items phone" value="<?=$client['number']?>" readonly required>
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>

                    <?php
                    }
                    ?>
                    <div class="input-container textarea">
                        <textarea name="message" class="input-c-items"></textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>
                    <input type="submit" value="Send" class="btn" />
                </form>
            </div>
        </div>
    </div>
</div>