<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/client/SqlClientQuery.php');

$fetchMaintenanceMode = new SqlClientQuery();

$maintenanceMode = $fetchMaintenanceMode->fetchMaintenance();

if ($maintenanceMode['mode'] == "Enabled") {
    header('Location: /maintenance');
    exit();
}
$fetchClientDetails = new SqlClientQuery();

?>
<header class="site-header">
   <div class="header-top">
      <div class="wrapper">
         <div class="site-branding">
            <a href="" class="logo-link">
               <img src="/public/images/logo/dorys_logo.png" alt="logo" class="logo">
            </a>
         </div>
         <div class="header-additional-info">
            <div class="header-additional-info-block">
               <i class="fa-solid fa-mobile"></i>
               <div class="block-content">
                  <span class="title">Contact phone:</span>
                  <span class="value">+63 933-814-1748</span>
               </div>
            </div>
            <div class="header-additional-info-block">
               <i class="fa-solid fa-mobile"></i>
               <div class="block-content">
                  <span class="title">Contact telephone:</span>
                  <span class="value">+63 933-814-1748</span>
               </div>
            </div>
            <div class="header-additional-info-block">
               <i class="fa-solid fa-envelope"></i>
               <div class="block-content">
                  <span class="title">Email:</span>
                  <span class="value">+63 933-814-1748</span>
               </div>
            </div>
            <?php
            
                if (isset($_SESSION['session_token'])) {
                  $clientDetails = $fetchClientDetails->fetchClientDetails($_SESSION['user_token']);
                     
                  if(empty($clientDetails['number']) && empty($clientDetails['address'])){
                     $notVerified = true;
                  }else{
                     $notVerified = false;
                  }
            ?>
            <a href="<?=$notVerified?"javascript:checkIfAccountIsVerified()":"/pages/ammenities.php"?>" class="button-book-now">Book now</a>
            <?php
                } else {
            ?>
            <a href="javascript:void(0);" class="button-book-now" id="book-now">Book now</a>
            <?php
                }
            ?>
         </div>
      </div>
   </div>
   <input type="text" value="<?=$clientDetails['user_token']?>" id="user-token" hidden/>

   <div class="header-bottom">
      <div class="wrapper">
         <div class="inner-wrapper">
            <!-- menu icon -->
            <nav class="main-navigation">
               <div class="main-navigation-container">
                  <div id="primary-nav" class="menu nav-menu">
                     <div class="menu-item">
                        <a href="/">Home</a>
                     </div>
                     <div class="menu-item">
                        <a href="#ammenities">Amenities</a>
                        <div class="dropdown-items">
                           <div class="item">
                              <a href="/pages/ammenities.php">Offers</a>
                           </div>

                        </div>
                     </div>
                     <div class="menu-item">
                        <a href="#contacts">Contact</a>
                     </div>
                  </div>
               </div>
            </nav>
            <div class="header-account">
               <?php
                    if (!isset($_SESSION['session_token'])) {
                    ?>
               <div class="btn-item login">
                  <span class="button-login">Login</span>
               </div>
               <div class="btn-item register">
                  <span class="button-register">Register</span>
               </div>
               <?php
                    } else {
                        $fetchClient = new SqlClientQuery();
                        $client = $fetchClient->fetchClientDetails($_SESSION['user_token']);
                    ?>
               <div class="avatar">
                  <div class="avatar-container">
                     <img
                        src="/public/images/client/<?= is_null($client['avatar']) ? "avatar.png" : $client['avatar'] ?>"
                        alt="avatar" class="avatar">
                  </div>
                  <div class="avatar-dropdown">
                     <div class="avatar-dropdown-item">
                        <p><?=$client['fullname']?></p>
                     </div>
                     <hr>
                     <div class="avatar-dropdown-item links">
                        <a href="/pages/profile.php">Profile</a>
                     </div>
                     <div class="avatar-dropdown-item links">
                        <a href="/pages/transactionList.php">Transaction List</a>
                     </div>
                     <div class="avatar-dropdown-item links">
                        <a href="/controller/client/LogoutController.php">Logout</a>
                     </div>
                  </div>
               </div>
               <?php
                    }
                    ?>
            </div>
         </div>
         <div class="menu-btn">
            <div class="menu-toggle">
               <i class="fa-solid fa-bars"></i>
            </div>
         </div>
      </div>
   </div>
</header>