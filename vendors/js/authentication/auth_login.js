$(document).ready(function() {
    $("#auth_login").on("submit", function(e) {
        e.preventDefault();
        var form_data = new FormData(this);
        if (!EmptyField($("#email").val(), $("#password").val())) {
            $.ajax({
                url: "controller/client_controller/LoginController.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data)    
                    if (data.status) {
                        window.location.href = "index.php";
                    } else {
                        alert("Login Failed, please check you email or password")
                    }
                }
            });
        } else {
            alert("please fill out the fields")
        }
    });
});

const EmptyField = (email, password) => {
    return email == "" && password == "" ? true : false;
}