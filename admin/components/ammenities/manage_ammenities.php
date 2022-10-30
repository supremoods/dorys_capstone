<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');
    $ammenities =  new SqlAdminQuery();
    $res = $ammenities->fetchAmmenities();
?>
<div class="manage-ammenities">
    <div class="wrapper">
        <main class="main">
            <div class="responsive-wrapper">
                <div class="main-header">
                    <div class="title-header">
                        <h1>Manage Ammenities</h1>
                    </div>
                    <div class="add-ammenity-header">
                        <button class="add-btn" id="add-ammenity-btn"><i class="fas fa-plus"></i> Add Ammenity</button>
                    </div>
                </div>
                <div class="content">
                    <div class="content-main">
                        <div class="card-grid">
                           
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>