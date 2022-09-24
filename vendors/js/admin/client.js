$(document).ready(()=>{
    // Code here
    $(".load-clients").load("../../controller/admin_controller/load_Element/LoadClients.php");
}); 



const ViewDetails = (id) => {
    window.location.href = `../../admin/dashboard/client/Details.php?client_token=${id}`;
}