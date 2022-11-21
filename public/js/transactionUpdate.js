const tempTime = [];

const totalRate = document.getElementById("total-rate");
const hourlyRate = document.getElementById("hourly-rate");

const selectDate = document.getElementById("arrival-date");
const selectTime = document.getElementById("select-time");
const arrivalDate = document.getElementById("arrival-date");

const arrivalTime = document.getElementById("arrival-time");
const departureTime = document.getElementById("departure-time");
const selectHours = document.getElementById("select-hours");

const checkoutDate = document.getElementById("checkout-date");
const checkinDate = document.getElementById("checkin-date");

const cancelBooking = document.querySelector(".cancel-book-btn");
const updateForm = document.getElementById("booking-form");
const transactForm = document.getElementById("transact-form");

const resFee = document.getElementById("res-fee");

const ammenitiesSelection = document.getElementById("ammenities-selection");

const OccupiedTimeContainer = document.querySelector(
    ".occupied-time-container"
);

const populateTime = () => {
    arrivalTime.value = selectTime.value;
    const partialdate = new Date((`${selectDate.value} ${arrivalTime.value}`));

    arrivalTime.value = formatAMPM(partialdate);
    checkinDate.value = dateFormater(partialdate);
    const selectHoursValue = parseInt(selectHours.value);

    partialdate.setTime(partialdate.getTime() + selectHoursValue * 60 * 60 * 1000);
    departureTime.value = formatAMPM(partialdate);
    checkoutDate.value = dateFormater(partialdate);


    //remove the pesos sign
    const totalHours = selectHoursValue * parseInt(hourlyRate.value.replace("₱", ""));
    totalRate.value = `₱${totalHours}`;

    // get 30% of the Total Rate
    const resFeeValue = totalHours * 0.3;

    reservFeeTemp = resFeeValue;

    resFee.value = `₱${resFeeValue}`;
}

const appendLeadingZeroes = (n) => {
    if (n <= 9) {
        return "0" + n;
    }
    return n
}

const dateFormater = (date) => {
    const year = date.getFullYear();
    const month = appendLeadingZeroes(date.getMonth() + 1);
    const day = appendLeadingZeroes(date.getDate());
    const hour = appendLeadingZeroes(date.getHours());
    const minute = appendLeadingZeroes(date.getMinutes());
    const second = appendLeadingZeroes(date.getSeconds());
    return `${year}-${month}-${day} ${hour}:${minute}:${second}`;
}

const formatAMPM = (date) => {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

selectDate.addEventListener("change", (e) => {
    loadOccupiedTime();
});

selectHours.addEventListener("change", (e) => {
    if (selectTime.value !== "0") {
        populateTime();
    }
});

selectTime.addEventListener("change", (e) => {
    populateTime();
    // loop select hours
    const selectedTime = parseInt(selectTime.value);
    console.log(selectedTime + "ss");

    selectHours.innerHTML = "";
    // loop the tempTime
    searched = false;
    if (tempTime.length > 0) {
      tempTime.forEach((time) => {
        if (!searched) {
          if (selectedTime < time) {
            let count = 1;
            for (let i = selectedTime; i < time; i++) {
              selectHours.innerHTML += `<option value="${count}">${count}</option>`;
              count++;
            }
            // break the loop
            searched = true;
            return;
          } else if (selectedTime === 24) {
            // do nothing
            for (let i = 1; i <= 24; i++) {
              selectHours.innerHTML += `<option value="${i}">${i}</option>`;
            }
            searched = true;
            return;
          }
        }
      });
    } else {
  
      for (let i = 1; i <= 24; i++) {
        selectHours.innerHTML += `<option value="${i}">${i}</option>`;
      }
  
    }

});

const populateSelectHours = async () => {
    populateTime();
    // loop select hours
    const selectedTime = parseInt(selectTime.value);
    console.log(selectedTime + "ss");

    selectHours.innerHTML = "";
    // loop the tempTime
    searched = false;
 
    if (tempTime.length > 0) {
      tempTime.forEach((time) => {
          if (!searched) {
              if (selectedTime < time) {
                  let count = 1;
                  for (let i = selectedTime; i < time; i++) {
                      selectHours.innerHTML += `<option value="${count}">${count}</option>`;
                      count++;
                  }
                  // break the loop
                  searched = true;
                  return;
              } else if (selectedTime === 24) {
                  // do nothing
                  for (let i = 1; i <= 24; i++) {
                      selectHours.innerHTML += `<option value="${i}">${i}</option>`;
                  }
                  searched = true;
                  return;
              }
          }
      });
    } else {
      for (let i = 1; i <= 24; i++) {
        selectHours.innerHTML += `<option value="${i}">${i}</option>`;
      }
      console.log("no occupied time");
    }
}
// disable past dates in the date picker
const disablePastDates = () => {
    const today = new Date();
    const dd = String(today.getDate()).padStart(2, "0");
    const mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
    const yyyy = today.getFullYear();

    const todayDate = yyyy + "-" + mm + "-" + dd;
    selectDate.setAttribute("min", todayDate);
};


const loadBackgroundImage = (e) => {
    // get dataset of transactform
    const token = transactForm.dataset.token;

    fetch("/controller/client/FetchAmmenitiesDetails.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify({
            services_token: token,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                const ammenities = data.ammenities;

                const root = document.querySelector(":root");
                root.style.setProperty(
                    `--bg-image`,
                    `url(../images/services/${ammenities[0].images.split(",")[0]})`
                );
            } else {
                console.log(data);
            }
        });
};


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

