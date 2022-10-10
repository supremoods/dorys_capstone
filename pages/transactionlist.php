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
    <title>DORS - Transaction List</title>
    <?php require('../templates/header_links.php'); ?>
    <link rel="stylesheet" href="../vendors/css/global.css">
    <link rel="stylesheet" href="../vendors/css/footer.css">
    <link rel="stylesheet" href="../vendors/css/reservation.css">
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .item:hover {
            border-top-color: #EB6A00 !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('../templates/header.php');?>
    <div class="container mb-5 w-100">
        <div class="my-5 px-2">
            <h1 class="h-font fw-bold text-center">Transaction List</h1>
            <div class="h-line"></div>
            
            <!-- Create Table  -->
            <div class="table-responsive py-5">
                <table class="tb-transaction-list table table-striped table bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Reservation ID</th>
                            <th scope="col">Name of Service</th>
                            <th scope="col">Date and Time</th>
                            <th scope="col">Mode of Payment</th>
                            <th scope="col">Settlement Fee</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="transaction-list">
   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    include('../templates/footer.php');
    include('../modal/login.php');
    include('../modal/registration.php');
    include_once('../templates/footer_scripts.php');
    ?>
    <script src="../vendors/js/transactionlist.js"></script>
</body>

</html>