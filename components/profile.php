<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');
$fetchClient = new SqlClientQuery();
$client = $fetchClient->fetchClientDetails($_SESSION['user_token']);
?>
<div class="profile">
    <div class="wrapper">
        <div class="profile-card">
            <div class="card">
                <div class="card-header" style="background-image: url(/public/images/client/<?= is_null($client['avatar']) ? "avatar.png" : $client['avatar'] ?>)">
                    <div class="card-header-slanted-edge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                            <path class="polygon" d="M-20,200,1000,0V200Z" />
                        </svg>
                        <button class="btn-update" id="btn-update"><span class="sr-only">Change Profile</span></button>                      <!-- upload image -->
                        <form method="POST" enctype="multipart/form-data" id="form-avatar-upload">
                            <input type="file" name="avatar" id="update-avatar" class="input-file" hidden>
                            <input type="submit" id="submit-avatar" hidden>
                        </form>
                    </div>
                </div>
                
                <div class="card-body">
                    <h2 class="name"><?=$client['fullname']?></h2>
                    <h4 class="prof-email"><?=$client['email']?></h4>
                    <a href="/controller/client/LogoutController.php">Logout</a>
                </div>

            </div>


        </div>
        <div class="profile-settings">
            <div class="profile-settings__header">
                <div class="profile-title">
                    <h2 class="profile-settings__title">Profile Settings</h2>
                </div>
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
            </div>
            <div class="profile-settings__body">
                <div class="profile-settings__form">
                    <form method="POST" id="edit-profile-form">
                        <div class="profile-settings__form-group">
                            <label for="name" class="profile-settings__form-label">Name</label>
                            <input type="text" name="name" id="name" class="profile-settings__form-input" value="<?= $client['fullname'] ?>" disabled>
                        </div>
                        <div class="profile-settings__form-group">
                            <label for="email" class="profile-settings__form-label">Email</label>
                            <input type="email" name="email" id="email" class="profile-settings__form-input" value="<?= $client['email'] ?>" disabled>
                        </div>
                        <div class="profile-settings__form-group">
                            <label for="number" class="profile-settings__form-label">Phone Number</label>
                            <input type="text" name="number" id="number" class="profile-settings__form-input" <?php
                                                                                                                if (is_null($client['number'])) {
                                                                                                                    echo "placeholder='Enter your phone number'";
                                                                                                                } else {
                                                                                                                    echo "value='" . $client['number'] . "'";
                                                                                                                }
                                                                                                                ?> disabled>
                        </div>
                        <div class="profile-settings__form-group">
                            <label for="address-line-1" class="profile-settings__form-label">Address Line 1</label>
                            <input type="text" name="address-line-1" id="address-line-1" class="profile-settings__form-input" <?php
                                                                                                                                if (is_null($client['address'])) {
                                                                                                                                    echo "placeholder='Enter your address'";
                                                                                                                                } else {
                                                                                                                                    $address = explode("/", $client['address']);
                                                                                                                                    echo "value='" . $address[0] . "'";
                                                                                                                                }
                                                                                                                                ?> disabled>
                        </div>
                        <div class="profile-settings__form-group">
                            <label for="address-line-2" class="profile-settings__form-label">Address Line 2 <i>(optional)</i> </label>
                            <input type="text" name="address-line-2" id="address-line-2" class="profile-settings__form-input" <?php
                                                                                                                                if (is_null($client['address'])) {
                                                                                                                                    echo "placeholder='Enter your address'";
                                                                                                                                } else {
                                                                                                                                    $address = explode("/", $client['address']);
                                                                                                                                    echo "value='" . $address[1] . "'";
                                                                                                                                }
                                                                                                                                ?> disabled>
                        </div>
                        <input type="submit" class="profile-settings__form-btn" value="Save Changes" disabled>
                    </form>
                </div>
                <hr>
                <div class="profile-settings__form">
                    <div class="password-label">
                        <div class="title">
                            <h2 class="password-label__title">Update Password</h2>
                        </div>
                        <div class="icon-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <form method="POST" id="update-password" autocomplete="off">
                        <div class="profile-settings__form-group old-pass-grp">
                            <label for="old-password" class="profile-settings__form-label">Old Password</label>
                            <input type="password" name="old-password" title="Press -Enter- to verify" id="old-password" class="profile-settings__form-input" placeholder="Enter your old password" >
                            <p class="message"></p>
                        </div>
                        <div class="profile-settings__form-group new-pass-grp">
                            <label for="new-password" class="profile-settings__form-label">New Password</label>
                            <input type="password" name="new-password" id="new-password" class="profile-settings__form-input" placeholder="Enter your new password" disabled>
                            <p class="message"></p>
                        </div>
                        <div class="profile-settings__form-group confirm-pass-grp">
                            <label for="confirm-password" class="profile-settings__form-label">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="profile-settings__form-input" placeholder="Confirm your new password" disabled>
                            <p class="message"></p>
                        </div>
                        <input type="submit" class="profile-settings__form-btn" id="update-pass-btn" value="Save Changes" disabled>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../components/modals/modalAlert.php'; ?>