// fetch announcements
const fetchAnnouncements = () => {
    $.ajax({
        url: "../../controller/admin_controller/fetchAnnouncements.php",
        type: "GET",
        dataType: "JSON",
        success: (data) => {
            console.log(data);
            if(data.status){
                return data.announcements;
            }else{
                return false;
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}

$(document).ready(() => {
    if (fetchAnnouncements()) {
        // do something
        $("#announcement_message").text(fetchAnnouncements());
        $("announcement_text_area").text(fetchAnnouncements());
    }else{
        $("#announcement_message").text("No announcements");    
    }
});


// Update Announcement
$("#ann_sv_btn").click(() => {
    const announcement = $("#announcement_text_area").val();
    if(!announcement == ""){
        $("#ann_sv_btn").attr("data-bs-dismiss", "modal");
        $("#message").load("../../controller/admin_controller/SettingsController.php",{
            message: announcement,
            announcement: true
        })
    }else{
        $(".modal-message").prepend(`${alertMessage("alert-danger", "Please fill out the field!")}`);
    }
});

const alertMessage = (message, type) => {
    return `<div class="alert ${message} alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">${type}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
}

