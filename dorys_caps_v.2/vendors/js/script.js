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


const inputs = document.querySelectorAll(".input");

const focusFunc = () => {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

const blurFunc = () =>{
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});

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


const btn_login = document.querySelector(".login");
const btn_register = document.querySelector(".register");
const body = document.querySelector("body");

const menu_toggle = document.querySelector(".menu-toggle");
const toggle_icon = document.querySelector(".menu-toggle i");
const header_bottom = document.querySelector(".header-bottom");
const inner_wrapper = document.querySelector(".inner-wrapper");

btn_login.addEventListener("click", () => {
  body.classList.toggle("show");
  main.classList.toggle("show");
  header_bottom.classList.toggle("active");
  inner_wrapper.classList.toggle("active");
});

btn_register.addEventListener("click", () => {
  body.classList.toggle("show");
  main.classList.toggle("show","sign-up-mode");
  header_bottom.classList.toggle("active");
  inner_wrapper.classList.toggle("active");
});

// esc key events

document.addEventListener("keydown", (e) => {
  if (e.key == "Escape") {
    body.classList.remove("show");
    main.classList.remove("show");
    toggle_icon.classList.toggle("fa-times");
  }
});

menu_toggle.addEventListener("click", () => {
  // alert("hello");
  header_bottom.classList.toggle("active");
  inner_wrapper.classList.toggle("active");
  toggle_icon.classList.toggle("fa-times");
  // document.querySelector(".nav").classList.toggle("active");
});




