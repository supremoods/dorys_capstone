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