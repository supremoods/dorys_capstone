
const nameAmmenity = document.getElementById("ammenity-name");
const rateAmmenity = document.getElementById("ammenity-rate");
const descriptionAmmenity = document.getElementById("description");

const loadAmmenitiesDetails = async () => {
    const sliderContainer = document.querySelector(".slider-container");   
    const token = sliderContainer.getAttribute("data-ammenity");

    const response = await fetch(`/admin/controller/FetchAmmenityDetails.php`,{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            token: token    
        })
    });

    const data = await response.json();

    if(data.status === 'success'){
        const ammenity = Object.values(data.ammenity);

        ammenity.forEach((ammenity) => {
            const root = document.querySelector(":root");
            // change the background image of the form
            if(ammenity.images !== ""){
                root.style.setProperty(`--bg-img`,`url(../../../vendors/images/services/${ammenity.images.split(',')[0]})`);
            }else{
                root.style.setProperty(`--bg-img`,`#e3e3e3`);
            }

            document.getElementById("ammenity-name").value = ammenity.name;
            document.getElementById("ammenity-rate").value = ammenity.price;
            document.getElementById("description").value = ammenity.description;

            const images = ammenity.images.split(',');
            document.querySelector(".masonry").innerHTML = "";

            // check if there are images
            if(images[0] !== ""){
                images.forEach((image) => {
                    document.querySelector(".masonry").innerHTML += `
                    <div class="grid">
                        <img src="/vendors/images/services/${image.replace(/^\s+|\s+$/gm,'')}">
                        <div class="grid__body">
                            <div class="delete-icon">
                                <button data-name="${image.replace(/^\s+|\s+$/gm,'')}" onclick="deleteImage(this.dataset.name)"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    `
                })
            }else{
                document.querySelector(".masonry").innerHTML = `
                    <div class="grid">
                        no images found, please add some
                    </div>
                `
            }
        });
    }else{
        console.log(data);
    }
}       


loadAmmenitiesDetails();

const deleteImage = async (name) => {
    const sliderContainer = document.querySelector(".slider-container");   
    const token = sliderContainer.getAttribute("data-ammenity");
    Swal.fire({
        title: 'Please wait...',
        html: 'We are processing your request',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });
    const response = await fetch(`/admin/controller/DeleteAmmenityImage.php`,{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            token: token
        })
    });

    const data = await response.json();
    console.log(data);

    if(data.status === 'success'){
        Swal.close();
        Swal.fire({
            title: 'Success',
            text: 'Image deleted successfully',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if(result.isConfirmed){
                loadAmmenitiesDetails();
            }
        })

   
    }else{
        console.log(data);
    }
}


const updateAmmenity = async () => {
    const sliderContainer = document.querySelector(".slider-container");   
    const token = sliderContainer.getAttribute("data-ammenity");

    const name = nameAmmenity.value;
    const rate = rateAmmenity.value;
    const description = descriptionAmmenity.value;
    Swal.fire({
        title: 'Please wait...',
        html: 'We are processing your request',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });
    const response = await fetch(`/admin/controller/UpdateAmmenity.php`,{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            rate: rate,
            description: description,
            token: token
        })
    });

    const data = await response.json();

    if(data.status === 'success'){
        Swal.close();
        Swal.fire({
            title: 'Success',
            text: 'Ammenity has been updated',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if(result.isConfirmed){
                loadAmmenitiesDetails();
            }
        })
    }else{
        console.log(data);
    }
}


// submit the form when the user presses enter

nameAmmenity.addEventListener("keypress", (e) => {
    if(e.key === "Enter"){
        updateAmmenity();
    }
});

rateAmmenity.addEventListener("keypress", (e) => {
    if(e.key === "Enter"){
        updateAmmenity();
    }
});

descriptionAmmenity.addEventListener("keypress", (e) => {
    if(e.key === "Enter"){
        updateAmmenity();
    }
});

const addImageBtn = document.querySelector(".add-image-btn");
const cancelBtn = document.querySelector(".cancel-btn");
const modalUpload = document.querySelector(".modal-add-image");
const uploadImage = document.getElementById("upload-image");

addImageBtn.addEventListener("click", () => {
    modalUpload.style.display = "flex";
});

cancelBtn.addEventListener("click", () => {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!'
    }).then((result) => {
        if (result.isConfirmed) {
            modalUpload.style.display = "none";
            resetUploader();
        }
    })

});


$('.add-images').imageUploader({
    maxSize: 20 * 1024 * 1024,
    maxFiles: 20,
});

uploadImage.addEventListener("submit", (e) => {

    e.preventDefault();

    const formData = new FormData(uploadImage);
    Swal.fire({
        title: 'Please wait...',
        html: 'We are processing your request',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });
    fetch('/admin/controller/UploadImage.php',{
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data.status === 'success'){
            Swal.close();
            Swal.fire({
                title: 'Success',
                text: 'Image uploaded successfully',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if(result.isConfirmed){
                    modalUpload.style.display = "none";
                    loadAmmenitiesDetails();
                    resetUploader();
                }
            })
           
        }else{
            console.log(data);
        }
    })


});


const resetUploader = () => {
    document.querySelector('.add-images').innerHTML = '';
    $('.add-images').imageUploader({
        maxSize: 20 * 1024 * 1024,
        maxFiles: 20,
    });
}

const toggleEdit = document.getElementById('toggle-edit');

toggleEdit.addEventListener("change", () => {
    toggleInputEdit()
});

const toggleInputEdit = () => {
    nameAmmenity.disabled = !nameAmmenity.disabled;
    rateAmmenity.disabled = !rateAmmenity.disabled;
    descriptionAmmenity.disabled = !descriptionAmmenity.disabled;
}


const disabledInput = () => {
    nameAmmenity.disabled = true;
    rateAmmenity.disabled = true;
    descriptionAmmenity.disabled = true;
}

disabledInput();


