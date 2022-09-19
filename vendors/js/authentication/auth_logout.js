$('#logout').click(function () {
    $.ajax({
        url: 'controller/client_controller/LogoutController.php',
        type: 'post',
        success: function (data) {
            window.location.href = '/';
        },
        error: function (request, status, error) {
            console.log(request.responseText);
        } 
    });
});