<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

$fetchMaintenanceMode = new SqlClientQuery();

$maintenanceMode = $fetchMaintenanceMode->fetchMaintenance();

if ($maintenanceMode['mode'] != "Enabled") {
    header('Location: /');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dory's Resort</title>

    <link rel="icon" href="public/images/logo/dorys_logo.png" type="image/png" sizes="16x16">
    <style type="text/css">
        body {
            text-align: center;
            padding: 150px;
        }

        h1 {
            font-size: 40px;
        }

        body {
            font: 20px Helvetica, sans-serif;
            color: #333;
        }

        #article {
            display: block;
            text-align: left;
            width: 650px;
            margin: 0 auto;
        }

        a {
            color: #dc8100;
            text-decoration: none;
        }

        a:hover {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="article">
        <h1>Our site is getting a little tune up and some love.</h1>
        <div>
            <p>We apologize for the inconvenience, but we're performing some maintenance. You can still contact us at <a href="mailto:admin@codingislove.com">dorysresort@gmail.com</a>. We'll be back up soon!</p>
            <p>— Dory's Resort</p>
        </div>
    </div>
</body>

</html>