const loadOccupiedTime = async () => {
    if (selectDate.value != "") {
      const date = new Date(selectDate.value).toLocaleDateString("en-us", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
      });
      const dateArray = date.split("/");
      const formattedDate = `${dateArray[2]}-${dateArray[0]}-${dateArray[1]}`;
  
      console.log(formattedDate);
  
      fetch("/controller/client/fetchOccupiedTime.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          date: formattedDate,
          ammenity: ammenitiesSelection.value,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status === "failed") {
            console.log(data);
            tempTime.splice(0, tempTime.length);
            for (let i = 0; i < selectTime.options.length; i++) {
              let option = selectTime.options[i];
                option.disabled = false;
                option.style.color = "black";
                option.style.background = "white";
            }
          } else {
            const occupiedTime = [];
            data.forEach((item) => {
              occupiedTime.push({
                token: `item__${item.reservation_token}`,
                start: item.start,
                end: item.end,
              });
            });
            const startTime = new Date(checkinDate.value).getHours();
            tempTime.splice(0, tempTime.length);
            occupiedTime.map((item) => {
              let start = new Date(item.start).getHours();
              let end = new Date(item.end).getHours();
              end === 0 ? (end = 24) : end;
                if(!(startTime >= start && startTime < end)){
                    for (let i = start; i < end; i++) {
                        tempTime.push(i);
                    }
                }
            });
            populateTime();
            // loop select hours
            const selectedTime = parseInt(selectTime.value);
            console.log(selectedTime + "ss");
        
            selectHours.innerHTML = "";
            // loop the tempTime
            searched = false;
            const startT = checkinDate.value;
            const endT = checkoutDate.value;
        
            // get the range of start and end time
            const range = getRange(new Date(startT).getHours(), new Date(endT).getHours() == 0 ? 24 : new Date(endT).getHours());
            if (tempTime.length > 0) {
              tempTime.forEach((time) => {
                  if (!searched) {
                      if (selectedTime < time) {
                          let count = 1;
                          for (let i = selectedTime; i < time; i++) {
                            if(range === count){
                                selectHours.innerHTML += `<option value="${count}" selected>${count}</option>`;
                                count++;
                            }else{
                                selectHours.innerHTML += `<option value="${count}">${count}</option>`;
                                count++;
                            }
                         
                          }
                          // break the loop
                          searched = true;
                          return;
                      } else if (selectedTime === 24) {
                          for (let i = 1; i <= 24; i++) {
                              selectHours.innerHTML += `<option value="${i}">${i}</option>`;
                          }
                          searched = true;
                          return;
                      }else{
                        for (let i = 1; i <= 24; i++) {
                            if(range === i){
                                selectHours.innerHTML += `<option value="${i}" selected>${i}</option>`;
                            }else{
                                selectHours.innerHTML += `<option value="${i}">${i}</option>`;
                            }
                          }
                          searched = true;
                          return;
                      }
                  }
              });
            } else {
              for (let i = 1; i <= 24; i++) {
                if(range === i){
                    selectHours.innerHTML += `<option value="${i}" selected>${i}</option>`;
                }else{
                    selectHours.innerHTML += `<option value="${i}" >${i}</option>`;
                }
              }
            }
         
            for (let i = 0; i < selectTime.options.length; i++) {
              let option = selectTime.options[i];
              if (tempTime.includes(parseInt(option.value))) {
                option.disabled = true;
                // change the text color to red
                option.style.color = "red";
                option.style.background = "rgba(255, 0, 0, 0.1)";
              } else {
                option.disabled = false;
                option.style.color = "black";
                option.style.background = "white";
              }
            }
          }
        });
    }
  };
  

cancelBooking.addEventListener("click", () => {
    window.location.href = "/";
});

