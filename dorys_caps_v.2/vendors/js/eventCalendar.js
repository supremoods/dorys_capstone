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

            Swal.fire({
                title: info.event.title,
                text: "reserved",
            })
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