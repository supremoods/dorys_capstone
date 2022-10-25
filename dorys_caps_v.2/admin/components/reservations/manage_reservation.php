<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/admin/model/admin/SqlAdminQuery.php');

    $ammenities =  new SqlAdminQuery();
    
    $res = $ammenities->fetchAmmenities();


?>
<div class="manage-reservation">
    <div class="wrapper">
        <main class="main">
            <div class="responsive-wrapper">
                <div class="main-header">
                    <h1>Manage Reservation</h1>
                </div>
                <div class="content">
                    <div class="content-main">
                        <div class="card-grid">
                            <?php
                                if($res->num_rows>0){
                                    while($row = $res->fetch_assoc()){
                                        $images = explode(",", $row['images']);
                                        $features = explode(",", $row['features']);
                                        $req = $ammenities->fetchRequest($row['services_token']);
                            ?>
                            <article class="card">
                                <div class="card-header">
                                    <img src="/vendors/images/services/<?=$images[0]?>"  />
                                    <h1><?=$row['name']?></h1>

                                    <?php if(!empty($req)){ ?>
                                    <div class="notif-icon">
                                        <i class="fas fa-bell"></i>
                                        <p><?=$req?></p>
                                    </div>
                                    <?php } ?>
                                    
                                </div>
                                <div class="card-body">
                                    
                                    <p><?=$row['description']?></p>
                                </div>
                                <div class="card-footer">
                                    <a href="/admin/dashboard/ammenities_transaction.php?ammenity=<?=$row['name']?>&service_token=<?=$row['services_token']?>" data-service_token="">View Transactions</a>
                                </div>
                            </article>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>