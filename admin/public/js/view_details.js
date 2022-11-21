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
        let actionBtns = '';
        //clear the table
        table.clear();

        // loop through the array and append the data to the table
        clients.forEach((client, index) => {
            if(client.status === 'pending'){
                actionBtns = `
                <button type="button" class="confirm-transact action-btn" onclick="confirmTransactionFunc(this.dataset.reservation_token)" title="Confirm" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}">Confirm</button>
                <button type="button" class="cancel-transact action-btn" onclick="cancelTransactionFunc(this.dataset.reservation_token)" title="Cancel" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}">Decline</button>
                `;
            }else if(client.status === 'cancelled'){
                actionBtns = `
                <button type="button" class="confirm-transact action-btn" onclick="undoTransactionFunc(this.dataset.reservation_token)" title="Revert" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}">Revert</button>
                <button type="button" class="cancel-transact action-btn" onclick="deleteTransactionFunc(this.dataset.reservation_token)" title="Delete" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}">Delete</button>
                `
            }else if(client.status === 'confirmed'){
                actionBtns = `
                <button type="button" class="cancel-transact action-btn" onclick="deleteTransactionFunc(this.dataset.reservation_token)" title="Delete" data-toggle="tooltip" data-reservation_token ="${client.reservation_token}">Delete</button>
                `
            }
            table.row.add([
                index,
                client.name,
                client.start_datetime,
                client.end_datetime,
                client.mode_of_payment,
                client.price,
                client.settlement_fee,
                client.status,
                client.gcash_ref_num,
                client.payment_type,
                `<p class="view-msg" onclick="viewMessage(this.dataset.msg)" data-msg="${client.message}">View Message</p>`,
                `
                <div class="action-btns">
                    ${actionBtns}
                </div>
                `
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



const confirmTransactionFunc = async (token) => {
    const response = await fetch('/admin/controller/ConfirmTransaction.php',{
        method: 'POST',
        body: JSON.stringify({
            token: token
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    const data = await response.json();

    if(data.status === 'success'){
        Swal.fire({
            title: 'Success',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(() => {
            const profileCard = document.querySelector('.profile-card');
            const user_token = profileCard.getAttribute('data-token');
            fetch('/admin/controller/SMSFetchInfo.php',{
                method: 'POST',
                body: JSON.stringify({
                    token: token,
                    user_token: user_token
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
            .then(data => {
                if(data.status === 'success'){
                    console.log(data);
                    const info = data.info;
                    console.log(info[0].api_key);
                    const message = `Hi ${info.fullname}, your reservation for ${info.name} has been confirmed. Thank you for choosing us!`;
                    fetch('https://textbelt.com/text', {
                        method: 'post',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            phone: `+63${parseInt(info.number)}`,
                            message: message,
                            key: info[0].api_key
                        }),
                        }).then(response => {
                        return response.json();
                        }).then(data => {
                        console.log(data);
                        });
                }else{
                    console.log(data.status);
                }
            })
            loadProfile()
        })
    }else{
        console.log(data.status);
    }
}

const cancelTransactionFunc = async (token) => {
    const res = await fetch('/admin/controller/CancelTransaction.php',{
        method: 'POST',
        body: JSON.stringify({
            token: token
        }),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();
    console.log(data.status);

    if(data.status === "success"){
        Swal.fire({
            title: 'Success',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(() => {
            loadProfile()
        })
    }else{
        console.log(data.status);
    }
}

const undoTransactionFunc = async (token) => {
    const res = await fetch('/admin/controller/UndoTransaction.php',{
        method: 'POST',
        body: JSON.stringify({
            token: token
        }),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();

    if(data.status === 'success'){
        Swal.fire({
            title: 'Success',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(() => {
            loadProfile()
        })
    }else{
        console.log(data.status);
    }
}

const deleteTransactionFunc = async (token) => {
    const res = await fetch('/admin/controller/DeleteTransaction.php',{
        method: 'POST',
        body: JSON.stringify({
            token: token
        }),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();

    if(data.status === 'success'){
        Swal.fire({
            title: 'Success',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(() => {
            loadProfile()
        })
    }else{
        console.log(data.status);
    }
}