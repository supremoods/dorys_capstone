<?php
    // session_start();
    // if (isset($_SESSION['admin_id'])) {
    //     header("Location: /admin/dashboard/");
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login Page</title>
    <link rel="stylesheet" href="/vendors/css/admin/login.css">
    <link rel="stylesheet" href="/vendors/css/admin/global.css">
    <?php include_once('../templates/header_links.php'); ?>
</head>
<body class="bg-light">
     <div class="login-form text-center rounded bg-white shadow over-flow-none">
        <form method="POST" id="admin_auth">
            <h4 class="bg-darky text-white py-4 over-flow-hidden">Admin Panel</h4>
            <div id="message">
            </div>
            <div class="p-4">
                <div class="mb-3">
                    <input name="username" id="username" type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="password" id="password" type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
     </div>

     <?php include_once('../templates/footer_scripts.php'); ?>
     <script src="/vendors/js/admin/authentication/auth_login.js"></script>
</body>
</html>
