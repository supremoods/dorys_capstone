//Swiper slider
var swiper = new Swiper(".bg-slider-thumbs", {
  loop: true,
  spaceBetween: 0,
  slidesPerView: 0,
  autoplay: {
    delay: 5000,
  },
});

var swiper2 = new Swiper(".bg-slider", {
  loop: true,
  spaceBetween: 0,
  thumbs: {
      swiper: swiper,
  },
  autoplay: {
    delay: 5000,
  },
});

// auth form

const input_field = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector(".modal-auth");
const bullets = document.querySelectorAll(".bullets span");
const c_img = document.querySelectorAll(".image");

input_field.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

function moveSlider(){
  let index = this.dataset.value;

  let currentImage = document.querySelector(`.img-${index}`);
  c_img.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});


// navbar
try {
  const bookNow =  document.getElementById("book-now");
  const btn_login = document.querySelector(".login");
  const btn_register = document.querySelector(".register");
  const body = document.querySelector("body");
  const close_modal = document.querySelector(".close-modal");

  close_modal.addEventListener("click", () => {
      body.classList.remove("show");
      main.classList.remove("show");
      toggle_icon.classList.remove("fa-times");
  });

  btn_login.addEventListener("click", () => {
    body.classList.toggle("show");
    main.classList.toggle("show");
    main.classList.remove("sign-up-mode");
    header_bottom.classList.remove("active");
    inner_wrapper.classList.remove("active");
  });

  bookNow.addEventListener("click", () => {
    body.classList.toggle("show");
    main.classList.add("show","sign-up-mode");
    header_bottom.classList.remove("active");
    inner_wrapper.classList.remove("active");
  });

  btn_register.addEventListener("click", () => {
    body.classList.toggle("show");
    main.classList.add("show","sign-up-mode");
    header_bottom.classList.remove("active");
    inner_wrapper.classList.remove("active");
  });

} catch (error) {
  console.log(error);
}

const regModal = () =>{
  body.classList.toggle("show");
  main.classList.add("show","sign-up-mode");
  header_bottom.classList.remove("active");
  inner_wrapper.classList.remove("active");
}

const contactForm = document.getElementById("contact-form");

contactForm.addEventListener('submit', async (e) => {
  e.preventDefault();

  const formData = new FormData(contactForm);
  try {
        Swal.fire({
            title: 'Please wait...',
            html: 'We are processing your request',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
      const res = await fetch('/controller/client/ContactQueries.php', {
          method: 'POST',
          body: JSON.stringify(Object.fromEntries(formData)),
          headers: {
              'Content-Type': 'application/json'
          }
      })

      const data = await res.json();

      const success = "https://cdn-icons-png.flaticon.com/512/190/190411.png";
      const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";

      if (data.status === 'success') {
        //hide loader in sweetalert
        Swal.close();

          Swal.fire({
              title: "Success!",
              text: "Your message has been sent.",
              imageUrl: success,
              imageWidth: 150,
              imageHeight: 150,
              imageAlt: "Success",
          });

          contactForm.reset();
      } else {
          Swal.close();
          Swal.fire({
              title: "Failed!",
              text: "Your message has not been sent.",
              imageUrl: failed,
              imageWidth: 150,
              imageHeight: 150,
              imageAlt: "Failed",
          });

          contactForm.reset();
      }

  }
  catch (err) {
      console.log(err);
  }

});


const bookNow = (service_token) => {
  window.location.href = `/pages/book-now.php?service_token=${service_token}`;
}

const inputs = document.querySelectorAll(".input-c-items");

function focusFunc(){
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc(){
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});


// check inputs if empty
const email = document.querySelector(".email");
const phone = document.querySelector(".phone");


const checkInputs = () => {
  const emailValue = email.value.trim();
  const phoneValue = phone.value.trim();

  if (emailValue !== "" && phoneValue !== "") {
    let emailParent = email.parentNode;
    emailParent.classList.add("focus");
    let phoneParent = phone.parentNode;
    phoneParent.classList.add("focus");
  }

}

checkInputs();
