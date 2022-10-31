document.addEventListener('DOMContentLoaded', () => {

    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        height:650,
        events:'/controller/client/PopulateCalendar.php',

        eventClick: (info) =>{
            info.jsEvent.preventDefault();

            info.el.style.borderColor = 'red';
            if(info.event.title === 'Unavailable'){
                Swal.fire({
                    title: info.event.title,
                    text: "This date is unavailable, please select another date",
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
                
            }else{
                Swal.fire({
                    title: info.event.title,
                    text: "reserved",
                })
            } 

        },
        dateClick: (info) => {
            info.jsEvent.preventDefault();
            
            // check if the date is in the past
            if(info.dateStr < new Date().toISOString().split('T')[0]){
                Swal.fire({
                    title: 'Unavailable',
                    text: "This date is unavailable, please select another date",
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }else{
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
                    // // check if the date is equal and get the index
                    const indexReservation = reservation.findIndex(item => new Date(item.start).toDateString()  === new Date(info.dateStr).toDateString());
                    /// check if index is not -1
                    if(indexReservation !== -1){

                        if(reservation[indexReservation].title === 'Unavailable'){
                            Swal.fire({
                                title: 'Unavailable',
                                text: "This date is unavailable, please select another date",
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            })
                        }else{
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
                                    title: 'Select Ammenities',
                                    input: 'select',
                                    inputOptions: ammenities.reduce((acc, amenity) => {
                                        acc[amenity.name] = amenity.name;
                                        return acc;
                                    }, {}),
                                    inputPlaceholder: 'Select a service',
                                    showCancelButton: true,
                                    inputValidator: (value) => {
                                        if(!value){
                                            return 'You need to select a service'
                                        }else{
                                            const index = ammenities.findIndex(amenity => amenity.name == value);
                                            service_token = ammenities[index].services_token;
                                        }
                                    }
                                }).then((result) => {
                                    // if the user select a service then show the start time and end time availabilities
                                    if(result.value){
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
                                            Swal.fire({
                                                title: 'Select Time',
                                                html: `
                                                    <div class="time-list">
                                                        <h4>Occupied</h4>
                                                        <ul class="occupied">
                                                            ${data.map(time => `<li>${new Date(time.start).toLocaleTimeString()} - ${new Date(time.end).toLocaleTimeString()}</li>`).join('')}
                                                        </ul>
                                                    </div>
                                                    <hr class="breaker">
                                                    <div class="time-group">
                                                        <div class="input-group">
                                                            <label for="start-time">Start Time</label>
                                                            <input type="time" id="swal-input1" class="swal2-input">
                                                        </div>
                                                        <div class="input-group">
                                                            <label for="end-time">End Time</label>
                                                            <input type="time" id="swal-input2" class="swal2-input">
                                                        </div>
                                                    </div>
                                                `,
                                                focusConfirm: false,
                                                preConfirm: () => {
                                                    return [
                                                        document.getElementById('swal-input1').value,
                                                        document.getElementById('swal-input2').value
                                                    ];
                                                }
                                            }).then((result) => {
                                                // check if the start time is greater than fetch time

                                                data.map(time => {
                                                    const startTime = new Date(`${info.dateStr} ${result.value[0]}`);
                                                    console.log(new Date(time.start).toLocaleTimeString());
                                                    console.log(startTime.toLocaleTimeString());
        
                                                    if(startTime.getTime() > new Date(time.start).getTime() &&  startTime.getTime() < new Date(time.end).getTime()){
                                                        Swal.fire({
                                                            title: 'Unavailable',
                                                            text: "This time is unavailable, please select another time",
                                                            icon: 'warning',
                                                            confirmButtonText: 'Ok'
                                                        })
                                                    }else{
                                                        Swal.fire({
                                                            title: 'Please wait...',
                                                            html: 'We are processing your request',
                                                            allowOutsideClick: false,
                                                            showConfirmButton: false,
                                                        });
                                                        window.location.href = `/pages/book-now.php?service_token=${service_token}&date=${info.dateStr}&start_time=${result.value[0]}&end_time=${result.value[1]}`;
                                                    }
                                                })
                                            })
                                        })
                                    }
                                })
                            })
                        }

                    }else{
                        fetch("/controller/client/FetchAmmenities.php", {
                            method: "GET",
                            headers: {
                                "Content-Type": "application/json"
                            }
                        }).then(res => res.json())
                        .then(data => {
                            const ammenities = data.ammenities;
                            Swal.fire({
                                title: 'Select Ammenities',
                                input: 'select',
                                inputOptions: ammenities.reduce((acc, amenity) => {
                                    acc[amenity.name] = amenity.name;
                                    return acc;
                                }, {}),
                                inputPlaceholder: 'Select a service',
                                showCancelButton: true,
                                inputValidator: (value) => {
                                    if(!value){
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
                                        <div class="time-group">
                                            <div class="input-group">
                                                <label for="start-time">Start Time</label>
                                                <input type="time" id="swal-input1" class="swal2-input">
                                            </div>
                                            <div class="input-group">
                                                <label for="end-time">End Time</label>
                                                <input type="time" id="swal-input2" class="swal2-input">
                                            </div>
                                        </div>
                                    `,
                                    focusConfirm: false,
                                    preConfirm: () => {
                                        return [
                                            document.getElementById('swal-input1').value,
                                            document.getElementById('swal-input2').value
                                        ];
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = `/pages/book-now.php?service_token=${service_token}&date=${info.dateStr}&start_time=${result.value[0]}&end_time=${result.value[1]}`;
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

const checkDatesBtn = document.getElementById('check-dates-btn');

checkDatesBtn.addEventListener('click', () => {

    const calendarEl = document.querySelector('.event-calendar');
    calendarEl.classList.toggle('active');
    
    document.querySelector('body').classList.toggle('show');    

});

// escape key events

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const calendarEl = document.querySelector('.event-calendar');
        calendarEl.classList.toggle('active');
        document.querySelector('body').classList.toggle('show');    
    }
});