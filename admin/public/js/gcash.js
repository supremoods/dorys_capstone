
const gcashQrInput = document.getElementById('gcash-qr');
const qrImage = document.getElementById('qr-img');
const gcashForm = document.getElementById('gcash-form');
const gcashNumber = document.getElementById('gcash-number');
const gcashName = document.getElementById('gcash-name');
gcashQrInput.addEventListener('change', async () => {
   if (gcashQrInput.files && gcashQrInput.files[0]) {
       var reader = new FileReader();

       reader.onload = function (e) {
            qrImage.src = e.target.result;
       };

       reader.readAsDataURL(gcashQrInput.files[0]);
   }
});


gcashForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(gcashForm);
    Swal.fire({
        title:'loading',
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        }
    })
    const response = await fetch('/admin/controller/UploadGcashQR.php', {
        method: 'POST',
        body: formData
    });
    const data = await response.json();
    if (data.status === 'success') {
        Swal.close();
        Swal.fire({
            title: 'Success!',
            text: 'QR Code has been uploaded.',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
        loadGcashForm();
    } else {
        Swal.close();
        console.log(data);
        Swal.fire({
            title: 'Error!',
            text: data.error,
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    }
});


