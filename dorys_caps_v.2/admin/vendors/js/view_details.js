const clientTable = document.getElementById('profile-data');

const table = new DataTable('#profile-table',{
  paging: true,
  searching: true,
  ordering: true,
  info: true,
  responsive: true,
  dom: 'Bfrtip',
  buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'  
  ]
});


// click message column to view message
const profileTable = document.getElementById('profile-table');

const loadProfile = async () => {
    const profileCard = document.querySelector('.profile-card');
    $token = profileCard.getAttribute('data-token');

    const res = await fetch('/admin/controller/TrackReservation.php',{
        method: 'POST',
        body: JSON.stringify({
            token: $token
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    const data = await res.json();

    if(data.status === 'success'){
        // convert the data to an array
        const clients = Object.values(data.reservation);

        //clear the table
        table.clear();

        // loop through the array and append the data to the table
        clients.forEach((client, index) => {
            table.row.add([
                index,
                client.name,
                client.start_datetime,
                client.end_datetime,
                client.mode_of_payment,
                client.price,
                client.settlement_fee,
                client.status,
                `<p class="view-msg" onclick="viewMessage(this.dataset.msg)" data-msg="${client.message}">View Message</p>`,
                `<button type="button" id="confirm-transact" onclick="confirmTransactionFunc(this.dataset.reservation_token)" title="Confirm" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}"><i class="fa fa-check"></i></button>
                <button type="button" id="cancel-transact" onclick="cancelTransactionFunc(this.dataset.reservation_token)" title="Cancel" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}"><i class="fa fa-times"></i></button>`
            ]).draw(false);
        })
    }else{
        console.log(data.status);
    }

};

loadProfile();


const viewMessage = (msg) => {
    Swal.fire({
        title: 'Message',
        text: msg,
        icon: 'info',
        confirmButtonText: 'Ok'
    })
}