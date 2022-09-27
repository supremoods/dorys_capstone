$(document).ready(()=>{
    fetchAnnouncements();
}); 

const fetchAnnouncements = () => {
    $.ajax({
        url: "controller/admin_controller/fetchAnnouncements.php",
        type: "GET",
        dataType: "JSON",
        success: (data) => {
            if(data.status){
                console.log(data);
                $(".announcement-message").text(`${data.announcement}`);  
            }else{
                return false;
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}