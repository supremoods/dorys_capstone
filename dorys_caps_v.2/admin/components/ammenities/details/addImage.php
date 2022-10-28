<div class="modal-add-image">
    <div class="wrapper">
        <div class="form-container-upload">
            <form method="POST" id="upload-image" enctype="multipart/form-data">
                <input type="text" name="service-token" value="<?= $token ?>" hidden>
                <label for="ammenity-images">Upload Image</label>
                <div class="image-upload-wrapper">
                    <div class="add-images">

                    </div>
                </div>
                <div class="upload-button">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="submit" class="upload-btn">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>