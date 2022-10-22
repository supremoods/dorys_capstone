const chevron = document.querySelector('.profile-settings__form .password-label .icon-toggle');
const collapsePass = document.getElementById("update-password")
chevron.addEventListener('click', () => {
    chevron.classList.toggle('active');
    collapsePass.classList.toggle('active');
}); 