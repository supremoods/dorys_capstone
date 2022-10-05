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
    <title>DORS - Reservation</title>
    <?php require('../templates/header_links.php'); ?>
    <link rel="stylesheet" href="../vendors/css/global.css">
    <link rel="stylesheet" href="../vendors/css/footer.css">
    <link rel="stylesheet" href="../vendors/css/reservation.css">
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
    <div class="container mb-5 w-100">
        <div class="my-5 px-2">
            <h1 class="h-font fw-bold text-center ">Reservation</h1>
            <div class="h-line"></div>
        </div>
        <?php
            $services = new SqlQuery();
            $fetchServiceDetails = $services->fetchServiceDetails($_GET['token']);
            $images = explode(',', $fetchServiceDetails['images']);

            $clientDetails = $services->fetchClientDetails($_SESSION['user_token']);
        ?>
        <div class="card mb-3" style="max-width: 100%">
            <div class="row g-0">
                <div class="col-md-5">
                    <h3><?=$fetchServiceDetails['name']?></h3>
                    <img src="../vendors/images/services/<?=$images[0]?>" class="img-fluid rounded-start" alt="">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <!-- Reservation Form -->
                        <form method="POST" id="reservation_form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?=$clientDetails['fullname']?>" placeholder="Enter your name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?=$clientDetails['email']?>" placeholder="Enter your email" disabled>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?=$clientDetails['number']?>" placeholder="Enter your phone number" disabled>
                            </div>
                            <div class="form-group">
                                <label for="settlement_fee">Settlement Fee</label>
                                <input type="text" class="form-control" id="settlement_fee" placeholder="Enter your settlement fee"  value="₱ <?=$fetchServiceDetails['price']?>" name="settlement_fee" disabled>
                            </div>
                            <hr class="my-4">
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control" name="payment_method" id="payment_method">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dateStart">Date Start</label>
                                        <input type="datetime-local" class="form-control" id="dateStart" name="dateStart">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dateEnd">Date End</label>
                                        <input type="datetime-local" class="form-control" name="dateEnd" id="dateEnd">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
                        </form>
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