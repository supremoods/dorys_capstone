var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    autoplay: {
        delay: 5000,
    },
    mousewheel: {
        invert: false,
    },
    autoHeight: true,
    pagination: {
        el: '.blog-slider__pagination',
        clickable: true,
    }
});

const checkIfAccountIsVerified = async () => {
    const userToken = document.getElementById("user-token").value;
  
    if(userToken !== ""){
    const res = await fetch('/controller/client/CheckIfAccountIsVerified.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          'user_token': userToken
        })
    })
  
    const data = await res.json();
  
    if (data.status === 'not_verified') {
      // put link to verify account
      Swal.fire({
        title: 'Please verify your account',
        icon: 'warning',
        html: `
          <div class="alert-verified">
            <p>You need to complete your profile details before you can book a service</p>
            <p>Click <a class="link_profile" href="/pages/profile.php">here</a> to complete your profile</p>
          </div>
        `,
        allowOutsideClick: false,
        showConfirmButton: true,
        confirmButtonText: 'Ok',
        onBeforeOpen: () => {
            Swal.showLoading()
        },
      });
    }
  }
  }
  
  checkIfAccountIsVerified();