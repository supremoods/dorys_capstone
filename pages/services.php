<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/admin_model/SqlQuery.php');
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
            <div class="col-lg-9 col-md-12 px-4">
                <?php
                $services = new SqlQuery();

                $result = $services->fetchServices();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $images = explode(',', $row['images']);
                        $features = explode(',', $row['features']);
                ?>
                        <div class="card mb-2 border-0 shadow">
                            <div class="row g-0 p-3 alig-item-center">
                                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                    <img src="../vendors/images/services/<?=$images[0]?>" class="img-fluid rounded" alt="...">
                                </div>
                                <div class="col-md-5 text-center px-lg-3 px-md-3 px-0">
                                    <h5 class="mb-4 tex-center"><?=$row['name']?></h5>
                                    <div class="features mb-3 text-center">
                                        <h6 class="mb-1 text-col">Features</h6>
                                        <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                            <?php
                                                foreach ($features as $feature) {
                                            ?>
                                            <p><?=$feature?></p>
                                            <?php
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="text-align-center">
                                        <h6 class="card-title mb-4"><?=$row['price']?> Perhour</h5>
                                            <a href="/pages/reservation.php?token=<?=$row['services_token']?>" class="btn btn-sm w-100 mb-1 custom-bg shadow-none">Book Now</a>
                                            <a href="#" class="btn btn-sm w-100 mt-1 custom-bg shadow-none">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }else{
                ?>
                    <!-- empty services -->

                    <div class="card mb-2 border-0 shadow">
                        <h3 class="text-center">No Services Available</h3>
                    </div>

                <?php
                    }
                ?>
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