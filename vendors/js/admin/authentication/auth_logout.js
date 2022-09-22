$('#logout').click(() => {
    console.log('logout');
    $.ajax({
        url: 'controller/admin_controller/LogoutController.php',
        type: 'post',
        success: (data) => {
            console.log(data);
        }
    });
});