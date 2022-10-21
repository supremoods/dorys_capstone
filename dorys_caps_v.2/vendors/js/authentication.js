const signUpForm = document.getElementById('sign-up-form');
const modalAlert = document.getElementById('alert-message');

signUpForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(signUpForm);
    try{
        const res = await fetch('/controller/client/RegisterController.php',{
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData)),
            headers: {
                'Content-Type': 'application/json'
            }
        })

        const data = await res.json();

        const success = "https://cdn-icons-png.flaticon.com/512/190/190411.png";
        const failed = "https://cdn-icons-png.flaticon.com/512/458/458594.png";

        if(data.status === 'success'){
            modalAlert.innerHTML += alertMessage("You have successfully registered", "success", success);
            modalAlert.classList.add('active');
            main.classList.toggle("sign-up-mode");
            signUpForm.reset();
        }else{
            modalAlert.innerHTML += alertMessage("Something went wrong", "danger", failed);
            modalAlert.classList.add('active');
        }

    }catch(err){
        console.log(err);
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

const closeAlert = () =>{
    modalAlert.innerHTML = "";
    modalAlert.classList.remove('active');
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
            modalAlert.innerHTML += alertMessage("Login Failed, Please check your username or password", "danger", failed);
            modalAlert.classList.add('active');
        }

    }catch(err){
        console.log(err);
    }
    
});

