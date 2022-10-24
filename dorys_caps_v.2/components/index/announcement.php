<?php
  $fetchAnnouncement = new SqlClientQuery();
  $message = $fetchAnnouncement->fetchAnnouncements();

?>
<div class="announcement">
    <div class="wrapper">
        <div class="announcement-content">
            <h2 class="title">Announcement</h2>
            <p><?=$message['message']?></p>
        </div>
        <div class="model-3d">
            <img src="vendors/images/3d_items/announcement.png" alt="">
        </div>
    </div>
</div>