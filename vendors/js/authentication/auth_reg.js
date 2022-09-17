$(document).ready(function() {
    $("#auth_reg").on("submit", function(e) {
        e.preventDefault();
        var form_data = new FormData(this);
        if (ValidatePassword($("#pass").val(), $("#confirm-pass").val())) {
            $.ajax({
                url: "controller/client_controller/RegistrationController.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data) {
                        window.location.href = "pages/test.php";
                    } else {
                        alert("please fill out the fields")
                    }
                }
            });
        } else {
            alert("Password doesn't match")
        }
    });
});

const ValidatePassword = (password, confirmPassword) => {
    return password == confirmPassword ? true : false;
}