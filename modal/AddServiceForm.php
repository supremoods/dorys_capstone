<div class="modal fade" id="addServicesForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Service</div>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="add-services" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="form">
                        <div class="row form-container">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service-image">Service
                                        Images</label>
                                    <div class="input-images"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service-title">Service Title</label>
                                    <input type="text" class="form-control" id="service-title" name="service-title" placeholder="Service Title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service-description">Service Description</label>
                                    <textarea class="form-control" id="service-description" name="service-description" rows="3" placeholder="Service Description" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service-features">Service Features</label>
                                    <!--- container with border --->
                                    <div class="container-fluid border p-2 feat-inputs">
                                        <input type="text" class="form-control " id="service-features" name="service-features" data-role="tagsinput" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service-price">Service Price</label>
                                    <input type="number" class="form-control" id="service-price" name="service-price" placeholder="Service Price" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn cancel-btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="add-services-btn-m">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>