// $(document).ready(() => {
// 	populateCalendar();
// }); 

const calendar  = () => {
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
        editable: true,
        events:'../../../controller/admin_controller/PopulateCalendarController.php',
        selectable:true,
      });
    calendar.render();
  });
}

const reservation = [];

const populateCalendar = async () => {
  try{
    const res = await fetch('../../../controller/admin_controller/PopulateCalendarController.php',{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });
    const data = await res.json();
    console.log(data);

    data.forEach((item) => {
      reservation.push({
        title: item.name,
        start: item.start_datetime,
        end: item.end_datetime
      });
    });
    return data;
  } catch(error){
    console.log(error);
  }
}

calendar();



