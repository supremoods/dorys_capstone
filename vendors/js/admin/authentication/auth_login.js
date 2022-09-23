$(document).ready(() => {
    $("#admin_auth").on("submit", (e) => {
        e.preventDefault()
        $("#message").load("./controller/admin_controller/LoginController.php", {
            username: $("#username").val(),
            password: $("#password").val()
        });
    });
});