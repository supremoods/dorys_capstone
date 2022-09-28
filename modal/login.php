<!-- Login button/ form -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content d-flex align-item-center">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
        <i class="bi bi-person-circle fs-3 me-2"></i> User Login</h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="auth_login">
        <div id="message">
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-control shadow-none required">
          </div>
          <div class="mb-4">
          <label class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control shadow-none required">
          </div>
          <div class = "d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">Login</button>
            <a href="javascript:  void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

 