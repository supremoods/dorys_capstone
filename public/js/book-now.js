const checkoutDate = document.getElementById("checkout-date");
const checkinDate = document.getElementById("checkin-date");
const totalRate = document.getElementById("total-rate");
const hourlyRate = document.getElementById("hourly-rate");

const cancelBooking = document.querySelector(".cancel-book-btn");
const bookNowForm = document.getElementById("booking-form");
const transactForm = document.getElementById("transact-form");

let boolean = false;

const OccupiedTimeContainer = document.querySelector(
  ".occupied-time-container"
);

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

        // change the background image of the form
        root.style.setProperty(
          `--bg-image`,
          `url(../images/services/${ammenities[0].images.split(",")[0]})`
        );
      } else {
        console.log(data);
      }
    });
};

loadBackgroundImage();

const ammenitiesSelection = document.getElementById("ammenities-selection");

ammenitiesSelection.addEventListener("change", (e) => {
  loadOccupiedTime();

  // fetch the ammenities
  fetch("/controller/client/FetchAmmenities.php", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
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

        checkDateifEmpty(checkinDate.value, checkoutDate.value);
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
  if (startDate != "" && endDate != "") {
    const number_of_hours = getHoursDiff(
      new Date(startDate),
      new Date(endDate)
    );
    const rate = parseInt(hourlyRate.value.replace("₱", ""));

    totalRate.value = "₱" + number_of_hours * rate;
  } else {
    totalRate.value = hourlyRate.value;
  }
};

function getHoursDiff(startDate, endDate) {
  const msInHour = 1000 * 60 * 60;

  return Math.round(
    Math.abs(endDate.getTime() - startDate.getTime()) / msInHour
  );
}

checkinDate.addEventListener("change", (e) => {
  checkDateifEmpty(checkinDate.value, checkoutDate.value);
  loadOccupiedTime();
});

checkoutDate.addEventListener("change", (e) => {
  checkDateifEmpty(checkinDate.value, checkoutDate.value);
});

bookNowForm.addEventListener("submit", (e) => {
  e.preventDefault();
  if(boolean){
  const formData = new FormData(bookNowForm);

  fetch("/controller/client/BookNow.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(Object.fromEntries(formData)),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        Swal.fire({
          title: "Success!",
          text: "Booking successful",
          icon: "success",
          confirmButtonText: "Okay",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "/pages/transactionList.php";
          }
        });
      } else {
        Swal.fire({
          title: "Failed!",
          text: "Failed to book",
          icon: "error",
          confirmButtonText: "Okay",
        });
      }
    });
  }else{
    Swal.fire({
          title: "Failed!",
          text: "Date or Time is already booked",
          icon: "error",
          confirmButtonText: "Okay",
        });
  }
});

const loadOccupiedTime = () => {
  if (checkinDate.value != "") {
    const date = new Date(checkinDate.value).toLocaleDateString("en-us", {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
    });

    const dateArray = date.split("/");
    const formattedDate = `${dateArray[2]}-${dateArray[0]}-${dateArray[1]}`;

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
          OccupiedTimeContainer.innerHTML = `
                <div class="list-item">
                  This date is free for booking
                </div>
          `;
          boolean = true; 
        } else {
          const occupiedTime = [];
          data.forEach((item) => {
            occupiedTime.push({
              token: `item__${item.reservation_token}`,
              start: item.start,
              end: item.end,
            });
          });
          OccupiedTimeContainer.innerHTML = `
                  ${occupiedTime.map((item) => {
                    return `
                      <div class="list-item ${item.token}">
                       <p>${new Date(
                         item.start
                       ).toLocaleTimeString()} - ${new Date(
                      item.end
                    ).toLocaleTimeString()}</p>
                      </div>`;
                  })}
          `;
          occupiedTime.forEach((item) => {
            const time = new Date(checkinDate.value).getTime();
            const startTime = new Date(item.start).getTime();
            const endTime = new Date(item.end).getTime();

            if (time > startTime && time < endTime) {
              document.querySelector(`.${item.token}`).style.color = "red";
              console.log("occupied");

              boolean = false;
            } else {
              document.querySelector(`.${item.token}`).style.color = "black";
              console.log("free");

              boolean = true;
            }
          });
        }
      });
  } else {
    OccupiedTimeContainer.innerHTML = `
    <div class="list-item">
      Please select a date first
    </div>
    `;
    boolean = false;
  }
};

checkDateifEmpty(checkinDate.value, checkoutDate.value);
loadOccupiedTime();
