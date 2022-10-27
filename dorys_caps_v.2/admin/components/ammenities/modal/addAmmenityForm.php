<div class="add-ammenity">
    <div class="wrapper">
        <div class="close-form">
            <button class="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="add-ammenity-container">
            <div class="add-ammenity-header">
                <h1>Add Ammenity</h1>
            </div>
            <div class="add-ammenity-form">
                <form class="add-ammenity-form-wrapper" id="ammenity-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="ammenity-name">Ammenity Name</label>
                        <input type="text" name="ammenity-name" id="ammenity-name" placeholder="Ammenity Name" required>
                    </div>
                    <div class="form-group ">
                        <label for="ammenity-images">Images</label>
                        <div class="image-upload-wrapper">
                            <div class="input-images"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ammenity-description">Description</label>
                        <textarea name="ammenity-description" id="ammenity-description" cols="30" rows="7" placeholder="Ammenity Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ammenity-rates">Set Rates</label>
                        <input type="number" name="ammenity-rates" id="ammenity-rates" placeholder="Ammenity Name" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                    </div>
                    <div class="form-group action-btn">
                        <button type="button" class="cancel-btn">Cancel</button>
                        <button type="submit" name="insert-ammenity" class="add-btn">Add Ammenity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>