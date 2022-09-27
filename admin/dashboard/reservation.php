    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Reservations</title>
        <link rel="stylesheet" href="/vendors/css/admin/global.css">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header_links.php') ?>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="/vendors/css/admin/reservation.css">
        <link rel="stylesheet" href="/vendors/fullcalendar/lib/main.min.css">


    </head>

    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/templates/header.php') ?>
        <div class="container-fluid" id="main-content">
            <div class="row">
                <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4">Reservations</h3>
                    <div class="row w-100 d-flex justify-content-center align-items-center">
                        <div class="col-md-9">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div class="modal-header rounded-0">
                        <h5 class="modal-title">Schedule Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body rounded-0">
                        <div class="container-fluid">
                            <dl>
                                <dt class="text-muted">Title</dt>
                                <dd id="title" class="fw-bold fs-4"></dd>
                                <dt class="text-muted">Description</dt>
                                <dd id="description" class=""></dd>
                                <dt class="text-muted">Start</dt>
                                <dd id="start" class=""></dd>
                                <dt class="text-muted">End</dt>
                                <dd id="end" class=""></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="modal-footer rounded-0">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                            <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer_scripts.php') ?>
        <script>  
            var scheds = $.parseJSON('<?= json_encode($sched_res) ?>') 
        </script>
        <script src="/vendors/fullcalendar/lib/main.min.js"></script>
        <script src="/vendors/js/admin/reservation.js"></script>
        <script src="/vendors/js/admin/authentication/auth_logout.js"></script>

    </body>

    </html>