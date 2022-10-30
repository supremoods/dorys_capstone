
const checkoutDate = document.getElementById("checkout-date");
const checkinDate = document.getElementById("checkin-date");
const totalRate = document.getElementById("total-rate");
const hourlyRate = document.getElementById("hourly-rate"); 

const cancelBooking = document.querySelector(".cancel-book-btn");
const bookNowForm = document.getElementById("booking-form");
const transactForm = document.getElementById("transact-form");

cancelBooking.addEventListener("click", () => {
    window.location.href = "/";
});

const loadBackgroundImage = (e) => {
    // get dataset of transactform
   const token = transactForm.dataset.token;

    fetch("/controller/client/FetchAmmenitiesDetails.php", {
        method: "POST",
        headers: {  
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({
            services_token: token
        })
    }).then(res => res.json())
    .then(data => {
        if(data.status === "success"){
            const ammenities = data.ammenities;
            console.log(ammenities);
            const root = document.querySelector(":root");

            // change the background image of the form
            root.style.setProperty(`--bg-image`,`url(../images/services/${ammenities[0].images.split(",")[0]})`);

        }else{
            console.log(data);
        }
    })


}

loadBackgroundImage();

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
                root.style.setProperty(`--bg-image`,`url(../images/services/${ammenities[index].images.split(",")[0]})`);

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
    }else{
        totalRate.value = hourlyRate.value;
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

checkoutDate.addEventListener("change", (e) => {
    checkDateifEmpty(checkinDate.value, checkoutDate.value);
});



bookNowForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(bookNowForm);

    console.log(Object.fromEntries(formData));
    fetch("/controller/client/BookNow.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(Object.fromEntries(formData))
    }).then(res => res.json())
        .then(data => {
            if(data.status === "success"){
                Swal.fire({
                    title: "Success!",
                    text: "Booking successful",
                    icon: "success",
                    confirmButtonText: "Okay",
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location.href = "/pages/transactionList.php";
                    }
                });
            }else{
                Swal.fire({
                    title: "Failed!",
                    text: "Failed to book",
                    icon: "error",
                    confirmButtonText: "Okay",
                });
            }
    });
});

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
