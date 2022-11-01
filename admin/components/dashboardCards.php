<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    $sqlAdminQuery = new SqlAdminQuery();

    $CountClients = $sqlAdminQuery->fetchCountClients();
    $CountRequest = $sqlAdminQuery->fetchCountPendingRequest();
    $CountMessages = $sqlAdminQuery->fetchCountMessages();
    $mode = $sqlAdminQuery->fetchMaintenanceMode();
?>
<div class="dashboard-cards">
    <div class="wrapper">
        <div class="wrapper-header-title">
            <h1>Dashboard</h1>
        </div>
        <hr>
        <main class="content-wrap">
            <div class="content">
                <section class="info-boxes">
                    <div class="info-box" onclick="window.location.href=`/admin/dashboard/clients.php`">
                        <div class="box-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <div class="box-content">
                            <span class="big"><?=$CountClients?></span>
                            Number of Clients
                        </div>
                    </div>

                    <div class="info-box" onclick="window.location.href=`/admin/dashboard/manage_reservation.php`">
                        <div class="box-icon">
                            <i class="fas fa-sticky-note"></i>
                        </div>
                        <div class="box-content">
                            <span class="big"><?=$CountRequest?></span>
                            Pending Request
                        </div>
                    </div>

                    <div class="info-box active"  onclick="window.location.href=`/admin/dashboard/messages.php`">
                        <div class="box-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div class="box-content">
                            <span class="big"><?=$CountMessages?></span>
                            Messages
                        </div>
                    </div>

                    <div class="info-box" onclick="window.location.href=`/admin/dashboard/settings.php`">
                        <div class="box-icon">
                            <i class="fas fa-cogs"></i>
                        </div>

                        <div class="box-content">
                            <span class="big">Settings</span>
                            Manage Settings
                        </div>
                    </div>
                </section>

                <section class="navigation-boxes">
                    <div class="navigation-box">
                        <div class="box-title">
                            <h2>Manage Clients</h2>
                        </div>
                        <div class="box-body">
                            Click here to go to the manage client page.
                        </div>
                        <div class="box-actions">
                            <a href="/admin/dashboard/clients.php">View</a>
                        </div>
                    </div>
                    <div class="navigation-box">
                        <div class="box-title">
                            <h2>Reservations</h2>
                        </div>
                        <div class="box-body">
                            View and check all the transactions for all Ammenities.
                        </div>
                        <div class="box-actions">
                            <a href="/admin/dashboard/manage_reservation.php">View</a>
                        </div>
                    </div>
                    <div class="navigation-box">
                        <div class="box-title">
                            <h2>Ammenities</h2>
                        </div>
                        <div class="box-body">
                            Add and Edit the details for Ammenities
                        </div>
                        <div class="box-actions">
                            <a href="/admin/dashboard/manage_ammenities.php">View</a>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>