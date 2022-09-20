$('#logout').click(() => {
    $.ajax({
        url: 'controller/client_controller/LogoutController.php',
        type: 'post',
        success: (data) => {
            window.location.href = '/';
        },
        error: (request, status, error) => {
            console.log(request.responseText);
        } 
    });
});