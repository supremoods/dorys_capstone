<?php
    session_start();
    if(!isset($_SESSION['admin_id'])){
        header('location: /admin');
    }
?>

<aside class="sidebar">

        <div id="leftside-navigation" class="nano">
            <ul class="nano-content">
                <li>
                    <a href="/admin/"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);"><i class="fa fa-cogs"></i><span>Clients</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li>
                            <a href="/admin/dashboard/clients.php">Client List</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);"><i class="fa fa-table"></i><span>Reservations</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li>
                            <a href="/admin/dashboard/manage_reservation.php">Manage Reservation</a>
                        </li>

                        <li>
                            <a href="/admin/dashboard/calendar.php">Calendar</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);"><i class="fa fa-table"></i><span>Ammenities</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li>
                            <a href="/admin/dashboard/manage_ammenities.php">Manage Ammenities</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);"><i class="fa fa-table"></i><span>Messages</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li>
                            <a href="/admin/dashboard/messages.php">Manage Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);"><i class="fa fa fa-tasks"></i><span>Gcash</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li>
                            <a href="/admin/dashboard/manage_gcash_details.php">Manage Gcash Details</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu manage-settings">
                    <a href="javascript:void(0);"><i class="fa fa fa-tasks"></i><span>Settings</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li>
                            <a href="/admin/dashboard/settings.php">Manage Settings</a>
                        </li>
                    </ul>
                </li>
                <li class="sub-menu logout">
                    <a href="/admin/controller/LogoutAdmin.php"><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </aside>