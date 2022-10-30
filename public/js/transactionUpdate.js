const cancelTranscatBtn = document.querySelector('.cancel-transact-btn');
const transactForm = document.querySelector('.transact-form');

const loadBackgroundImage = (e) => {
    // get dataset of transactform
   const token = transactForm.dataset.token;

   // fetchTransactDetails
    fetch("/controller/client/FetchTransactDetails.php", {
        method: "POST",
        headers: {  
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({
            reservation_token: token
        })
    }).then(res => res.json())
    .then(data => {
        if(data.status === "success"){
            const ammenities = data.transact;

            const root = document.querySelector(":root");

            // change the background image of the form
            root.style.setProperty(`--bg-image`,`url(../images/services/${ammenities.images})`);

        }
    })


}

loadBackgroundImage();

const cancelTransaction = () => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                "Cancelled!",
                "Your reservation has been cancelled.",
                "success"
            );

            setTimeout(() => {
                window.location.href = "/pages/transactionList.php";
            }, 5);
        }
    });
}


cancelTranscatBtn.addEventListener('click', cancelTransaction);

const checkinElem = document.querySelector("#checkin-date");
const checkoutElem = document.querySelector("#checkout-date");

// disable past dates in checkin datetimepicker

checkinElem.addEventListener("change", (e) => {
    const checkinDate = new Date(e.target.value);
    const checkoutDate = new Date(checkoutElem.value);

    if (checkoutDate < checkinDate) {
        checkoutElem.value = "";
    }

    checkoutElem.min = e.target.value;
}); 


// disable past dates in checkout datetimepicker
checkoutElem.addEventListener("change", (e) => {
    const checkinDate = new Date(checkinElem.value);
    const checkoutDate = new Date(e.target.value);
    if (checkoutDate < checkinDate) {
        checkinElem.value = "";
    }
    checkinElem.max = e.target.value;
});

const ammenitiesSelection = document.getElementById("ammenities-selection");

ammenitiesSelection.addEventListener("change", (e) => {

    // fetch the ammenities
    fetch("/controller/client/FetchAmmenities.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }

    }).then(res => res.json())
        .then(data => {
            if(data.status === "success"){
                const ammenities = data.ammenities;

                // find the index of the selected ammenity
                const index = ammenities.findIndex(amenity => amenity.name == e.target.value);
                const root = document.querySelector(":root");

                console.log(index);
                // change the background image of the form
                root.style.setProperty(`--bg-image`,`url(../images/services/${ammenities[index].images})`);

                // split the images into an array 
                const images = ammenities[index].images.split(",");

                hourlyRate.value = `₱${ammenities[index].price}`;

                ammenitiesSelection.dataset.service_token = ammenities[index].services_token;
                // clear the gallery
                document.querySelector(".gallery").innerHTML = "";
                galleryItems(images);

                checkDateifEmpty(checkinDate.value, checkoutDate.value);
            }else{
                Swal.fire({
                    title: "Failed!",
                    text: "Failed to fetch ammenities",
                    icon: "error",
                    confirmButtonText: "Okay",
                });
            }
    });
});

const galleryItems = (images) => {
    let gallery = document.querySelector(".gallery");

    images.forEach((image) => {
        let galleryItem = document.createElement("div");
        galleryItem.classList.add("gallery-item");

        let galleryImage = document.createElement("img");
        galleryImage.src = `../public/images/services/${image}`;
        galleryImage.classList.add("gallery-image");

        galleryItem.appendChild(galleryImage);
        gallery.appendChild(galleryItem);
    });
};

const checkDateifEmpty = (startDate, endDate) => {
    
    if(startDate != "" && endDate != ""){
        const number_of_hours = getHoursDiff(new Date(startDate), new Date(endDate));
        const rate = parseInt(hourlyRate.value.replace("₱", ""));
        
        totalRate.value = '₱'+ number_of_hours * rate;
    }

}

function getHoursDiff(startDate, endDate) {
    const msInHour = 1000 * 60 * 60;
  
    return Math.round(
      Math.abs(endDate.getTime() - startDate.getTime()) / msInHour,
    );
}

function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}


const checkoutDate = document.getElementById("checkout-date");
const checkinDate = document.getElementById("checkin-date");
const totalRate = document.getElementById("total-rate");
const hourlyRate = document.getElementById("hourly-rate");  

checkoutDate.addEventListener("change", (e) => {
    checkDateifEmpty(checkinDate.value, checkoutDate.value);
});

const UpdateTransaction = () => {
    const name = document.getElementById("ammenities-selection").value;
    const checkin = document.getElementById("checkin-date").value;
    const checkout = document.getElementById("checkout-date").value;
    const total = document.getElementById("total-rate").value;
    const messageContent = document.getElementById("message").value;
    const paymentMethod = document.getElementById("mode-of-payment").value;
    const service_token =  ammenitiesSelection.dataset.service_token;

    fetch("/controller/client/UpdateTransaction.php", {
        method: "POST",
        headers: {  
            "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "reservation_token": transactForm.dataset.token,
                "name": name,
                "start_datetime": checkin,
                "end_datetime": checkout,
                "mode-of-payment": paymentMethod,
                "total-rate": total,
                "message": messageContent,
                "service_token": service_token
            })
    }).then(res => res.json())
        .then(data => {
            if(data.status === "success"){
                Swal.fire({
                    title: "Success!",
                    text: "Transaction has been updated",
                    icon: "success",
                    confirmButtonText: "Okay",
                });
                window.location.href = "/pages/transactionList.php";
            }else{
                Swal.fire({
                    title: "Failed!",
                    text: "Failed to update transaction",
                    icon: "error",
                    confirmButtonText: "Okay",
                });
            }
    });
}

const updateForm = document.getElementById("elem-form");
updateForm.addEventListener("submit", (e) => {
    e.preventDefault();
    UpdateTransaction();
});