ammenitiesSelection.addEventListener("change", (e) => {
    loadOccupiedTime();

    Swal.fire({
        title: "Loading...",
        allowOutsideClick: false,
        showConfirmButton: false,
    });
    fetch("/controller/client/FetchAmmenities.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                Swal.close();
                const ammenities = data.ammenities;

                // find the index of the selected ammenity
                const index = ammenities.findIndex(
                    (amenity) => amenity.name == e.target.value
                );
                const root = document.querySelector(":root");

                // change the background image of the form
                root.style.setProperty(
                    `--bg-image`,
                    `url(../images/services/${ammenities[index].images.split(",")[0]})`
                );

                // split the images into an array
                const images = ammenities[index].images.split(",");

                hourlyRate.value = `₱${ammenities[index].price}`;

                ammenitiesSelection.dataset.service_token =
                    ammenities[index].services_token;
                // clear the gallery
                document.querySelector(".gallery").innerHTML = "";
                galleryItems(images);

                populateTime();

            } else {
                Swal.fire({
                    title: "Failed!",
                    text: "Failed to fetch ammenities",
                    icon: "error",
                    confirmButtonText: "Okay",
                });
            }
        });
});

updateForm.addEventListener("submit", (e) => {
    e.preventDefault();
    Swal.fire({
        title: "Updating...",
        allowOutsideClick: false,
        showConfirmButton: false,
    });


    const formData = new FormData(updateForm);

    const reservFeeTemp = resFee.dataset.paid_amount;

    if(reservFeeTemp < parseInt(resFee.value.replace("₱", ""))){
        Swal.close();
        fee = parseInt(resFee.value.replace("₱", "")) - reservFeeTemp;
        Swal.fire({
            title: "Are you sure?",
            text: `You will be charged an additional fee of ₱${fee}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!",
        }).then(async(result) => {
            if (result.isConfirmed) {
       
                Swal.fire({
                    title: "Loading...",
                    text: "Please wait while we process your payment",
                    allowOutsideClick: false,
                    showConfirmButton: false,
                  });
                  const response = await fetch('/controller/client/FetchGcashDetails.php');
                  const data = await response.json();
                
                  const res = data.res;
              
                Swal.fire({
                    title: "GCash",
                    html: `
                      <p>Please scan the QR code below to pay the reservation fee. or you can pay through the number below.</p>
                      <div class="text-group">
                        <h1>${res.number}</h1>
                        <p>${res.name}</p>
                      </div>
                    `,
                    imageUrl: `../public/images/qrCode/${res.gcash_qr}`,
                    input: "text",
                    inputPlaceholder: "Please enter the reference number after payment",
                    imageWidth: 400,
                    imageHeight: 400,
                    imageAlt: "Custom image",
                    confirmButtonText: "Okay",
                    cancellButtonText: "Cancel",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "You need to enter the reference number!";
                        }
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        formData.append("reference_number", result.value);
                        Swal.fire({
                            title: "Updating...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });

                        fetch("/controller/client/UpdateTransaction.php", {
                            method: "POST",
                            body: formData,
                        })
                            .then((res) => res.json())
                            .then((data) => {
                                if (data.status === "success") {
                                    Swal.close();
                                    Swal.fire({
                                        title: "Success!",
                                        text: "Reservation updated successfully",
                                        icon: "success",
                                        confirmButtonText: "Okay",
                                    }).then(() => {
                                        window.location.href = "/";
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Failed!",
                                        text: "Failed to update reservation",
                                        icon: "error",
                                        confirmButtonText: "Okay",
                                    });
                                }
                            });
                        }
                    });
            }else{
                Swal.close();
            }
        });
    }else{
        Swal.close();
        fetch("/controller/client/UpdateTransaction.php", {
            method: "POST",
            body: formData,
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.status === "success") {
                    Swal.fire({
                        title: "Success!",
                        text: "Reservation updated successfully ",
                        text: "Note: Please keep in mind that any remaining balance from your downpayment will be deducted from your total payment.",
                        icon: "success",
                        confirmButtonText: "Okay",
                    }).then(() => {
                        window.location.href = "/";
                    });
                } else {
                    Swal.fire({
                        title: "Failed!",
                        text: "Failed to update reservation",
                        icon: "error",
                        confirmButtonText: "Okay",
                    });
                }
            });
    }
});


const loadForm = () => {
    const startTime = checkinDate.value;
    const endTime = checkoutDate.value;
    // convert get the time
    const start = `${appendLeadingZeroes(new Date(startTime).getHours())}:00`;

    const range = getRange(new Date(startTime).getHours(),new Date(endTime).getHours() == 0 ? 24 : new Date(endTime).getHours());

    console.log(range);

    for (let i = 0; i < selectTime.options.length; i++) {
        let option = selectTime.options[i];
        // split the time
        if (start=== option.value){
            option.selected = true;
        }
    }

    selectHours.value = range;
    loadOccupiedTime();
}

const getRange = (start, end) => {
    range = 0;
    for (let i = start; i < end; i++) {
        range++;
    }
    return range;
}


disablePastDates();
loadBackgroundImage();
loadForm();
