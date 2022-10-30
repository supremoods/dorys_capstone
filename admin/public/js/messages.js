const table = new DataTable('#message-list',{
    paging: true,
    searching: true,
    ordering: true,
    info: true,
    responsive: true,
    dom: 'Bfrtip'
});



const FetchMessages = async () => {
    Swal.fire({
        title: 'Please wait...',
        html: 'We are processing your request',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });
    const response = await fetch(`/admin/controller/FetchMessages.php`,{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });

    const data = await response.json();

    if(data.status === 'success'){
        Swal.close();
        const messages = data.messages;

        // clear the table
        table.clear();

        messages.forEach((message,index) => {
            table.row.add([
                index,
                message.email,
                message.phone,
                message.message,
                message.timeStamp,
                `
                    <button class="action-btn delete-btn" onclick="deleteMessage(this.dataset.message_id)" data-message_id="${message.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                `
            ]).draw(false);
        });

        table.draw();
    }else if(data.status === 'failed'){
        Swal.close();
        table.clear();
        table.draw();
    }
}


FetchMessages();

const deleteMessage =  (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Please wait...',
                html: 'We are processing your request',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            const response = await fetch(`/admin/controller/DeleteMessage.php`,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            });
            const data = await response.json();
            if(data.status === 'success'){
                Swal.close();
                FetchMessages();
            }
        }else{
            console.log('cancelled');
        }
    })

}