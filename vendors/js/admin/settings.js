$(document).ready(() => {
    if (!fetchAnnouncements()) {
        $("#announcement_message").text("No announcements");    
    }
    fetchContacts();
    fetchWebStats();
});

$(document).ready(function(){
    $("#contacts_s_form").on("submit", function(e) {
        e.preventDefault();
        console.log("hello");
        var form_data = new FormData(this);
        $.ajax({
            url: "../../controller/admin_controller/SettingsController.php",
            type: "POST",
            dataType: "JSON",
            processData: false,
            data: form_data,
            contentType: false,
            beforeSend: () => {
                $("#save-contact").html(`${loadSuccessBtn()}`);
            },
            complete: () => {
                $("#cf-cancel-btn").click();
                $("#save-contact").html("Save");
            },
            success: (data) => {
                console.log(data);
                if(data.status){
                    populateContactDetails(data.contact_details.address,
                        data.contact_details.gmap,
                        data.contact_details.phone_number_1,
                        data.contact_details.phone_number_2,
                        data.contact_details.email,
                        data.contact_details.twitter,
                        data.contact_details.facebook,
                        data.contact_details.iframe);
                }else{
                    return false;
                }
            },
            error: (err) => {
                console.log(err);
            }
        });
    });
});


// Update Announcement
$("#ann_sv_btn").click(() => {
    const announcement = $("#announcement_text_area").val();
    if(!announcement == ""){
        $("#announcement_message").load("../../controller/admin_controller/SettingsController.php",{
            message: announcement,
            announcement: true, 
        });
        setTimeout(() => {
            $("#ann_cancel_btn").click();
            $(".modal-message").html(``);
            $("#ann_sv_btn").html("Save");
        }, 1500);
        $("#ann_sv_btn").html(`${loadSuccessBtn()}`);
    }else{
        $(".modal-message").html(`${alertMessage("alert-danger", "Please fill out the field!")}`);
    }
});

$("#shutdown-toggle").change(() => { 
    const toggle = $("#shutdown-toggle").prop("checked");
    shutdownToggle(toggle);
});

const fetchAnnouncements = () => {
    $.ajax({
        url: "../../controller/admin_controller/fetchAnnouncements.php",
        type: "GET",
        dataType: "JSON",
        success: (data) => {
            if(data.status){
                $("#announcement_message").text(`${data.announcement}`);  
                $("#announcement_text_area").val(`${data.announcement}`);  
            }else{
                return false;
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}

const alertMessage = (message, type) => {
    return `<div class="alert ${message} alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">${type}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
}

const loadSuccessBtn = () =>{
    return `
    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    Saving...
    `;
}

const shutdownToggle = (toggle) => {
    $.ajax({
        url: "../../controller/admin_controller/SettingsController.php",
        type: "POST",
        dataType: "JSON",
        data: {
            shutdown: true,
            toggle: toggle
        },
        success: (data) => {
        },
        error: (err) => {
            console.log(err);
        }
    });
}

const fetchWebStats = () => {
    $.ajax({
        url: "../../controller/admin_controller/fetchWebStats.php",
        type: "GET",
        dataType: "JSON",
        success: (data) => {
            if(data.toggle == "1"){
                $("#shutdown-toggle").prop('checked', true);
            }else{
                $("#shutdown-toggle").prop('checked', false);
            }
        }
    })
}

const fetchContacts = () => {
    $.ajax({
        url: "../../controller/admin_controller/fetchContact.php",
        type: "GET",
        dataType: "JSON",
        success: (data) => {
            if(data.status){
                populateContactDetails(data.contact_details.address,
                    data.contact_details.gmap,
                    data.contact_details.phone_number_1,
                    data.contact_details.phone_number_2,
                    data.contact_details.email,
                    data.contact_details.twitter,
                    data.contact_details.facebook,
                    data.contact_details.iframe);
            }else{
                return false;
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}

const populateContactDetails = (address,
    gmap,
    phone_number_1,
    phone_number_2,
    email,
    twitter,
    facebook,
    iframe) => {
    
    $("#address").text(`${address}`);
    $("#gmap").text(`${gmap}`);
    $("#phone_number_1").text(`${phone_number_1}`);
    $("#phone_number_2").text(`${phone_number_2}`);
    $("#email").text(`${email}`);
    $("#twitter").text(`${twitter}`);
    $("#facebook").text(`${facebook}`);
    $("#iframe").attr('src',`${iframe}`);

    $("#address_f").val(`${address}`);
    $("#gmap_f").val(`${gmap}`);
    $("#mn1_f").val(`${phone_number_1}`);
    $("#mn2_f").val(`${phone_number_2}`);
    $("#mail_f").val(`${email}`);
    $("#tw_f").val(`${twitter}`);
    $("#fb_f").val(`${facebook}`);
    $("#iframe-f").val(`${iframe}`);



    
}