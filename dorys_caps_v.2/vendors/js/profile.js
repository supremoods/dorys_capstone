const chevron = document.querySelector('.profile-settings__form .password-label .icon-toggle');
const collapsePass = document.getElementById("update-password")
chevron.addEventListener('click', () => {
    chevron.classList.toggle('active');
    collapsePass.classList.toggle('active');
});

const editProfForm = document.getElementById('edit-profile-form');
const toggleEdit = document.getElementById('toggle-edit');
const editSubmit = document.getElementById('profile-settings__form-submit');
const elements = editProfForm;
const modalAlert = document.getElementById('alert-message');
toggleEdit.addEventListener('change', () => {

    for (let i = 0; i < elements.length; i++) {
        elements[i].disabled = !elements[i].disabled;
    }

});

editProfForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(editProfForm);

    console.log(Object.fromEntries(formData));
    try {
        const res = await fetch('/controller/client/EditProfile.php', {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData)),
            headers: {
                'Content-Type': 'application/json'
            }
        })

        const data = await res.json();

        const success = "https://cdn-icons-png.flaticon.com/512/190/190411.png";
        const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";

        if (data.status === 'success') {
            Swal.fire({
                title: "Success!",
                text: "Your message has been sent.",
                imageUrl: success,
                imageWidth: 150,
                imageHeight: 150,
                imageAlt: "Success",
            });
            toggleEdit.click();
        } else {
            Swal.fire({
                title: "Failed!",
                text: "Your message has not been sent.",
                imageUrl: failed,
                imageWidth: 150,
                imageHeight: 150,
                imageAlt: "Failed",
            });
            toggleEdit.click();
        }

    }
    catch (err) {
        console.log(err);
    }
});



const btnUpload = document.getElementById('btn-update');
const updateAvatar = document.getElementById('update-avatar');
const cardHeader = document.querySelector('.card-header');

const formAvatar = document.getElementById('form-avatar-upload');
const submitAvatar = document.getElementById('submit-avatar');

btnUpload.addEventListener('click', () => {
    updateAvatar.click();
});


updateAvatar.addEventListener('change', async () => {
    if (updateAvatar.files && updateAvatar.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            cardHeader.style.backgroundImage = `url(${e.target.result})`;
        };

        reader.readAsDataURL(updateAvatar.files[0]);
    }
    submitAvatar.click();
});


formAvatar.addEventListener('submit', async (e) => {

    e.preventDefault();
    const formData = new FormData(formAvatar);

    console.log(Object.fromEntries(formData));
    try {


        const success = "https://cdn-icons-png.flaticon.com/512/190/190411.png";
        const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";


        fetch("/controller/client/UpdateAvatar.php", {
            method: "POST",
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (responseData) {
            if (responseData.status === 'success') {
                Swal.fire({
                    title: "Success!",
                    text: "Your message has been sent.",
                    imageUrl: success,
                    imageWidth: 150,
                    imageHeight: 150,
                    imageAlt: "Success",
                });
            } else {
                Swal.fire({
                    title: "Failed!",
                    text: "Your message has not been sent.",
                    imageUrl: failed,
                    imageWidth: 150,
                    imageHeight: 150,
                    imageAlt: "Failed",
                });
            }
        });


    }
    catch (err) {
        console.log(err);
    }
});


const alertMessage = (message, status, img) => {
    return `
    <button class="close" onclick="closeAlert()">✖</button>
    <img src="${img}" alt="cookies-img" />
  
    <p>${message}</p>
    <button class="accept ${status}" onclick="closeAlert()">Continue</button>
    `
}

const closeAlert = () => {
    modalAlert.innerHTML = "";
    modalAlert.classList.remove('active');
}


const updatePasswordForm = document.getElementById('update-password');


updatePasswordForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(updatePasswordForm);

    console.log(Object.fromEntries(formData));
    try {
        const success = "https://cdn-icons-png.flaticon.com/512/190/190411.png";
        const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";

        fetch("/controller/client/UpdatePassword.php", {
            method: "POST",
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (responseData) {
            if (responseData.status === 'success') {
                Swal.fire({
                    title: "Success!",
                    text: "Your message has been sent.",
                    imageUrl: success,
                    imageWidth: 150,
                    imageHeight: 150,
                    imageAlt: "Success",
                });

                formResetPassword();

            } else {
                Swal.fire({
                    title: "Failed!",
                    text: "Your message has not been sent.",
                    imageUrl: failed,
                    imageWidth: 150,
                    imageHeight: 150,
                    imageAlt: "Failed",
                });
                updatePasswordForm.reset();

                formResetPassword();
            }
        });
    }catch (err) {
        console.log(err);
    }
});


const oldPassword = document.getElementById('old-password');
const oldPassMsg = document.querySelector('.old-pass-grp .message');
const oldPassBox = document.getElementById('old-password');

const newPassword = document.getElementById('new-password');
const confirmPassword = document.getElementById('confirm-password');
const confirmPassMsg = document.querySelector('.confirm-pass-grp .message');

const updatePassBtn = document.getElementById('update-pass-btn');

oldPassword.addEventListener('keypress', async (e) => {
    if(e.key === 'Enter'){
        const formData = new FormData();
        formData.append('old-password', oldPassword.value);

        try {
            const res = await fetch('/controller/client/VerifyOldPassword.php', {
                method: 'POST',
                body: formData
            })

            const data = await res.json();

            if (data.status === 'success') {

                oldPassMsg.innerHTML = "Password Matched";
                oldPassMsg.classList.add('success');
                oldPassMsg.classList.remove('error');
                // border green
                oldPassBox.style.border = "1px solid green";

                newPassword.disabled = false;
                confirmPassword.disabled = false;


            } else {

                oldPassMsg.innerHTML = "Password not Matched";
                oldPassMsg.classList.add('error');
                oldPassMsg.classList.remove('success');
                // border red
                oldPassBox.style.border = "1px solid red";

                newPassword.disabled = true;
                confirmPassword.disabled = true;

    
            }

        }
        catch (err) {
            console.log(err);
        }
    }
});


confirmPassword.addEventListener('keyup', async (e) => {
    if (newPassword.value === confirmPassword.value) {
        confirmPassword.style.border = "1px solid green";
        confirmPassMsg.innerHTML = "Password Matched";
        confirmPassMsg.classList.add('success');
        confirmPassMsg.classList.remove('error');
        updatePassBtn.disabled = false;
    } else {
        confirmPassword.style.border = "1px solid red";
        confirmPassMsg.innerHTML = "Password not Matched";
        confirmPassMsg.classList.add('error');
        confirmPassMsg.classList.remove('success');
        updatePassBtn.disabled = true;
    }
});


const formResetPassword = () =>{
    updatePasswordForm.reset();
    newPassword.disabled = true;
    confirmPassword.disabled = true;
    updatePassBtn.disabled = true;
    oldPassMsg.classList.remove('success');
    confirmPassMsg.classList.remove('success');
    confirmPassMsg.innerHTML = "";
    oldPassMsg.innerHTML = "";
    oldPassBox.style.border = "1px solid #c2c2c2";
    confirmPassword.style.border = "1px solid #c2c2c2";
}