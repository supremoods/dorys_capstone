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




function getHoursDiff(startDate, endDate) {
    const msInHour = 1000 * 60 * 60;
  
    return Math.round(
      Math.abs(endDate.getTime() - startDate.getTime()) / msInHour,
    );
  }

  //a simple date formatting function
function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}

// check if startDate and endDate is not empty

const checkDateifEmpty = (startDate, endDate) => {
    
    if(startDate != "" && endDate != ""){
        number_of_hours = getHoursDiff(new Date($("#dateStart").val()), new Date($("#dateEnd").val()));
        rate = $("#settlement_fee").val();

        $("#settlement_fee").val(number_of_hours * rate);
    }

}


// check if startDate and endDate is changed
$("#dateEnd").change(function(){

    checkDateifEmpty($("#dateStart").val(), $("#dateEnd").val());
});