<div class="modal-auth">
    <div class="box">
        <div class="close-modal">
            <i class="fas fa-times"></i>
        </div>
        <div class="inner-box">
            <div class="forms-wrap">
                <form method="post" autocomplete="off" class="sign-in-form" id="sign-in-form">
                    <div class="logo">
                        <img src="public/images/logo/dorys_logo.png" alt="easyclass" />
                    </div>

                    <div class="heading">
                        <h2>Welcome Back</h2>
                        <h6>Not registred yet? <span class="toggle">Sign up</span></h6>
                    </div>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="email" name="email" minlength="4" class="input-field" autocomplete="off" required />
                            <label>Email</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required />
                            <label>Password</label>
                        </div>
                        <input type="submit" value="Sign In" class="sign-btn" />
                        <p class="text">
                            Forgotten your password or you login datails?
                            <a href="#">Get help</a> signing in
                        </p>
                    </div>
                </form>

                <form method="post" autocomplete="off" class="sign-up-form" id="sign-up-form">
                    <div class="logo">
                        <img src="public/images/logo/dorys_logo.png" alt="easyclass" />
                    </div>

                    <div class="heading">
                        <h2>Get Started</h2>
                        <h6>Already have an account? <span class="toggle">Sign in</span></h6>
                    </div>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" minlength="4" name="name" class="input-field" autocomplete="off" required />
                            <label>Name</label>
                        </div>

                        <div class="input-wrap">
                            <input type="email" class="input-field" name="email" autocomplete="off" required />
                            <label>Email</label>
                        </div>
             
                        <div class="input-wrap">
                            <input type="password" minlength="4" name="password" class="input-field" autocomplete="off" required />
                            <label>Password</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" minlength="4" name="confirm-password" class="input-field" autocomplete="off" required />
                            <label>Confirm Password</label>
                        </div>

                        <input type="submit" value="Sign Up" class="sign-btn" />

                        <p class="text">
                            By signing up, I agree to the
                            <a href="#">Terms of Services</a> and
                            <a href="#">Privacy Policy</a>
                        </p>
                    </div>
                </form>
            </div>

            <div class="carousel">
                <div class="images-wrapper">
                    <img src="public/images/carousel/slide1.jpg" class="image img-1 show" alt="" />
                    <img src="public/images/carousel/slide2.jpg" class="image img-2" alt="" />
                    <img src="public/images/carousel/slide3.jpg" class="image img-3" alt="" />
                </div>

                <div class="text-slider">
                    <div class="text-wrap">
                        <div class="text-group">
                            <h2>Lorem ipsum dolor </h2>
                            <h2>Lorem ipsum dolor sit</h2>
                            <h2>Lorem ipsum dolor sit amet </h2>
                        </div>
                    </div>

                    <div class="bullets">
                        <span class="active" data-value="1"></span>
                        <span data-value="2"></span>
                        <span data-value="3"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'components/modals/modalAlert.php'; ?>