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

    <link rel="icon" href="public/images/logo/dorys_logo.png" type="image/png" sizes="16x16">
    
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/modalAuth.css">
    <link rel="stylesheet" href="public/css/modalAlert.css">
    <link rel="stylesheet" href="public/css/media.css">
    <link rel="stylesheet" href="public/css/eventCalendar.css">

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

    <?php include 'components/eventCalendar.php'; ?>

    <?php include 'links/footer/footer_links.php'; ?>

    <script src="public/js/header.js"></script>
    <script src="public/js/script.js"></script>
    <script src="public/js/authentication.js"></script>

    <script src="public/js/eventCalendar.js"></script>

</body>

</html>