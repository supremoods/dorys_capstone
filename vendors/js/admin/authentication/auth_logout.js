$('#logout').click(() => {
    console.log('logout');
    $.ajax({
        url: '../../controller/admin_controller/LogoutController.php',
        type: 'post',
        dataType: "JSON",
        success: (data) => {
            console.log(data);
            if (data.status) {
                window.location.href = './admin';
            }
        }
    });
});