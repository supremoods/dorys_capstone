const clientTable = document.getElementById('client-table');

const table = new DataTable('#client-list',{
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

const loadClients = async () => {

    const res = await fetch('/admin/controller/fetchClients.php',{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })

    const data = await res.json();

    console.log(data)
    if(data.status === 'success'){
        // convert the data to an array
        const clients = Object.values(data.clients);
        const request = Object.values(data.count_request);

        //clear the table
        table.clear();

        // loop through the array and append the data to the table
        clients.forEach((client, index) => {
            table.row.add([
                index,
                client.avatar === null ? `<img class="client-avatar" src="/vendors/images/client/avatar.png">`:`<img class="client-avatar" src="/vendors/images/client/${client.avatar}">`,
                client.fullname,
                client.email,
                client.address === null ? 'N/A' : client.address.replace(`/`, ' '),
                client.number === null ? 'N/A' : client.number,
                request[index].request,
                client.status,
                `
                <div class="action-btns">
                    <button type="button" class="view-client action-btn" id="view-client" onclick="viewClientFunc(this.dataset.client_id)" title="View" data-toggle="tooltip" data-client_id ="${client.user_token}"><i class="fa fa-eye"></i></button>
                    <button type="button" class="delete-client action-btn" id="delete-client" onclick="deleteClientFunc(this.dataset.client_id)" title="Delete" data-toggle="tooltip" data-client_id ="${client.user_token}"><i class="fa  fa-trash-o"></i></button>
                </div>
                `
            ]).draw(false);
        })
    }else{
        console.log(data);
    }
}

loadClients();

const viewClientFunc = (client_id) => { 
    window.location.href = `/admin/dashboard/client/view_details.php?client_id=${client_id}`;
}

const deleteClientFunc = async (client_id) => {
    const res = await fetch('/admin/controller/DeleteClient.php',{
        method: 'POST',
        body: JSON.stringify({
            client_id: client_id
        }),
        headers: {
            'Content-Type': 'application/json'
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
            loadClients();
        })
    }else{
        Swal.fire({
            title: 'Error',
            text: data.message,
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    }
}