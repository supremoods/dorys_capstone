<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: /admin");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Services</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header_links.php') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="/vendors/css/admin/global.css">
    <link rel="stylesheet" href="/vendors/css/admin/services.css">
    <link rel="stylesheet" href="/vendors/image_uploader/image-uploader.min.css">
</head>

<body class="bg-light">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/templates/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <h3 class="mb-4">Services</h3>

                <div class="container d-flex justify-content-end">
                    <!--- add services btn --->
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn add-btn-services" id="add-service-btn" data-bs-toggle="modal" data-bs-target="#addServicesForm">Add Service</button>
                        </div>
                    </div>
                </div>
                <div class="container p-2 w-100">
                    <div class="d-flex flex-column load-services">

                    </div>
                </div>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/modal/AddServiceForm.php') ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/modal/EditServiceForm.php') ?>
    </div>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer_scripts.php') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="/vendors/image_uploader/image-uploader.min.js"></script>
    <script src="/vendors/js/admin/authentication/auth_logout.js"></script>
    <script src="/vendors/js/admin/services.js"></script>

</body>

</html>