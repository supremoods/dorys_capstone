const menu_toggle = document.querySelector(".menu-toggle");
const header_bottom = document.querySelector(".header-bottom");
const inner_wrapper = document.querySelector(".inner-wrapper");
const toggle_icon = document.querySelector(".menu-toggle i");

menu_toggle.addEventListener("click", () => {
    header_bottom.classList.toggle("active");
    inner_wrapper.classList.toggle("active");
    toggle_icon.classList.toggle("fa-times");
});

try {
    const avatarToggle = document.querySelector(".avatar-container");
    const avatarDropDown = document.querySelector(".avatar-dropdown");
    
    avatarToggle.addEventListener("click", () => {
      avatarDropDown.classList.toggle("active");
    });
  }catch(error){
  
  }