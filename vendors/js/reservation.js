$(document).ready(()=>{
    $("#reservation_form").on("submit", function(e){
        e.preventDefault();
        var form_data = new FormData(this); 
        $.ajax({
            url:"../controller/client_controller/ReservationController.php",
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
                if(data.status = "success"){
                    window.location.href = "/pages/services.php";
                }else{
                   alert(`there's something wrong`);
                }
            },
        });
    });
})



const loadSuccessBtn = (message) => {
	return `
    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    ${message}
    `;
}

