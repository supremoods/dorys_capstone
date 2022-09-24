<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DORS - ContactUs</title>
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
        <h1 class="h-font fw-bold text-center">Contact Us</h1>
        <div class="h-line "></div>
        <p class="text-center mt-3">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,<br>
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </p>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4 ">
                <div class="bg-white rounded shadow p-4 card-body">
                    <iframe class="w-100 rounded" height="320" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.2576241097585!2d120.9597056697968!3d14.649016136257195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5b6ba02957f%3A0x91b89c7caf3fb618!2s!5e0!3m2!1sfil!2sph!4v1659412181796!5m2!1sfil!2sph" loading="lazy"></iframe>
                    <h5 class="fw-bold mt-4 mb-2">Address</h5>
                    <a href="https://goo.gl/maps/VZomZsNYu12ehXJT7" target="_blank" class="d-inline-block text-decoration-none text-hov">
                        <i class="bi bi-pin-map-fill "></i> 20 Hasa-Hasa Longos, Dory's Private Resort
                    </a>
                    <h5 class="fw-bold mt-2 mb-2">Contact Us</h5>
                    <a href="+9297575119" class="d-inline-block mb-2 text-decoration-none text-hov">
                        <i class="bi bi-telephone-fill"></i> +9297575119</a>
                    <h5 class="fw-bold mt-2 mb-2">Email Us</h5>
                    <a href="email" class="d-inline-block mb-2 text-decoration-none text-hov">
                        <i class="bi bi-envelope-fill"></i> Dorysresort@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 card-body ">
                    <form action="">
                        <h5 class="fw-bold text-col">Send us a message</h5>
                        <div class="mb-3">
                            <label class="form-label fw-200">Name</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-200">Email</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-200">Subject</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-200">Message</label>
                            <textarea class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
                        </div>
                        <button type="submit" class="btn shadow-none custom-bg shadow-none">Send</button>
                </div>
                </form>
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