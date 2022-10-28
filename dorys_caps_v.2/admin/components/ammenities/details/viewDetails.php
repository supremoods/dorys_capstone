<?php
$ammenity = $_GET['ammenity'];
$token = $_GET['service_token'];
?>
<div class="slider-container" data-ammenity="<?= $token ?>">
    <div class="wrapper">
        <div class="profile-toggle">
            <div>
                <label class="switch">
                    <input id="toggle-edit" type="checkbox">
                    <span>
                        <em></em>
                        <strong></strong>
                    </span>
                </label>
            </div>
        </div>
        <div class="container">
            <div class="back-btn">
                <a href="/admin/dashboard/manage_ammenities.php"><i class="fas fa-arrow-left"></i></a>
            </div>
            <input type="text" name="name" id="ammenity-name" class="ammenity-name">
        </div>
        <div class="container-body">
            <div class="ammenity-content">
                <div class="ammenity-desc-item">
                    <label for="rate">Hourly Rate</label>
                    <div class="group">
                        <p>₱</p>
                        <input type="number" name="rate" id="ammenity-rate" class="ammenity-rate"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                    </div>
                </div>
                <div class="ammenity-desc-item">
                    <label for="rate">Description</label>
                    <textarea type="text" id="description" name="description"></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-gallery">
            <div class="gallery-header">
                <h3>Gallery</h3>
                <div class="gallery-btn">
                    <button class="add-image-btn"><i class="fas fa-plus"></i> Add Image</button>
                </div>
            </div>
            <div class="masonry">

            </div>
        </div>
    </div>
</div>