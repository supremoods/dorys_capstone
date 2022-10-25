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

    if(data.status === 'success'){
        // convert the data to an array
        const clients = Object.values(data.clients);

        //clear the table
        table.clear();

        // loop through the array and append the data to the table
        clients.forEach((client, index) => {
            table.row.add([
                index,
                `<img class="client-avatar" src="/vendors/images/client/${client.avatar}">`,
                client.fullname,
                client.email,
                client.address.replace(/[^\w\s]/gi, ' '),
                client.number,
                client.request,
                client.status,
                `<button type="button" class="action-btn" id="view-client" onclick="viewClientFunc(this.dataset.client_id)" title="View" data-toggle="tooltip" data-client_id ="${client.user_token}"><i class="fa fa-eye"></i></button>
                <button type="button" class="action-btn" id="delete-client" onclick="deleteClientFunc(this.dataset.client_id)" title="Delete" data-toggle="tooltip" data-client_id ="${client.user_token}"><i class="fa  fa-trash-o"></i></button>`
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



