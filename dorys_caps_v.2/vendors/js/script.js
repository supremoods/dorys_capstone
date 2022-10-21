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

//Navigation bar effects on scroll
window.addEventListener("scroll", () => {
  const header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 0);
});

// select all card
const images = [
  '/vendors/images/carousel/slide1.jpg',
  '/vendors/images/carousel/slide2.jpg',
  '/vendors/images/carousel/slide3.jpg'
]

const cards = document.querySelectorAll(".card");

// add event listener to each card with image
cards.forEach((card, index) => {
  card.style.setProperty('--card-image',`url(${images[index]})`);
});

// contact components

const inputs = document.querySelectorAll(".input-c-items");

function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
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

  btn_register.addEventListener("click", () => {
    body.classList.toggle("show");
    main.classList.add("show","sign-up-mode");
    header_bottom.classList.remove("active");
    inner_wrapper.classList.remove("active");
  });



} catch (error) {

}

// header-account dropdown






