<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DORS - Features</title>
    <?php require('../templates/header_links.php'); ?>
    <link rel="stylesheet" href="../vendors/css/global.css">
    <link rel="stylesheet" href="../vendors/css/footer.css">
    <style>
        .item:hover {
            border-top-color: #EB6A00 !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('../templates/header.php'); ?>
    <div class="my-5 px-4">
        <h1 class="h-font fw-bold text-center ">Facility Features</h1>
        <div class="h-line"></div>
        <p class="text-center mt-3">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,<br>
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark item">
                    <div class="d-flex align-item center mb-2">
                        <img class="overflow-hidden " src="../vendors/images/carousel/car-1.jpg" alt="">
                        <h5 class="m-0 ms-3">VIP</h5>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark item">
                    <div class="d-flex align-item center mb-2">
                        <img class="overflow-hidden " src="../vendors/images/carousel/car-1.jpg" alt="">
                        <h5 class="m-0 ms-3">VIP</h5>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark item">
                    <div class="d-flex align-item center mb-2">
                        <img class="overflow-hidden " src="../vendors/images/carousel/car-1.jpg" alt="">
                        <h5 class="m-0 ms-3">VIP</h5>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('../templates/footer.php');
    include('../modal/login.php');
    include('../modal/registration.php');
    include_once('../templates/footer_scripts.php');
    ?>
</body>

</html>