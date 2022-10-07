$(document).ready(()=>{
    $("#reservation_form").on("submit", function(e){
        e.preventDefault();
        var form_data = new FormData(this); 
        $.ajax({
            url:"controller/client_controller/ReservationController.php",
            type:"POST",    
            dataType:"JSON",
            processData:false,
            data:form_data,
            contentType:false,
            beforeSend:()=>{
                $("#reservation-btn").html(`${loadSuccessBtn('reserving...')}`);
            },
            complete:()=>{
                $("#reservation-btn").html("Reserved");     
            },
            success:(data)=>{   
                if(data.status){
                    console.log(data);
                    $("#reservation-btn").html("Reserved");
                    emptyForm();
                    loadReservation();
                }else{
                    return false;
                }
            },
        });
    });
})