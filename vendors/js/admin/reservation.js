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
              start: '2022-10-09T10:00:00',
              end: '2022-10-10T12:00:00',
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


