const loadReservationClient = () => {
	$(".load-reservation").load("../../../controller/admin_controller/load_Element/loadReservation.php",{
        client_token: $("#client-token").attr('data-token')
    });
}


$(document).ready(() => {
	loadReservationClient();
}); 


const confirmReservation = (reservation_token) => {
    $.ajax({
        url: "../../../controller/admin_controller/ReservationAction.php",
        type: "POST",
        dataType: "JSON",
        data: {
            reservation_token: reservation_token,
            action: "confirm"
        },
        beforeSend: () => {
            // $("#add-service").html(`${loadSuccessBtn('adding...')}`);
        },
        complete: () => {
            loadReservationClient();
        },
        success: (data) => {
            console.log(data);
        },
        error: (err) => {
            console.log(err);
        }
    });
}

const cancelReservation = (reservation_token) => {
    $.ajax({
        url: "../../../controller/admin_controller/ReservationAction.php",
        type: "POST",
        dataType: "JSON",
        data: {
            reservation_token: reservation_token,
            action: "cancel"
        },
        beforeSend: () => {
            // $("#add-service").html(`${loadSuccessBtn('adding...')}`);
        },
        complete: () => {
            loadReservationClient();
        },
        success: (data) => {
            console.log(data);
        },
        error: (err) => {
            console.log(err);
        }
    });
}

const undoReservation = (reservation_token) => {
    $.ajax({
        url: "../../../controller/admin_controller/ReservationAction.php",
        type: "POST",
        dataType: "JSON",
        data: {
            reservation_token: reservation_token,
            action: "undo"
        },
        beforeSend: () => {
            // $("#add-service").html(`${loadSuccessBtn('adding...')}`);
        },
        complete: () => {
            loadReservationClient();
        },
        success: (data) => {
            console.log(data);
        },
        error: (err) => {
            console.log(err);
        }
    });
}