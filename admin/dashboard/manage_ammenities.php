<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Manage Ammenities</title>
    <link rel="icon" href="/public/images/logo/dorys_logo.png" type="image/png" sizes="16x16">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/links/header/header_links.php'; ?>
    <link rel="stylesheet" href="/admin/public/css/manage_ammenities.css">
    <link rel="stylesheet" href="/admin/public/image_uploader/image-uploader.min.css">

</head>

<body>
    <?php include  $_SERVER['DOCUMENT_ROOT'].'/admin/components/sidebar.php'; ?>

    <?php include  $_SERVER['DOCUMENT_ROOT'].'/admin/components/ammenities/manage_ammenities.php'; ?>
    
    <?php include  $_SERVER['DOCUMENT_ROOT'].'/admin/components/ammenities/modal/addAmmenityForm.php'; ?>
    
    <?php include  $_SERVER['DOCUMENT_ROOT'].'/admin/links/footer/footer_links.php'; ?>

    <script src="/admin/public/image_uploader/image-uploader.min.js"></script>

    <script src="/admin/public/js/script.js"></script>
    <script src="/admin/public/js/add-ammenity-form.js"></script>
</body>

</html>