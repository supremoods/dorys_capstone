<!-- Registration button/ form -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content d-flex align-item-center">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
            <i class="bi bi-person-plus-fill"></i> User Registration</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" id="auth_reg" enctype="multipart/form-data">
            <div class="modal-body">
                    <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
                    Note: Your details must match with your ID</span>
                    <div class="container-form">
                        <div class="row">
                        <div class="col-md-6 mb-3 ps-0 ">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3 p-0 ps-0">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3 ps-0">
                            <label for="email_add" class="form-label">Email address</label>
                            <input type="email" name="email_add" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3 p-0 ps-0">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input type="number" name="mobile_number" class="form-control shadow-none">
                        </div>
                        <div class="col-md-12 p-0 mb-3 ps-0" >
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control shadow-none" rows="1"></textarea>
                        </div>
                        <div class="col-md-6 mb-3 ps-0">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" id="pass" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 mb-3 p-0 ps-0">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input name="confirm_password" id="confirm-pass" type="password" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 ps-0 p-0 mb-3">
                            <label for="avatar" class="form-label">Picture</label>
                            <input name="avatar" type="file" class="form-control shadow-none">
                        </div>
                    </div>
            </div>
            <div class="text-center my-1">
                <button type="submit" class="btn btn-dark shadow-none">Register</button>
            </div>
        </form>
    </div>
  </div>
</div>

