

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
    <title>Dory's Resort | Transaction List</title>
    <link rel="icon" href="/public/images/logo/dorys_logo.png" type="image/png" sizes="16x16">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/links/header/header_links.php'; ?>
    <link rel="stylesheet" href="/public/css/transactionList.css">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/header.php'; ?>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/transactionList.php'; ?>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/footer.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/links/footer/footer_links.php'; ?>
    <script src="/public/js/header.js"></script>
    <script src="/public/js/transactionList.js"></script>

</body>
</html>