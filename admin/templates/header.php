<div class="container-fluid bg-darky text-white p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 ">DORS WEBSITE</h3>
    <button id="logout" class="btn custom-bg-2 btn-sm">LOG OUT</button>
</div>

<div class="col-lg-2 bg-darky border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-white">ADMIN PANEL</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminfilterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="adminfilterDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/admin/dashboard/clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/admin/dashboard/reservation.php">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/admin/dashboard/settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>