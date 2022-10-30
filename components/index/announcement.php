<?php
  $fetchAnnouncement = new SqlClientQuery();
  $message = $fetchAnnouncement->fetchAnnouncements();


?>
<div class="announcement">
    <div class="wrapper">
        <?php
            if(!empty($message['message'])){
        ?>
        <div class="announcement-content">
            <h2 class="title">Announcement</h2>
            <p><?=$message['message']?></p>
        </div>
        <div class="model-3d">
            <img src="public/images/3d_items/announcement.png" alt="">
        </div>
        <?php
        }
        ?>
    </div>
</div>