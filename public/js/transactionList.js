const myTransaction = new Object(
    {
        reservation_token: '',
        name: '',
        start_datetime: '',
        end_datetime: '',
        mode_of_payment: '',
        settlement_fee: '',
        status: ''
    }
);

const transactTable =  document.getElementById('transact-table');

const table = new DataTable('#transaction-list',{
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

const loadTransactions = async () => {
        const res = await fetch('/controller/client/FetchTransactionList.php',{
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })

        const data = await res.json();

        if(data.status === 'success'){
            // convert the data to an array
            const transactions = Object.values(data.transact);
            
            //clear the table
            table.clear();

            // check if date is past 3 days
            const checkDate = (date) => {
                const today = new Date();

                const date1 = new Date(date);
                const date2 = new Date(today.getFullYear(), today.getMonth(), today.getDate());

                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if(diffDays > 3){
                    return false;
                }else{
                    return true;
                }
            }

            // loop through the array and append the data to the table
            transactions.forEach((transaction) => {
                table.row.add([
                    transaction.reservation_token,
                    transaction.name,
                    new Date(transaction.start_datetime).toLocaleString(),
                    new Date(transaction.end_datetime).toLocaleString(),
                    transaction.mode_of_payment,
                    `₱ ${transaction.price}`,
                    `₱ ${transaction.settlement_fee}`,
                    transaction.gcash_ref_num,
                    transaction.payment_type,
                    transaction.paid_amount,
                    transaction.status,
                    transaction.date_created,
                    `
                    ${checkDate(transaction.date_created) ? '<button type="button" id="edit-transact" onclick="editTransactionFunc(this.dataset.reservation_token)" title="Edit" data-toggle="tooltip" data-reservation_token ='+ transaction.reservation_token +'><i class="fa fa-pencil"></i></button>' : ''}
                    <button  type="button" id="delete-transact" onclick="deleteTransactionFunc(this.dataset.reservation_token)" title="Delete" data-toggle="tooltip" data-reservation_token ="${transaction.reservation_token}"><i class="fa  fa-trash-o"></i></button>`
                ]).draw(false);
            })
        }else{
            console.log(data.status);
        }
}


loadTransactions();

const editTransactionFunc = (reservation_token) => {
    window.location.href = `/pages/updateTransaction.php?reservation_token=${reservation_token}`;
};


const deleteTransactionFunc = async (reservation_token) => {
    const res = await fetch('/controller/client/DeleteTransaction.php',{
        method: 'POST',
        body: JSON.stringify({
            reservation_token:reservation_token
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    const data = await res.json();
    if(data.status === 'success'){
        Swal.fire({
            title: "Success!",
            text: "Transaction has been deleted",
            icon: "success",
            confirmButtonText: "Okay",
        });
        loadTransactions();
    }else{
        Swal.fire({
            title: "Failed!",
            text: "Failed to delete transaction",
            icon: "error",
            confirmButtonText: "Okay",
        });
    }

}