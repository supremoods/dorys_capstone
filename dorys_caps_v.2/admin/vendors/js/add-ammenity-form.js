const closeBtn = document.querySelector('.close-btn');
const showAmmenityForm = document.querySelector('.add-ammenity-header .add-btn');
const ammenityForm = document.querySelector('.add-ammenity');
const imageUploader = document.querySelector('.filepond');

const ammenitySubmit = document.getElementById('ammenity-form');

closeBtn.addEventListener('click', () => {
    ammenityForm.classList.remove('show');
});


showAmmenityForm.addEventListener('click', () => {
    ammenityForm.classList.add('show');
});


$('.input-images').imageUploader({
    maxSize: 20 * 1024 * 1024,
    maxFiles: 20,
    
});


ammenitySubmit.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(ammenitySubmit);


    fetch('/admin/controller/AddAmmenity.php', {
        method: 'POST',
        body: formData
    }).then(res => res.json())
        .then(data => {
            if (data) {
                Swal.fire({
                    title: 'Success',
                    text: 'Ammenity Added',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    // RESET FORM
                    ammenitySubmit.reset();
                    // empty the input-images
                    document.querySelector('.input-images').innerHTML = '';
                    $('.input-images').imageUploader({
                        maxSize: 20 * 1024 * 1024,
                        maxFiles: 20
                    });
                    loadAmmenities();
                    ammenityForm.classList.remove('show');
                })
            } else {
                console.log(data);
            }
        })
        .catch(err => console.log(err));
    console.log(JSON.stringify(Object.fromEntries(formData)));  
});

const loadAmmenities = async () => {
    const res = await fetch('/admin/controller/FetchAmmenities.php');
    const data = await res.json();

    const ammenityList = document.querySelector('.card-grid');

    ammenityList.innerHTML = '';

    const ammenities = Object.values(data.ammenities);
    ammenities.forEach(ammenity => {
        ammenityList.innerHTML += `
        <article class="card">
            <div class="card-header">
                <img src="/vendors/images/services/${ammenity.images.split(',')[0]}"  />
                <h1>${ammenity.name}</h1>
                <div class="delete-icon" data-id="${ammenity.services_token}" onclick=(deleteAmmenity(this.dataset.id))>
                    <i class="fas fa-trash"></i>
                </div>
            </div>
            <div class="card-body">
                <p>${ammenity.description}</p>
            </div>
            <div class="card-footer">
                <a href="/admin/dashboard/ammenity_detail.php?ammenity=${ammenity.name}&service_token=${ammenity.services_token}" data-service_token="">View Full Details</a>
            </div>
        </article>
        `;
    });
}


loadAmmenities();


const deleteAmmenity = async (ammenity) => {
    const res = await fetch('/admin/controller/DeleteAmmenity.php', {
        method: 'POST',
        body: JSON.stringify({
            ammenity: ammenity
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const data = await res.json();

    if (data.status === 'success') {
        Swal.fire({
            title: 'Success',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(() => {
            loadAmmenities();
        })
    } else {
        console.log(data);
    }
}   