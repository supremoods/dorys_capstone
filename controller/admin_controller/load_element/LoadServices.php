<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/admin_model/SqlQuery.php');

class LoadServices extends SqlQuery
{
    public function fetchRows()
    {
        $result = $this->fetchServices();

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $images = explode(",", $row['images']);
                $features = explode(",", $row['features']);
?>
                <div class="row g-2 shadow-sm m-2 bg-white rounded ">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="gallery-slider">
                                <div class="img-item">
                                    <img src=" ../../vendors/images/services/<?= trim($images[0]) ?>" alt="avatar" class="img-item rounded img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="d-flex flex-column card-body h-100 position-relative">
                            <div class="d-flex mb-1">
                                <div class="py-1">
                                    <h4 class="card-title font-weight-bold ft-title">₱<?= $row['price'] ?></h4>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="pb-2">
                                    <h3 class="card-title font-weight-bold"><?= $row['name'] ?></h3>
                                </div>
                                <div>
                                    <p class="card-text"><?= $row['description'] ?></p>
                                </div>
                            </div>
                            <div class="mb-3 flex-grow-1">
                                <div class="py-1">
                                    <h5 class="card-title font-weight-bold ft-title">Features</h5>
                                </div>
                                <div class="d-flex ft-lists flex-wrap">
                                    <?php foreach ($features as $feature) { ?>
                                        <p class="rounded-pill border border-warning p-2"><?= $feature ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="py-1 actions-btn position-absolute top-0 end-0 d-flex flex-column">
                                <button class="btn edit-show-btn" data-bs-toggle="modal" data-bs-target="#EditServicesForm" data-token="<?= $row['services_token'] ?>" onclick="loadServiceDetails(this.dataset.token)">
                                    <span class="material-symbols-outlined">edit_note</span>
                                </button>
                                <button class="btn del-btn" data-token="<?= $row['services_token'] ?>" onclick="deleteService(this.dataset.token)">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>

            <div class="row g-2 shadow-sm m-2 bg-white rounded ">
                <div class="col-lg-12">
                    <div class="d-flex flex-column card-body h-100 position-relative">
                        <div class="d-flex mb-1">
                            <div class="py-1">
                                <h4 class="card-title font-weight-bold ft-title">No Services Found</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}

$loadServices = new LoadServices();
$services = $loadServices->fetchRows();

?>