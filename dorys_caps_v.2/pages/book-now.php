<?php
    session_start();
    if(!isset($_SESSION['session_token'])){
        header ('Location: /');
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dory's Resort | Reservation</title>
    <link rel="stylesheet" href="/vendors/css/book-now.css">

    <link rel="icon" href="/vendors/images/logo/dorys_logo.png" type="image/png" sizes="16x16">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/links/header/header_links.php'; ?>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/header.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/book-now.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/footer.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/links/footer/footer_links.php'; ?>
    <script src="/vendors/js/header.js"></script>
    <script src="/vendors/js/book-now.js"></script>
</body>
</html>