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
            // check if the data is available
            
            // check if the date is in the past
            if(info.dateStr < new Date().toISOString().split('T')[0]){
                Swal.fire({
                    title: 'Unavailable',
                    text: "This date is unavailable, please select another date",
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }else{
                // check if the date is available

                fetch('/controller/client/PopulateCalendar.php')
                .then(response => response.json())
                .then(reservation => {
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
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You want to reserve this date?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, reserve it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // fetch ammenities
                                    fetch("/controller/client/FetchAmmenities.php", {
                                        method: "GET",
                                        headers: {
                                            "Content-Type": "application/json"
                                        }
                                    }).then(res => res.json())
                                        .then(data => {
                                            if (data.status === "success") {
                                                const ammenities = data.ammenities;
                
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
                                                        // fetch the service token of the selected ammenity
                                                        const index = ammenities.findIndex(amenity => amenity.name == value);
                                                        const service_token = ammenities[index].services_token;
                
                                                        // choose time available
                                                        
                                                        const start_time = new Date(reservation[indexReservation].start).toLocaleTimeString();
                                                        const end_time = new Date(reservation[indexReservation].end).toLocaleTimeString();

                                                        // compute the time available within that day
                                                        const timeAvailable = [];

                                                        for(let i = new Date(reservation[indexReservation].start); i < new Date(reservation[indexReservation].end); i.setMinutes(i.getMinutes() + 30)){
                                                            timeAvailable.push(i.toLocaleTimeString());
                                                        }
                                                        
                                                        Swal.fire({
                                                            title: 'Select Time',
                                                            input: 'select',
                                                            inputOptions: timeAvailable.reduce((acc, time) => {
                                                                acc[time] = time;
                                                                return acc;
                                                            }, {}),
                                                            inputPlaceholder: 'Select a time',
                                                            showCancelButton: true,
                                                            inputValidator: (value) => {
                                                                window.location.href = `/controller/client/Reserve.php?date=${info.dateStr}&time=${value}&service_token=${service_token}`;
                                                            }
                                                        })


                                                        // Swal.fire({
                                                        //     title: 'Select Time',
                                                        //     html: `
                                                        //         <input type="time" id="swal-input1" class="swal2-input">
                                                        //         <input type="time" id="swal-input2" class="swal2-input">
                                                        //     `,
                                                        //     focusConfirm: false,
                                                        //     preConfirm: () => {
                                                        //         return [
                                                        //             document.getElementById('swal-input1').value,
                                                        //             document.getElementById('swal-input2').value
                                                        //         ];
                                                        //     }
                                                        // }).then((result) => {
                                                        //     if (result.isConfirmed) {
                                                        //         window.location.href = `/pages/book-now.php?service_token=${service_token}&date=${info.dateStr}&start_time=${result.value[0]}&end_time=${result.value[1]}`;
                
                                                        //     }
                                                        // });
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        Swal.fire({
                                                            'ok': 'ok'
                                                        });
                                                    }
                                                });
                
                                            } else {
                                                Swal.fire({
                                                    title: "Failed!",
                                                    text: "Failed to fetch ammenities",
                                                    icon: "error",
                                                    confirmButtonText: "Okay",
                                                });
                                            }
                                        }
                                        );
                                }
                            })
                            
                        }
                    }else{
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to reserve this date?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, reserve it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // fetch ammenities
                                fetch("/controller/client/FetchAmmenities.php", {
                                    method: "GET",
                                    headers: {
                                        "Content-Type": "application/json"
                                    }
                                }).then(res => res.json())
                                    .then(data => {
                                        if (data.status === "success") {
                                            const ammenities = data.ammenities;
            
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
                                                    // fetch the service token of the selected ammenity
                                                    const index = ammenities.findIndex(amenity => amenity.name == value);
                                                    const service_token = ammenities[index].services_token;
            
                                                    // choose time in input field
                                                    Swal.fire({
                                                        title: 'Select Time',
                                                        html: `
                                                            <input type="time" id="swal-input1" class="swal2-input">
                                                            <input type="time" id="swal-input2" class="swal2-input">
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
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire({
                                                        'ok': 'ok'
                                                    });
                                                }
                                            });
            
                                        } else {
                                            Swal.fire({
                                                title: "Failed!",
                                                text: "Failed to fetch ammenities",
                                                icon: "error",
                                                confirmButtonText: "Okay",
                                            });
                                        }
                                    }
                                    );
                            }
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