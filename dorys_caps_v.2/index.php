<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dory's Resort</title>

    <link rel="icon" href="vendors/images/logo/dorys_logo.png" type="image/png" sizes="16x16">
    
    <link rel="stylesheet" href="vendors/css/style.css">
    <link rel="stylesheet" href="vendors/css/modalAuth.css">
    <link rel="stylesheet" href="vendors/css/modalAlert.css">
    <link rel="stylesheet" href="vendors/css/media.css">

    <?php include 'links/header/header_links.php'; ?>

</head>

<body>
    
    <?php include 'components/header.php'; ?>

    <?php include 'components/index/slider.php'; ?>

    <?php include 'components/index/available_dates.php'; ?>

    <?php include 'components/index/announcement.php'; ?>

    <?php include 'components/index/ammenities.php'; ?>

    <?php include 'components/index/contacts.php'; ?>

    <?php include 'components/modals/modal_auth.php'; ?>

    <?php include 'components/footer.php'; ?>

    <?php include 'links/footer/footer_links.php'; ?>

    <script src="vendors/js/header.js"></script>
    <script src="vendors/js/script.js"></script>
    <script src="vendors/js/authentication.js"></script>
    
</body>

</html>