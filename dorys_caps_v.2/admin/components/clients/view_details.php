<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/admin/model/admin/SqlAdminQuery.php');

    $fetchClientDetails = new SqlAdminQuery;
    $user_token = $_GET['client_id'];

    $res = $fetchClientDetails->fetchClientDetails($user_token);

    $res = $res->fetch_assoc();
?>

<div class="profile">
    <div class="wrapper">
        <div class="profile-card" data-token="<?=$user_token?>">
            <div class="card">
                <div class="card-header" style="background-image: url(/vendors/images/client/<?= is_null($res['avatar']) ? "oreo.png" : $res['avatar'] ?>)">
                    <div class="card-header-slanted-edge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                            <path class="polygon" d="M-20,200,1000,0V200Z" />
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="name"><?=$res['fullname']?></h2>
                    <h4 class="prof-email"><?=$res['email']?></h4>
                </div>
                <div class="card-footer">
                    <p class="<?=$res['fullname']?>" ><?=$res['status']?></p>
                </div>
            </div>
        </div>
        <div class="profile-info">
            <div class="profile-wrapper">
                <div class="profile-info__header">
                    <div class="profile-title">
                        <h2 class="profile-info__title">Profile Info</h2>
                    </div>
                </div>
                <div class="profile-info__body">
                    <div class="info-row">
                        <div class="info-label">Name</div>
                        <div class="info-value f-name"><?=$res['fullname']?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value email"><?=$res['email']?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value phone"><?=$res['number']?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Address</div>
                        <div class="info-value address"><?=str_replace('/', ' ', $res['address'])?></div>
                    </div>
                </div>
            </div>
            <div class="profile-wrapper">
                <div class="profile-info__header">
                    <div class="profile-title">
                        <h2 class="profile-info__title">Transaction</h2>
                    </div>
                </div>
                <table id="profile-table" class="display responsive wrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Event Start</td>
                            <td>Event End</td>
                            <td>Mode of Paymennt</td>
                            <td>Hourly Rate</td>
                            <td>Total Rate</td>
                            <td>Status</td>
                            <td>Message</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                <tbody id="profile-data">
                </tbody>
            </div>
        </div>
    </div>
</div>