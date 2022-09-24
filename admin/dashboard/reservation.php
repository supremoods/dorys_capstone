<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Reservations</title>
    <link rel="stylesheet" href="/vendors/css/admin/reservation.css">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header_links.php') ?>
    <link rel="stylesheet" href="/vendors/css/admin/global.css">
 
</head>

<body>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/templates/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Reservations</h3>
                <section class="ftco-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content w-100">
                                    <div class="calendar-container">
                                        <div class="calendar">
                                            <div class="year-header">
                                                <span class="left-button fa fa-chevron-left" id="prev"> </span>
                                                <span class="year" id="label"></span>
                                                <span class="right-button fa fa-chevron-right" id="next"> </span>
                                            </div>
                                            <table class="months-table w-100">
                                                <tbody>
                                                    <tr class="months-row">
                                                        <td class="month">Jan</td>
                                                        <td class="month">Feb</td>
                                                        <td class="month">Mar</td>
                                                        <td class="month">Apr</td>
                                                        <td class="month">May</td>
                                                        <td class="month">Jun</td>
                                                        <td class="month">Jul</td>
                                                        <td class="month">Aug</td>
                                                        <td class="month">Sep</td>
                                                        <td class="month">Oct</td>
                                                        <td class="month">Nov</td>
                                                        <td class="month">Dec</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="days-table w-100">
                                                <td class="day">Sun</td>
                                                <td class="day">Mon</td>
                                                <td class="day">Tue</td>
                                                <td class="day">Wed</td>
                                                <td class="day">Thu</td>
                                                <td class="day">Fri</td>
                                                <td class="day">Sat</td>
                                            </table>
                                            <div class="frame">
                                                <table class="dates-table w-100">
                                                    <tbody class="tbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button class="button" id="add-button">Add Event</button>
                                        </div>
                                    </div>
                                    <div class="events-container">
                                    </div>
                                    <div class="dialog" id="dialog">
                                        <h2 class="dialog-header"> Add New Event </h2>
                                        <form class="form" id="form">
                                            <div class="form-container" align="center">
                                                <label class="form-label" id="valueFromMyButton" for="name">Event name</label>
                                                <input class="input" type="text" id="name" maxlength="36">
                                                <label class="form-label" id="valueFromMyButton" for="count">Number of people to invite</label>
                                                <input class="input" type="number" id="count" min="0" max="1000000" maxlength="7">
                                                <input type="button" value="Cancel" class="button" id="cancel-button">
                                                <input type="button" value="OK" class="button button-white" id="ok-button">
                                            </div>
                                        </form>
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
    <script src="/vendors/js/admin/reservation.js"></script>
    <script src="/vendors/js/admin/authentication/auth_logout.js"></script>
</body>

</html>