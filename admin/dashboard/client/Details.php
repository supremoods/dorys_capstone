<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Client Details</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header_links.php') ?>
    <link rel="stylesheet" href="/vendors/css/admin/global.css">
</head>

<body>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/templates/header.php') ?>
    <div class="container-fluid" id="main-content">

        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Clients</h3>
                <?php
                include_once($_SERVER['DOCUMENT_ROOT'] . '/controller/admin_controller/FetchClient.php');
                $client_token = $_GET['client_token'];

                $fetch_client = new FetchClient();
                $row = $fetch_client->fetchRow($client_token);
                $logsHistory = $fetch_client->fetchRowLogs($client_token);
                ?>
                <section style="background-color: #eee;">
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="../../../vendors/images/clients/<?= $row['avatar'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <h5 class="my-3"><?= $row['fullname'] ?></h5>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php
                                            if ($row['status'] == 'active') {
                                            ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4 mb-lg-0">
                                    <h5 class="font-bold me-1 p-3">Log History</h5>
                                    <div class="table-responsive-lg w-100">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Login</th>
                                                    <th scope="col">Logout</th>
                                                </tr>
                                            </thead>
                                            <tbody class="load-log-history">
                                                <?php
                                                while ($logs = $logsHistory->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?= $logs['log_in_stamp'] ?></td>
                                                        <td><?= $logs['log_out_stamp'] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?= $row['fullname'] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?= $row['email'] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?= $row['number'] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?= $row['address'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-mb-4">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <h4 class="font-bold me-1">Reservation</h4>
                                                <div class="table-responsive-lg w-100">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Type of Services</th>
                                                                <th scope="col">Date and Time</th>
                                                                <th scope="col">Payment Type</th>
                                                                <th scope="col">Address</th>
                                                                <th scope="col">Settlement Fee</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="load-clients">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer_scripts.php') ?>
    <script src="/vendors/js/admin/authentication/auth_logout.js"></script>
</body>

</html>