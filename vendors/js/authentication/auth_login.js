$(document).ready(() => {
    $("#auth_login").on("submit", (e) => {
        e.preventDefault();
        $("#message").load("controller/client_controller/LoginController.php", {
            email: $("#email").val(),
            password: $("#password").val()
        });
    });
});