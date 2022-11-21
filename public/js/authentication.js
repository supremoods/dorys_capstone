const signUpForm = document.getElementById('sign-up-form');
const modalAlert = document.getElementById('alert-message');

signUpForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(signUpForm);

    const password = formData.get('password');
    const confirmPassword = formData.get('confirm-password');
    const success = "https://cdn-icons-png.flaticon.com/512/190/190411.png";
    const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";
    if(validatePassword(password, confirmPassword)){
        try{
            Swal.fire({
                title: 'Please wait...',
                html: 'We are processing your request',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            const res = await fetch('/controller/client/RegisterController.php',{
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            })

            const data = await res.json();

            if(data.status === 'success'){

                Swal.close();

                Swal.fire({
                    title: "Success!",
                    text: "You have successfully registered",
                    imageUrl: success,
                    imageWidth: 150,
                    imageHeight: 150,
                    imageAlt: "Success",
                });

                main.classList.toggle("sign-up-mode");
                signUpForm.reset();
            }else{

                Swal.close();

                Swal.fire({
                    title: "Failed!",
                    text: "Registration failed",
                    imageUrl: failed,
                    imageWidth: 150,
                    imageHeight: 150,
                    imageAlt: "Failed",
                });

                signUpForm.reset();

            }

        }catch(err){
            Swal.close();
            console.log(err);
        }
    }else{
        
        Swal.fire({
            title: "Failed!",
            text: "Password does not match",
            imageUrl: failed,
            imageWidth: 150,
            imageHeight: 150,
            imageAlt: "Failed"
        });
    }
});

const alertMessage = (message, status, img) =>{
    return `
    <button class="close" onclick="closeAlert()">✖</button>
    <img src="${img}" alt="cookies-img" />
  
    <p>${message}</p>
    <button class="accept ${status}" onclick="closeAlert()">Continue</button>
    `
}

const loginForm = document.getElementById('sign-in-form');
const body = document.querySelector("body");

loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(loginForm);
    try{
        const res = await fetch('/controller/client/LoginController.php',{
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData)),
            headers: {
                'Content-Type': 'application/json'
            }
        })

        const data = await res.json();

        const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";

        if(data.status === 'success'){
            window.location.href = "/";
        }else{
            Swal.fire({
                title: "Failed!",
                text: "Login failed, please try again, or register if you don't have an account",
                imageUrl: failed,
                imageWidth: 150,
                imageHeight: 150,
                imageAlt: "Failed",
            });
        }
    }catch(err){
        console.log(err);
    }
});



const validatePassword = (password, confirmPassword) => {
    if(password === confirmPassword){
        return true;
    }else{
        return false;
    }
}   

const closeAlert = () => {
    modalAlert.innerHTML = "";
    modalAlert.classList.remove('active');
}


const inputName = document.getElementById('input-name');



inputName.addEventListener('keypress', (e) => {
    const regex = new RegExp("^[a-zA-Z ]+$");
    const key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
})