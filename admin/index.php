<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        header('location: /admin/dashboard/');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Dory's</title>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/links/header/header_links.php'; ?>
    <link rel="stylesheet" href="/admin/public/css/login.css">
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/components/login.php'; ?>
    
    <?php include  $_SERVER['DOCUMENT_ROOT'].'/admin/links/footer/footer_links.php'; ?>
    <script src="/admin/public/js/login.js"></script>
</body>

</html>