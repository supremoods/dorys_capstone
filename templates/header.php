<nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <!-- <div>
      <img src="/images/carousel/DORS-logo.png">
    </div> -->
    <a class="navbar-brand me-5 fw-bold fs-3 h-font " href="index.php">DORS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="/pages/Features.php">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="/pages/services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="/pages/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="/pages/contact.php">Contact</a>
        </li>
      </ul>

      <?php
        if(!isset($_SESSION['session_token'])){
      ?>
      <div class="nav-flex">
        <button type="button" class="btn shadow-none me-lg-3 me-2 custom-bg" data-bs-toggle="modal" data-bs-target="#loginModal">
        Login
        </button>
        <button type="button" class="btn shadow-none custom-bg-2" data-bs-toggle="modal" data-bs-target="#registerModal">
        Register
        </button>
      </div>
      <?php
        }else{
      ?>
      <div class="nav-flex">
        <button type="button" class="btn shadow-none me-lg-3 me-2 custom-bg" id="logout">
        Logout
        </button>
      </div>
      <?php
        }
      ?>
    </div>
  </div>
</nav>




