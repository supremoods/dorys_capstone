const table = new DataTable('#transact-list',{
    paging: true,
    searching: true,
    ordering: true,
    info: true,
    responsive: true,
    dom: 'Bfrtip'
});

const token = document.querySelector('.ammenity-trans-list').getAttribute('data-ammenity');

const loadAmmenityTransaction = async (token) => {
    const response = await fetch(`/admin/controller/fetchAmmenityTransaction.php`,{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            token: token    
        })
    });

    const data = await response.json();

    if(data.status === 'success'){
        const transactions = Object.values(data.ammenities);

        const ammenity_rate = transactions[0].price;

        document.querySelector(".ammenity-rate").innerHTML =  `₱ ${ammenity_rate}`; 
        let actionBtns = '';

        table.clear();
        transactions.forEach((transaction, index) => {
            if(transaction.status === 'pending'){
                actionBtns = `
                <button type="button" class="confirm-transact action-btn" onclick="confirmTransactionFunc(this.dataset.reservation_token, this.dataset.user_token)" title="Confirm" data-toggle="tooltip" data-user_token="${transaction.user_token}" data-reservation_token ="${transaction.reservation_token}">Confirm</button>
                <button type="button" class="cancel-transact action-btn" onclick="cancelTransactionFunc(this.dataset.reservation_token)" title="Cancel" data-toggle="tooltip" data-reservation_token ="${transaction.reservation_token}">Decline</button>
                `;
            }else if(transaction.status === 'cancelled'){
                actionBtns = `
                <button type="button" class="confirm-transact action-btn" onclick="undoTransactionFunc(this.dataset.reservation_token)" title="Revert" data-toggle="tooltip" data-reservation_token ="${transaction.reservation_token}">Revert</button>
                <button type="button" class="cancel-transact action-btn" onclick="deleteTransactionFunc(this.dataset.reservation_token)" title="Delete" data-toggle="tooltip" data-reservation_token ="${transaction.reservation_token}">Delete</button>
                `
            }else if(transaction.status === 'confirmed'){
                actionBtns = `
                <button type="button" class="cancel-transact action-btn" onclick="deleteTransactionFunc(this.dataset.reservation_token)" title="Delete" data-toggle="tooltip" data-reservation_token ="${transaction.reservation_token}">Delete</button>
                `
            }
            table.row.add([
                index,
                transaction.reservation_token,
                transaction.start_datetime,
                transaction.end_datetime,
                transaction.mode_of_payment,
                transaction.settlement_fee,
                transaction.status,
                `
                <div class="action-btns">
                    <button class="view-msg" onclick="viewMessage(this.dataset.msg)" data-msg="${transaction.message}">View Message</button>
                </div>
                `,
                    
                `
                <div class="action-btns">
                    <button type="button" class="view-profile action-btn" onclick="viewProfile(this.dataset.user_token)" title="View Profile" data-toggle="tooltip" data-user_token ="${transaction.user_token}"><i class="fa fa-user"></i></button>
                </div>
                `,
                transaction.gcash_ref_num,
                transaction.payment_type,
     
                `
                <div class="action-btns">
                    ${actionBtns}
                </div>
                `
            ]).draw(false);
        })
    }else{
        table.clear();
        table.draw();
        console.log(data.status);
    }
}

loadAmmenityTransaction(token);

const viewMessage = (msg) => {  

    Swal.fire({
        title: 'Message',
        text: msg,
        icon: 'info',
        confirmButtonText: 'Ok'
    })
}



const viewProfile = async (token) => {
    const res = await fetch('/admin/controller/fetchClientDetails.php',{
        method: 'POST',
        body: JSON.stringify({
            token: token
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const data = await res.json();

    if(data.status === 'success'){
        const client = data.client;

        Swal.fire({
            title: 'Client Details',
            html: `
                <div class="client-details">
                    <div class="client-details__avatar">
                        <img src="/public/images/client/${client.avatar}" alt="client image" class="client-details__img">
                    </div>
                    <div class="client-details__info">
                        <div class="client-details__item">
                            <span class="client-details__label">Usert Token:</span>
                            <span class="client-details__value">${client.user_token}</span>
                        </div>
                        <div class="client-details__item">
                            <span class="client-details__label">Name:</span>
                            <span class="client-details__value">${client.fullname}</span>
                        </div>
                        <div class="client-details__item">
                            <span class="client-details__label">Email:</span>
                            <span class="client-details__value">${client.email}</span>
                        </div>
                        <div class="client-details__item">
                            <span class="client-details__label">Contact Number:</span>
                            <span class="client-details__value">${client.number}</span>
                        </div>
                        <div class="client-details__item">
                            <span class="client-details__label">Address:</span>
                            <span class="client-details__value">${client.address}</span>
                        </div>
                    </div>
                </div>
            `,
            confirmButtonText: 'Ok'
        })
    }else{
        console.log(data.status);
    }

}

const confirmTransactionFunc = async (reservationToken, user_token) => {
    const response = await fetch('/admin/controller/ConfirmTransaction.php',{
        method: 'POST',
        body: JSON.stringify({
            token: reservationToken
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })

    const data = await response.json();

    if(data.status === 'success'){
        console.log(data);
        Swal.fire({
            title: 'Success',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(() => {
            const token = document.querySelector('.ammenity-trans-list').getAttribute('data-ammenity');
            fetch('/admin/controller/SMSFetchInfo.php',{
                method: 'POST',
                body: JSON.stringify({
                    token: reservationToken,
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

            loadAmmenityTransaction(token);

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
            const token = document.querySelector('.ammenity-trans-list').getAttribute('data-ammenity');
            loadAmmenityTransaction(token);
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
            const token = document.querySelector('.ammenity-trans-list').getAttribute('data-ammenity');
            loadAmmenityTransaction(token);
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
            const token = document.querySelector('.ammenity-trans-list').getAttribute('data-ammenity');
            loadAmmenityTransaction(token);
        })
    }else{
        console.log(data.status);
    }
}