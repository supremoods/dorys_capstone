<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Settings</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/header_links.php')?>
    <link rel="stylesheet" href="/vendors/css/admin/global.css">
</head>
<body class="bg-light">
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/templates/header.php')?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTINGS</h3>
                <!--- general settings --->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title mb-2 m-0">General Settings</h5>
                            <button type="button" class="btn custom-bg shadow-none" data-bs-toggle="modal" data-bs-target="#general-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold p-2">Announcement</h6>
                        <p class="card-text" id="web_about"></p>
                    </div>
                </div>
                <!--- General Settings Form--->
                <div class="modal fade" id="general-settings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog mb-4">
                        <form class="" id="general-settings-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Announcement</label>
                                        <textarea name="web_about" id="web_about_f" class="form-control shadow-none" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="web_title.value = general_data.web_title, web_about.value = general_data.web_about" class="btn custom-bg shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg-2 shadow-none" data-bs-dismiss="modal">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--- Shutdown Section--->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title mb-2 m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                </form>
                            </div>
                        </div>
                        <p class="card-text">No Customers will be allowed to make reservation while the website is shutdown!</p>
                    </div>
                </div>
                <!--- Contact Details Settings--->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <button type="button" class="btn custom-bg shadow-none" data-bs-toggle="modal" data-bs-target="#contact-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold p-2">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold p-2">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold p-2">Phone Number</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="mn1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="mn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold p-2">E-mail</h6>
                                    <p class="card-text" id="email">
                                        <i class=" bi bi-envelope-fill"></i>
                                        <span id="mail"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold p-2">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-twitter me-1"></i>
                                        <span id="tw"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-facebook me-1"></i>
                                        <span id="fb"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold p-2">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--- Contact Details Form--->
                <div class="modal fade" id="contact-settings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg mb-4">
                        <form class="" method="post" id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Detail Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input name="address" id="address_f" type="text" class="form-control shadow-none" required>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input name="gmap" id="gmap_f" type="text" class="form-control shadow-none" required>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Mobile Number (with country code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="text" name="mn1" id="mn1_f" class="form-control shadow-none">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="text" name="mn2" id="mn2_f" class="form-control shadow-none">
                                                    </div>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">E-mail</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                                        <input type="email" name="mail" id="mail_f" class="form-control shadow-none">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-twitter me-1"></i></span>
                                                        <input type="text" name="tw" id="tw_f" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-facebook me-1"></i></span>
                                                        <input type="text" name="fb" id="fb_f" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label class="form-label fw-bold">iFrame Src</label>
                                                        <input name="iframe" id="iframe_f" type="text" class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contacts_f(contacts_data)" class="btn custom-bg shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg-2 shadow-none" data-bs-dismiss="modal">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/footer_scripts.php')?>
</body>
</html>