$(document).ready(() => {
	populateCalendar();
}); 

document.addEventListener('DOMContentLoaded', () => {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        dayMaxEvents: true, // allow "more" link when too many events
        events: [
            {
              title: 'All Day Event',
              start: '2022-10-08',
            },
            {
              title: 'Long Event',
              start: '2022-10-09 10:00:00',
              end: '2022-10-10 12:00:00',
            },
            {
              groupId: 999,
              title: 'Repeating Event',
              start: '2022-10-25T16:00:00'
            },
            {
              groupId: 999,
              title: 'Repeating Event',
              start: '2022-10-26T16:00:00'
            },

          ]
      });
    calendar.render();
});


const populateCalendar = () => {
    // $.ajax({
    //     url: "../../../controller/admin_controller/PopulateCalendarController.php",
    //     type: "POST",
    //     beforeSend: () => {
    //       // $("#add-service").html(`${loadSuccessBtn('adding...')}`);
    //   },
    //   complete: () => {
    //     alert('sd');
    //   },
    //     success: (data) => {
    //         alert('sd');
    //         console.log(data);
    //     },
    //     error:  (request, status, error) => {
    //       console.log(request.responseText);
    //   } 
    // });

    fetch('../../../controller/admin_controller/PopulateCalendarController.php').then((res) => res.json()).then(response =>{
        console.log(response);  
    }).catch((error)=>{
        console.log(error);
    });


}


