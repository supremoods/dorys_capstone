<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DORS | AboutUs</title>
    <?php require('../templates/header_links.php'); ?>
    <link rel="stylesheet" href="../vendors/css/global.css">
    <link rel="stylesheet" href="../vendors/css/footer.css">
</head>

<body class="bg-light">
    <?php require('../templates/header.php'); ?>
    <div class="my-5 px-4">
        <h1 class="h-font fw-bold text-center">About Us</h1>
        <div class="h-line "></div>
        <p class="text-center mt-3">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,<br>
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </p>
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center ">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Lorem Ipsum.</h3>
                <p class="">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                </p>
            </div>
            <div class="col-lg-5 col-md-5 order-lg-2 order-md-2 order-1">
                <img src="../vendors/images/carousel/DORS-logo.png" class="w-100 mb-4" alt="">
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