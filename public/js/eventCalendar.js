document.addEventListener('DOMContentLoaded', () => {
    
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        contentHeight: 600,
        windowResize: function(arg) {
            console.log("resize");
            calendar.changeView('timeGridWeek');


        },
        aspectRatio: 5,
        events: '/controller/client/PopulateCalendar.php',
        eventClick: (info) => {
            info.jsEvent.preventDefault();
            info.el.style.borderColor = 'red';
            if (info.event.title === 'Unavailable') {
                Swal.fire({
                    title: info.event.title,
                    text: "This date is unavailable, please select another date",
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            } else {
                Swal.fire({
                    title: info.event.title,
                    text: "reserved",
                })
            }
        },
        dateClick: (info) => {
            info.jsEvent.preventDefault();
            // check if the date is in the past
            if (info.dateStr < new Date().toISOString().split('T')[0]) {
                Swal.fire({
                    title: 'Unavailable',
                    text: "This date is unavailable, please select another date",
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            } else {
                Swal.fire({
                    title: 'Please wait...',
                    html: 'We are processing your request',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                fetch('/controller/client/PopulateCalendar.php')
                    .then(response => response.json())
                    .then(reservation => {
                        Swal.close();
                        const indexReservation = reservation.findIndex(item => new Date(item.start).toDateString() === new Date(info.dateStr).toDateString());
                        if (indexReservation !== -1) {
                            if (reservation[indexReservation].title === 'Unavailable') {
                                Swal.fire({
                                    title: 'Unavailable',
                                    text: "This date is unavailable, please select another date",
                                    icon: 'warning',
                                    confirmButtonText: 'Ok'
                                })
                            } else {
                                fetch("/controller/client/FetchAmmenities.php", {
                                    method: "GET",
                                    headers: {
                                        "Content-Type": "application/json"
                                    }
                                }).then(res => res.json())
                                    .then(data => {
                                        // get all the amenities name
                                        const ammenities = data.ammenities;
                                        let service_token;
                                        // select ammenities and time from the fetched ammenities
                                        Swal.fire({
                                            title: 'Select Ammenity',
                                            input: 'select',
                                            inputOptions: ammenities.reduce((acc, amenity) => {
                                                acc[amenity.name] = amenity.name;
                                                return acc;
                                            }, {}),
                                            inputPlaceholder: 'Select a service',
                                            showCancelButton: true,
                                            inputValidator: (value) => {
                                                if (!value) {
                                                    return 'You need to select a service'
                                                } else {
                                                    const index = ammenities.findIndex(amenity => amenity.name == value);
                                                    service_token = ammenities[index].services_token;
                                                }
                                            }
                                        }).then((result) => {
                                            // if the user select a service then show the start time and end time availabilities
                                            if (result.value) {
                                                console.log(info.dateStr);
                                                Swal.fire({
                                                    title: 'Please wait...',
                                                    html: 'We are processing your request',
                                                    allowOutsideClick: false,
                                                    showConfirmButton: false,
                                                });
                                                fetch("/controller/client/fetchOccupiedTime.php", {
                                                    method: "POST",
                                                    headers: {
                                                        "Content-Type": "application/json"
                                                    },
                                                    body: JSON.stringify({
                                                        date: info.dateStr,
                                                        ammenity: result.value
                                                    })
                                                }).then(res => res.json())
                                                    .then(data => {
                                                        const occupiedTime = [];
                                                        data.forEach((item) => {
                                                            occupiedTime.push({
                                                            token: `item__${item.reservation_token}`,
                                                            start: item.start,
                                                            end: item.end,
                                                            });
                                                        });
                                                        tempTime.splice(0, tempTime.length);
                                                        occupiedTime.map((item) => {
                                                            let start = new Date(item.start).getHours();
                                                            let end = new Date(item.end).getHours();
                                                            end === 0 ? (end = 24) : end;
                                                            for (let i = start; i < end; i++) {
                                                            tempTime.push(i);
                                                            }
                                                        });
                                                        console.log(tempTime);
                                                        Swal.fire({
                                                            title: 'Select Time',
                                                            html: `
                                                <div class="elem-container">
                                                    <div class="elem-group">
                                                        <div class="elem-item">
                                                            <label for="select-time">Select Time</label>
                                                            <select name="select-time" id="select-time" data-date="${new Date(info.dateStr)}" onchange="selectedTime(this.dataset.date)"required>
                                                                <option value="0">Select Time</option>
                                                                <optgroup label="Morning">
                                                                    ${[...Array(12).keys()].map((item) => {
                                                                        val = `${appendLeadingZeroes(item + 1)}:00`
                                                                        return `<option value="${val}" ${tempTime.includes(appendLeadingZeroes(item + 1))? 'class="unavailable" disabled': ""}>${item + 1}:00 AM</option>`
                                                                    })}
                                                                </optgroup>
                                                                <optgroup label="Afternoon">
                                                                    ${[...Array(5).keys()].map((item) => {
                                                                        val = `${appendLeadingZeroes(item + 12)}:00`
                                                                        return `<option value="${val}" ${tempTime.includes(appendLeadingZeroes(item + 12))? 'class="unavailable" disabled': ""}>${item + 1}:00 PM</option>`
                                                                    })}
                                                                </optgroup>
                                                                <optgroup label="Evening">
                                                                    ${[...Array(7).keys()].map((item) => {
                                                                        val = `${appendLeadingZeroes(item + 17)}:00`
                                                                        return `<option value="${val}" ${tempTime.includes(appendLeadingZeroes(item + 17))? 'class="unavailable" disabled': ""}>${item + 6}:00 PM</option>`
                                                                    })}
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="elem-group">
                                                        <input type="text" name="service-token" value="<?= $row['services_token']?>" hidden required>
                                                        <div class="elem-item select-hours">
                                                            <label for="select-hours">Select Hours</label>
                                                            <select  data-date="${new Date(info.dateStr)}" onchange="selecHoursTime(this.dataset.date)" name="select-hours" id="select-hours" required>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            </select>
                                                        </div>
                                                        <div class="elem-group">
                                                            <div class="elem-item">
                                                            <label for="arrival-time">Arrival</label>
                                                            <input readonly id="arrival-time" placeholder="--:-- --" >
                                                            </div>
                                                            <div class="elem-item">
                                                            <label for="departure-time">Departure</label>
                                                            <input readonly id="departure-time" placeholder="--:-- --" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                `,
                                                           
                                                        confirmButtonText: 'Next',
                                                        focusConfirm: false,
                                                        preConfirm: () => {
                                                            const select_time = document.getElementById('select-time');
                                                            const select_hours = document.getElementById('select-hours');
                                                            const arrival_time = document.getElementById('arrival-time');
                                                            const departure_time = document.getElementById('departure-time');
                                                            if (select_time.value == 0) {
                                                                Swal.showValidationMessage(`Please select time`);
                                                            } else if (select_hours.value == 0) {
                                                                Swal.showValidationMessage(`Please select hours`);
                                                            } else if (arrival_time.value == '') {
                                                                Swal.showValidationMessage(`Please select arrival time`);
                                                            } else if (departure_time.value == '') {
                                                                Swal.showValidationMessage(`Please select departure time`);
                                                            } else {
                                                                return {
                                                                    select_time: select_time.value,
                                                                    select_hours: select_hours.value,
                                                                    arrival_time: arrival_time.value,
                                                                    departure_time: departure_time.value,
                                                                    service_token: service_token
                                                                }
                                                            }
                                                        }
                                                        }).then((result) => {
                                                            console.log(result);
                                                            if (result.isConfirmed) {
                                                                window.location.href = `/pages/book-now.php?service_token=${service_token}&date=${info.dateStr}&start_time=${result.value.arrival_time}&end_time=${result.value.departure_time}&hours=${result.value.select_hours}`;
                                                            }
                                                        });
                                                    })
                                            }
                                        })
                                    })
                            }

                        } else {
                            fetch("/controller/client/FetchAmmenities.php", {
                                method: "GET",
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            }).then(res => res.json())
                                .then(data => {
                                    const ammenities = data.ammenities;
                                    Swal.fire({
                                        title: 'Select Ammenity',
                                        input: 'select',
                                        inputOptions: ammenities.reduce((acc, amenity) => {
                                            acc[amenity.name] = amenity.name;
                                            return acc;
                                        }, {}),
                                        inputPlaceholder: 'Select a service',
                                        showCancelButton: true,
                                        inputValidator: (value) => {
                                            if (!value) {
                                                return 'You need to select a service'
                                            }
                                        }
                                    }).then((result) => {
                                        const index = ammenities.findIndex(amenity => amenity.name == result.value);
                                        const service_token = ammenities[index].services_token;
                                        // choose time in input field
                                        Swal.fire({
                                            title: 'Select Time',
                                            html: `
                                            <div class="elem-container">
                                                <div class="elem-group">
                                                    <div class="elem-item">
                                                        <label for="select-time">Select Time</label>
                                                        <select name="select-time" data-date="${new Date(info.dateStr)}" onchange="selectTime(this.dataset.date)" id="select-time" required>
                                                        <option value="0">Select Time</option>
                                                        <optgroup label="Morning">
                                                            <option value="01:00">1:00 AM</option>
                                                            <option value="02:00">2:00 AM</option>
                                                            <option value="03:00">3:00 AM</option>
                                                            <option value="04:00">4:00 AM</option>
                                                            <option value="05:00">5:00 AM</option>
                                                            <option value="06:00">6:00 AM</option>
                                                            <option value="07:00">7:00 AM</option>
                                                            <option value="08:00">8:00 AM</option>
                                                            <option value="09:00">9:00 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="12:00">12:00 PM</option>
                                                        </optgroup>
                                                        <optgroup label="Afternoon">
                                                            <option value="13:00">1:00 PM</option>
                                                            <option value="14:00">2:00 PM</option>
                                                            <option value="15:00">3:00 PM</option>
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="17:00">5:00 PM</option>
                                                        </optgroup>
                                                        <optgroup label="Evening">
                                                            <option value="18:00">6:00 PM</option>
                                                            <option value="19:00">7:00 PM</option>
                                                            <option value="20:00">8:00 PM</option>
                                                            <option value="21:00">9:00 PM</option>
                                                            <option value="22:00">10:00 PM</option>
                                                            <option value="23:00">11:00 PM</option>
                                                            <option value="24:00">12:00 AM</option>
                                                        </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="elem-group">
                                                    <input type="text" name="service-token" value="<?= $row['services_token']?>" hidden required>
                                                    <div class="elem-item select-hours">
                                                        <label for="select-hours">Select Hours</label>
                                                        <select name="select-hours"  data-date="${new Date(info.dateStr)}" onchange="selecHoursTime(this.dataset.date)" id="select-hours" required>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        </select>
                                                    </div>
                                                    <div class="elem-group">
                                                        <div class="elem-item">
                                                        <label for="arrival-time">Arrival</label>
                                                        <input readonly id="arrival-time" placeholder="--:-- --" >
                                                        </div>
                                                        <div class="elem-item">
                                                        <label for="departure-time">Departure</label>
                                                        <input readonly id="departure-time" placeholder="--:-- --" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    `,
                                            confirmButtonText: 'Next',
                                            focusConfirm: false,
                                            preConfirm: () => {
                                                const select_time = document.getElementById('select-time');
                                                const select_hours = document.getElementById('select-hours');
                                                const arrival_time = document.getElementById('arrival-time');
                                                const departure_time = document.getElementById('departure-time');
                                                if (select_time.value == 0) {
                                                    Swal.showValidationMessage(`Please select time`);
                                                } else if (select_hours.value == 0) {
                                                    Swal.showValidationMessage(`Please select hours`);
                                                } else if (arrival_time.value == '') {
                                                    Swal.showValidationMessage(`Please select arrival time`);
                                                } else if (departure_time.value == '') {
                                                    Swal.showValidationMessage(`Please select departure time`);
                                                } else {
                                                    return {
                                                        select_time: select_time.value,
                                                        select_hours: select_hours.value,
                                                        arrival_time: arrival_time.value,
                                                        departure_time: departure_time.value,
                                                        service_token: service_token
                                                    }
                                                }
                                            }
                                        }).then((result) => {
                                            console.log(result);
                                            if (result.isConfirmed) {
                                                window.location.href = `/pages/book-now.php?service_token=${service_token}&date=${info.dateStr}&start_time=${result.value.arrival_time}&end_time=${result.value.departure_time}&hours=${result.value.select_hours}`;
                                            }
                                        });
                                    })
                                })
                        }
                    })
            }
        }
    });
    calendar.render();
});

// add the responsive classes after page initialization
window.onload = function () {
    $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
};

// add the responsive classes when navigating with calendar buttons
$(document).on('click', '.fc-button', function(e) {
    $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
});

const tempTime = [];
try{
    const checkDatesBtn = document.getElementById('check-dates-btn');
    checkDatesBtn.addEventListener('click', () => {
    
        const calendarEl = document.querySelector('.event-calendar');
        calendarEl.classList.toggle('active');
    
        document.querySelector('body').classList.toggle('show');
    
    });
}catch(err){
    //do nothing
}
// escape key events

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const calendarEl = document.querySelector('.event-calendar');
        calendarEl.classList.toggle('active');
        document.querySelector('body').classList.toggle('show');
    }
});


const selectedTime = (date) => {
    const selTime = document.getElementById('select-time');
    const arrivalTime = document.getElementById("arrival-time");
    const departureTime = document.getElementById("departure-time");
    const selectHours_1 = document.getElementById("select-hours");

    const arrivalDate = new Date(date).toLocaleString('en-US', { year: 'numeric', month: 'numeric', day: 'numeric' });
    const dateArr = arrivalDate.split('/');
    const arrDate = appendLeadingZeroes(dateArr[2]) + '-' + appendLeadingZeroes(dateArr[0]) + '-' + appendLeadingZeroes(dateArr[1]);

    const partialdate = new Date((`${arrDate} ${selTime.value}`));

    arrivalTime.value = formatAMPM(partialdate);
    const arrivalDatefinal = dateFormater(partialdate);
    const selectHoursValue = parseInt(selectHours_1.value);


    partialdate.setTime(partialdate.getTime() + selectHoursValue * 60 * 60 * 1000);
    departureTime.value = formatAMPM(partialdate);
    const departureDateFinal = dateFormater(partialdate);

    const selectTime = document.getElementById("select-time");
    const selectHours = document.getElementById("select-hours");
    const selectedTime = parseInt(selectTime.value);
  
    selectHours.innerHTML = "";
    // loop the tempTime
    searched = false;
    if (tempTime.length > 0) {
    
      tempTime.forEach((time) => {
        if (!searched) {
          
          if (selectedTime < time) {
            console.log("nqek");
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
          }else{
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

    return [arrivalDatefinal, departureDateFinal];
}
const selectTime = async (date) => {
    const selTime = document.getElementById('select-time');
    const arrivalTime = document.getElementById("arrival-time");
    const departureTime = document.getElementById("departure-time");
    const selectHours = document.getElementById("select-hours");

    const arrivalDate = new Date(date).toLocaleString('en-US', { year: 'numeric', month: 'numeric', day: 'numeric' });
    const dateArr = arrivalDate.split('/');
    const arrDate = appendLeadingZeroes(dateArr[2]) + '-' + appendLeadingZeroes(dateArr[0]) + '-' + appendLeadingZeroes(dateArr[1]);

    const partialdate = new Date((`${arrDate} ${selTime.value}`));

    arrivalTime.value = formatAMPM(partialdate);
    const arrivalDatefinal = dateFormater(partialdate);
    const selectHoursValue = parseInt(selectHours.value);


    partialdate.setTime(partialdate.getTime() + selectHoursValue * 60 * 60 * 1000);
    departureTime.value = formatAMPM(partialdate);
    const departureDateFinal = dateFormater(partialdate);

    return [arrivalDatefinal, departureDateFinal];
}


const appendLeadingZeroes = (n) => {
    if (n <= 9) {
        return "0" + n;
    }
    return n
}



const formatAMPM = (date) => {
    const dateObj = new Date(date);
    var hours = dateObj.getHours();
    var minutes = dateObj.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}


const selecHoursTime = (date) => {
    selectTime(date);
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
  