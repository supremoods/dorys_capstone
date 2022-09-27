<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DORS - Services</title>
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
        <h1 class="h-font fw-bold text-center ">Our Services</h1>
        <div class="h-line"></div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-12 mb-4 px-lg-0">

                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow rounded mb-4">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">Filter</h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size:18px">Check Availability</h5>
                                <label class="form-label-">Check-in</label>
                                <input type="datetime-local" class="form-control shadow-none">
                                <label class="form-label-">Check-out</label>
                                <input type="datetime-local" class="form-control shadow-none">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3 ">
                                <h5 class="mb-3" style="font-size:18px">Services</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none mb-3 me-1">
                                    <label class="form-check-label" for="f1">VIP</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none mb-3 me-1">
                                    <label class="form-check-label" for="f2">Alfresco</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none mb-3 me-1">
                                    <label class="form-check-label" for="f3">Gazebo</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size:18px">Guest</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label" for="f1">Number of Persons</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9 col-md-12 px-4">
                <div class="card mb-2 border-0 shadow">
                    <div class="row g-0 p-3 alig-item-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="../vendors/images/carousel/car-1.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="col-md-5 text-center px-lg-3 px-md-3 px-0">
                            <h5 class="mb-4 tex-center">VIP</h5>
                            <div class="features mb-3 text-center">
                                <h6 class="mb-1 text-col">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                    Air Conditioned<br>Videoke<br>Barbecue Grill<br>Food Warmer<br>Water Dispenser
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="text-align-center">
                                <h6 class="card-title mb-4">$500 Perhour</h5>
                                    <a href="#" class="btn btn-sm w-100 mb-1 custom-bg shadow-none">Book Now</a>
                                    <a href="#" class="btn btn-sm w-100 mt-1 custom-bg shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 border-0 shadow">
                    <div class="row g-0 p-3 alig-item-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="../vendors/images/carousel/car-2.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="col-md-5 text-center px-lg-3 px-md-3 px-0">
                            <h5 class="mb-4 tex-center">Alfresco</h5>
                            <div class="features mb-3 text-center">
                                <h6 class="mb-1 text-col">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                    Air Conditioned<br>Videoke<br>Barbecue Grill<br>Food Warmer<br>Water Dispenser
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <div class="text-align-center">
                                <h6 class="card-title mb-4">$500 Perhour</h5>
                                    <a href="#" class="btn btn-sm w-100 mb-1 custom-bg shadow-none">Book Now</a>
                                    <a href="#" class="btn btn-sm w-100 mt-1 custom-bg shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 alig-item-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="../vendors/images/carousel/car-3.jpg" class="img-fluid rounded" alt="...">
                        </div>
                        <div class="col-md-5 text-center px-lg-3 px-md-3 px-0">
                            <h5 class="mb-4 tex-center">Gazebo</h5>
                            <div class="features mb-3 text-center">
                                <h6 class="mb-1 text-col">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                    Air Conditioned<br>Videoke<br>Barbecue Grill<br>Food Warmer<br>Water Dispenser
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="text-align-center">
                                <h6 class="card-title mb-4">$500 Perhour</h5>
                                    <a href="#" class="btn btn-sm w-100 mb-1 custom-bg shadow-none">Book Now</a>
                                    <a href="#" class="btn btn-sm w-100 mt-1 custom-bg shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
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