document.addEventListener("DOMContentLoaded", () => {
  const calendarEl = document.getElementById("calendar");

  const calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
    },
    height: 650,
    events: "/admin/controller/PopulateCalendar.php",

    eventClick: (info) => {
      info.jsEvent.preventDefault();

      info.el.style.borderColor = "red";

      if (info.event.title === "Unavailable") {
        Swal.fire({
          title: info.event.title,
          text: "This date is unavailable, do you want to make it available?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, make it available!",
        }).then((result) => {
          if (result.isConfirmed) {
            const dateId = info.event.id;

            const availableAppointment = async (dateId) => {
              const res = await fetch(
                "/admin/controller/AvailableAppointment.php",
                {
                  method: "POST",
                  body: JSON.stringify({
                    dateId: dateId,
                  }),
                  headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                  },
                }
              );

              const data = await res.json();

              if (data.status === "success") {
                Swal.fire({
                  title: "Available",
                  text: "The date has been made available",
                  icon: "success",
                  confirmButtonText: "Ok",
                }).then(() => {
                  calendar.refetchEvents();
                });
              } else {
                console.log(data);
              }
            };
            availableAppointment(dateId);
          } else {
            Swal.fire("Cancelled", "The date is still unavailable.", "error");
          }
        });
      } else {
        Swal.fire({
          title: info.event.title,
          text: "reserved",
        });
      }
    },
    dateClick: (info) => {
      info.jsEvent.preventDefault();
      // create swal form for reservation
      if (info.dateStr < new Date().toISOString().split("T")[0]) {
        Swal.fire({
          title: "Unavailable",
          text: "This date is unavailable, please select another date",
          icon: "warning",
          confirmButtonText: "Ok",
        });
      } else {
        Swal.fire({
          title: "Please wait...",
          html: "We are processing your request",
          allowOutsideClick: false,
          showConfirmButton: false,
        });
        fetch("/admin/controller/PopulateCalendar.php")
          .then((response) => response.json())
          .then((reservation) => {
            Swal.close();
            // // check if the date is equal and get the index
            const indexReservation = reservation.findIndex(
              (item) =>
                new Date(item.start).toDateString() ===
                new Date(info.dateStr).toDateString()
            );
            /// check if index is not -1
            if (indexReservation !== -1) {
              if (reservation[indexReservation].title === "Unavailable") {
                Swal.fire({
                    title: 'Unavailable',
                    text: "This date is unavailable, do you want to make it available?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, make it available!",
                  }).then((result) => {
                    if (result.isConfirmed) {
                        const dateId = reservation[indexReservation].id;
                
                        const availableAppointment = async (dateId) => {
                            const res = await fetch(
                            "/admin/controller/AvailableAppointment.php",
                            {
                                method: "POST",
                                body: JSON.stringify({
                                dateId: dateId,
                                }),
                                headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                },
                            }
                            );
                
                            const data = await res.json();
                
                            if (data.status === "success") {
                            Swal.fire({
                                title: "Available",
                                text: "The date has been made available",
                                icon: "success",
                                confirmButtonText: "Ok",
                            }).then(() => {
                                calendar.refetchEvents();
                            });
                            } else {
                            console.log(data);
                            }
                        };
                        availableAppointment(dateId);   
                    }
                });
              } else {
                Swal.fire({
                  title: "disable reservation for this date?",
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  denyButtonText: `No`,
                }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                    const date = info.dateStr;
                    // send date to php
                    const disableAppointment = async (date_) => {
                      const res = await fetch(
                        "/admin/controller/DisableAppointment.php",
                        {
                          method: "POST",
                          body: JSON.stringify({
                            date: date_,
                          }),
                          headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                          },
                        }
                      );

                      const data = await res.json();

                      if (data.status === "success") {
                        Swal.fire({
                          title: "Success",
                          text: "Appointment disabled",
                          icon: "success",
                          confirmButtonText: "Ok",
                        }).then(() => {
                          calendar.refetchEvents();
                        });
                      } else {
                        console.log(data);
                      }
                    };
                    disableAppointment(date);
                  } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                  }
                });
              }
            }else{
                Swal.fire({
                    title: "disable reservation for this date?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `No`,
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                      const date = info.dateStr;
                      // send date to php
                      const disableAppointment = async (date_) => {
                        const res = await fetch(
                          "/admin/controller/DisableAppointment.php",
                          {
                            method: "POST",
                            body: JSON.stringify({
                              date: date_,
                            }),
                            headers: {
                              "Content-Type": "application/json",
                              Accept: "application/json",
                            },
                          }
                        );
  
                        const data = await res.json();
  
                        if (data.status === "success") {
                          Swal.fire({
                            title: "Success",
                            text: "Appointment disabled",
                            icon: "success",
                            confirmButtonText: "Ok",
                          }).then(() => {
                            calendar.refetchEvents();
                          });
                        } else {
                          console.log(data);
                        }
                      };
                      disableAppointment(date);
                    } else if (result.isDenied) {
                      Swal.fire("Changes are not saved", "", "info");
                    }
                  });
            }
          });
      }
    },
  });

  calendar.render();
});
