

$(document).ready(() => {
	loadService();
}); 


$('input').on('change', function (event) {
	var $element = $(event.target);
	var $container = $element.closest('.example');

	if (!$element.data('tagsinput')) return;

	var val = $element.val();
	if (val === null) val = 'null';
	var items = $element.tagsinput('items');

	$('code', $('pre.val', $container)).html(
		$.isArray(val)
			? JSON.stringify(val)
			: '"' + val.replace('"', '\\"') + '"'
	);
	$('code', $('pre.items', $container)).html(
		JSON.stringify($element.tagsinput('items'))
	);
}).trigger('change');



$(document).ready(function () {
	$('.input-images').imageUploader({
		maxSize: 20 * 1024 * 1024,
		maxFiles: 20
	});
	$("#add-services").on("submit", function (e) {
		e.preventDefault();
		var form_data = new FormData(this);
		$.ajax({
			url: "../../controller/admin_controller/AddServiceController.php",
			type: "POST",
			dataType: "JSON",
			processData: false,
			data: form_data,
			contentType: false,
			beforeSend: () => {
				$("#add-service").html(`${loadSuccessBtn()}`);
			},
			complete: () => {
				$(".cancel-btn").click();
				$("#add-services-btn-m").html("Add");
				emptyForm();
				$('.input-images').imageUploader({
					maxSize: 20 * 1024 * 1024,
					maxFiles: 20
				});
				loadService();
			},
			success: (data) => {
				console.log(data);
			},
			error: (err) => {
				console.log(err);
			}
		});
	});

});


const loadSuccessBtn = () => {
	return `
    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    Adding...
    `;
}

const emptyForm = () => {
	$("#service-title").val("");
	$("#service-description").val("");
	$("#service-features").val("");
	$("#service-price").val("");

	$("#service-title-e").val("");
	$("#service-description-e").val("");
	$("#service-features-e").val("");
	$("#service-price-e").val("");

	$('.bootstrap-tagsinput').find('span').remove()

	$(".uploaded").empty()
	$(".input-images").empty();
	$(".image-list").empty();
}


const loadService = () => {
	$(".load-services").load("../../controller/admin_controller/load_Element/LoadServices.php");
}

const loadServiceDetails = (service_token) => {
	$.ajax({
		url: "../../controller/admin_controller/FetchServiceDetails.php",
		type: "POST",
		dataType: "JSON",
		data: {
			service_token: service_token
		},
		success: (data) => {

			console.log(data);
			const images = data.images.split(",");

			// create a object for the images with id and src
			const imageObject = images.map((image, index) => {
				return {
					id: index,
					src: `../../vendors/images/services/${image.trim()}`
				}
			});

			// render the image uploader
			renderImageUploader(imageObject);
			populateServiceDetails(data);		
		}
	})
}


const renderImageUploader = (imageObject) => {
	$('.image-list').imageUploader({
		preloaded: imageObject,
		imagesInputName: 'photos',
		preloadedInputName: 'old',
		maxSize: 20 * 1024 * 1024,
		maxFiles: 20
	});
}

const populateServiceDetails = (data) => {	
	$("#service-title-e").val(`${data.name}`);
	$("#service-description-e").val(`${data.description}`);
	$("#service-features-e").tagsinput('add', `${data.features}`);
	$("#service-token").val(`${data.services_token}`);

	// render the tagsItems in bootstrap tagsinput

	//$(".bootstrap-tagsinput").html(`${tagsItems(data.features.split(","))}`);
	
	$("#service-price-e").val(`${data.price}`);
}


const tagsItems = (tags) => {	
	// return `
	// 	<span class="tag label label-info">sdasda asd<span data-role="remove"></span></span>
	// 	<input type="text" placeholder="">
	// `
	let tagsItems = "";
	tags.forEach(tag => {
		tagsItems += `
			<span class="tag label label-info">${tag}<span data-role="remove"></span></span>
		`
	});

	tagsItems += `<input type="text" placeholder="">`;

	return tagsItems;
}

$(document).ready(function () {
	$("#edit-services").on("submit", function (e) {
		e.preventDefault();
		var form_data = new FormData(this);
		console.log(form_data);
		$.ajax({
			url: "../../controller/admin_controller/EditServiceController.php",
			type: "POST",
			dataType: "JSON",
			processData: false,
			data: form_data,
			contentType: false,
			beforeSend: () => {
				// $("#add-service").html(`${loadSuccessBtn()}`);
			},
			complete: () => {
				// $(".cancel-btn").click();
				// $("#add-services-btn-m").html("Add");
				// emptyForm();
				// $('.input-images').imageUploader({
				// 	maxSize: 20 * 1024 * 1024,
				// 	maxFiles: 20
				// });
				// loadService();
			},
			success: (data) => {
				console.log(data);
			},
			error: (err) => {
				console.log(err);
			}
		});
	});

});
