const loginForm = document.getElementById('login-form');

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const username = document.getElementById('login_field').value;
    const password = document.getElementById('login_password').value;

    Swal.fire({
        title: 'Please wait...',
        html: 'We are processing your request',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });

    fetch('/admin/controller/LoginAdmin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            username,
            password,
        }),
    })
    .then((res) => res.json())
    .then((data) => {
        if (data.status === 'success') {
            Swal.close();
            Swal.fire({
                title: 'Success',
                text: 'Login Successfully',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = '/admin/dashboard/';
            })
        } else {
            Swal.close();
            Swal.fire({
                title: 'Login Failed', 
                text: data.message,
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        }
    })
    .catch((err) => {
        console.log(err);
    });
});

