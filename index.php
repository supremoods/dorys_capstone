<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DORS | Home</title>
        <?php require('templates/header_links.php');?>
        <link rel="stylesheet" href="vendors/css/global.css">
        <link rel="stylesheet" href="vendors/css/footer.css">
    </head>
    <body>
        <div class="bg-light">
            <?php require('templates/header.php');?>
            <!-- Carousel -->
            <div class="container-fluid px-lg-4 mt">
                <!-- Swiper -->
                <div class="swiper swiper-image">
                <div class="swiper-wrapper position-relative">
                    <div class="swiper-slide">
                    <img src="vendors/images/carousel/car-1.jpg" class="w-100 d-block ">
                    </div>
                    <div class="swiper-slide">
                    <img src="vendors/images/carousel/car-2.jpg" class="w-100 d-block ">
                    </div>
                    <div class="swiper-slide">
                    <img src="vendors/images/carousel/car-3.jpg" class="w-100 d-block ">
                    </div>
                    <div class="swiper-slide">
                    <img src="vendors/images/carousel/car-4.jpg" class="w-100 d-block ">
                    </div>
                    <div class="swiper-slide">
                    <img src="vendors/images/carousel/car-5.jpg" class="w-100 d-block ">  
                    </div>
                </div>
                </div>
            </div>
            <!-- Service Availability -->
            <div class="container availability-form">
                <div class="row">
                    <div class="col-lg-12 bg-white shadow p-4 rounded ">
                    <h1 class="mb-4 avail-tilt mb-3">Check Available Services</h1>
                    <form action="" >
                        <div class="row align-items-end justify-content-center">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label-1" style="font-weight:500;">Available Services</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label-1" style="font-weight: 500;">Not Available</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Check</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- Instruction -->
            <!-- Top offers -->

            <h1 class="mt-5 pt-4 mb-5 text-center fw-bold h-font fs-32">Top Offers</h1>
            <div class="container ">
            <div class="row">
                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow " style="max-width: 350px; margin: auto;">
                    <img src="vendors/images/carousel/car-2.jpg" class="card-img-top">
                        <div class="card-body">
                        <h5 class="card-title text-center mb-4 h-font mt-2">VIP</h5>
                            <div class="features mb-2 text-center">
                            <h6 class="mb-1 ">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                Air Conditioned<br>Videoke<br>Barbecue Grill<br>Food Warmer<br>Water Dispenser
                                </span>
                            </div>
                            <div class="rating mb-4">
                            <h6 class="mb-1 fw-bold">Rating</h6>
                            <span class="badge rounded-pill">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning" ></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                            </div>
                            <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm custom-bg shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-4 col-md-6 my-3 ">
                    <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                        <img src="vendors/images/carousel/car-2.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4 h-font mt-2">VIP</h5>
                            <div class="features mb-2 text-center">
                                <h6 class="mb-1 ">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                Air Conditioned<br>Videoke<br>Barbecue Grill<br>Food Warmer<br>Water Dispenser
                                </span>
                            </div>
                            <div class="rating mb-4">
                                <h6 class="mb-1 fw-bold">Rating</h6>
                                <span class="badge rounded-pill">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning" ></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                            </div>
                            <div class="d-flex justify-content-evenly mb-2">
                                <a href="#" class="btn btn-sm custom-bg shadow-none">Book Now</a>
                                <a href="#" class="btn btn-sm custom-bg shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-3">
                    <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                        <img src="vendors/images/carousel/car-2.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4 h-font mt-2">VIP</h5>
                            <div class="features mb-2 text-center">
                                <h6 class="mb-1 ">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 ">
                                Air Conditioned<br>Videoke<br>Barbecue Grill<br>Food Warmer<br>Water Dispenser
                                </span>
                            </div>
                            <div class="rating mb-4">
                            <h6 class="mb-1 fw-bold">Rating</h6>
                                <span class="badge rounded-pill">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning" ></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                            </div>
                            <div class="d-flex justify-content-evenly mb-2">
                                <a href="#" class="btn btn-sm custom-bg shadow-none">Book Now</a>
                                <a href="#" class="btn btn-sm custom-bg shadow-none">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- Announcement -->
            <div class="ann-div">
                <div class="announcement">
                    <h1>Announcement</h1>
                    <div class="">
                        <p class="announcement-message">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
            </div>
            <!-- Events -->
            <h1 class="mt-5 pt-4 mb-5 text-center fw-bold h-font fs-32">Events</h1>
            <div class="container-fluid px-lg-4 mt">
                <div class="swiper myServices-Swiper">
                    <div class="swiper-wrapper position-relative text-center">
                        <div class="swiper-slide ">
                            <h2 >Parties</h2>
                            <img src="vendors/images/carousel/car-1.jpg" class="w-100 d-block ">
                        </div>
                        <div class="swiper-slide">
                            <h2 >Events</h2>
                            <img src="vendors/images/carousel/car-2.jpg" class="w-100 d-block ">
                        </div>
                        <div class="swiper-slide">
                            <h2 >Relax</h2>
                            <img src="vendors/images/carousel/car-3.jpg" class="w-100 d-block ">
                        </div>
                        <div class="swiper-slide">
                            <h2 >Chill</h2>
                            <img src="vendors/images/carousel/car-4.jpg" class="w-100 d-block ">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Us -->

            <h1 id="contactUs"class="mt-5 pt-4 mb-5 text-center fw-bold h-font fs-32">Contact Us</h1>
            <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                    <iframe class="w-100 rounded" height="320" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.117569972251!2d120.95702681375505!3d14.649266879812126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5b6ba02957f%3A0x91b89c7caf3fb618!2s20%20Hasa-Hasa!5e0!3m2!1sfil!2sph!4v1659342269598!5m2!1sfil!2sph" loading="lazy"></iframe>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="bg-white p-4 rounded mb-4">
                        <h5 class="fw-200">Contact Us</h5>
                        <span class="badge bg-light text-hov fs-6 p-2">
                        <a href="+9297575119" class="d-inline-block mb-2 text-decoration-none text-hov">
                        <i class="bi bi-telephone-fill"></i> +9297575119 </span></a>
                    </div>
                    <div class="bg-white p-4 rounded mb-4">
                        <h5 class="fw-200">Follow Us</h5>
                        <a href="#" class="d-inline-block text-hov">
                            <span class="badge bg-light text-hov fs-6 p-2">
                                <i class="bi bi-facebook"></i>Facebook
                            </span>
                        </a>
                        <br>
                        <a href="#" class="d-inline-block mb-3 text-hov">
                            <span class="badge bg-light text-hov fs-6 p-2">
                            <i class="bi bi-envelope-fill"></i> Email
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            <?php
                include('templates/footer.php');
                include('modal/login.php');
                include('modal/registration.php');
            ?>
        </div>

        <!-- Bootstrap/SwiperJs -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script src="vendors/js/authentication/auth_reg.js"></script>
        <script src="vendors/js/authentication/auth_login.js"></script>
        <script src="vendors/js/authentication/auth_logout.js"></script>
        <script src="vendors/js/main.js"></script>
        <script>
            var swiper = new Swiper(".swiper-image", {
                spaceBetween: 30,
                effect: "fade",
                loop: true, 
                autoplay:{
                delay:3500,
                disableOnInteraction: false,
                }
            });
        </script>
        <script>
            var swiper = new Swiper(".myServices-Swiper", {
                watchSlidesProgress: true,
                slidesPerView: 3,
            });
        </script>

    </body>
</html>