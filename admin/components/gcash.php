<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

   $sqlAdminQuery = new SqlAdminQuery();

   $fetchGcashDetails = $sqlAdminQuery->fetchPaymentDetails();
?>
<div class="manage-gcash">
    <div class="wrapper">
        <div class="wrapper-header">
            <div class="header-title">
                <h1>Manage Gcash Details</h1>
            </div>
        </div>
        <hr>
        <div class="wrapper-body">
            <div class="gcash-form-wrapper">
               <form id="gcash-form" class="gcash-form" method="POST" enctype="multipart/form-data">
                  <div class="form-group qr-img">
                     <div class="qr-container">
                        <img id="qr-img" src="/public/images/qrCode/<?= !$fetchGcashDetails ? 'default.png' : $fetchGcashDetails['gcash_qr'] ?>" alt="gcash-qr">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="upload-btn-qr" for="gcash-qr">Upload QR Code</label>
                     <input type="file" name="gcash-qr" id="gcash-qr" value="<?=$fetchGcashDetails['gcash_qr']?>" class="form-input" hidden>
                  </div>
                  <div class="form-group">
                     <label for="gcash-number">Gcash Number</label>
                     <input type="text" name="gcash-number" id="gcash-number" value="<?=$fetchGcashDetails['number']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Please input gcash number" class="form-input">
                  </div>
                  <div class="form-group">
                     <label for="gcash-name">Gcash Name</label>
                     <input type="text" name="gcash-name" id="gcash-name" value="<?=$fetchGcashDetails['name']?>" class="form-input" placeholder="Please input name" >
                  </div>
                  <div class="form-group">
                     <button type="submit" name="submit" class="save-button">Save</button>
                  </div>
               </form>
            </div>
        </div>
    </div>
</div>