function editRoom(paramId) {
	var ajaxData = {
		room_id : paramId,
		number : $("input[room-number-id="+paramId+"]").val(),
		category : $("input[room-category-id="+paramId+"]").val(),
		price : $("input[room-cost-id="+paramId+"]").val(),
		action : "edit"
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				alert("Room modified successfully");
			}
		}); 
}

function deleteRoom(paramId) {
	var ajaxData = {
		room_id: paramId,
		action: "delete"
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				$("tr[room-id="+paramId+"]").attr("style", "display:none"); 
				alert("Room deleted successfully");
			}
		});
}


function addRoom() {
	var ajaxData = {
		number: $("input[name=new-room-number]").val(),
		price: $("input[name=new-cost]").val(),
		category: $("input[name=new-category]").val(),  
		action: "add-room"
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,		
		function (data, status) {
			if(parseInt(data) && status) {
				alert ("Room added successfully");
				location.reload(true); 
			}
		});
}



function addHall () {
	var ajaxData = {
		name: $("input[name=new-hall-name]").val(),
		price: $("input[name=new-hall-price]").val(),
		action:"add-hall"
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status)	{
			if(parseInt(data) && status) {
				alert ("Hall added successfully");
				location.reload(true); 
			}			
		});
}


function deleteHall(paramId) {
	var ajaxData = {
		hall_id: paramId,
		action: "delete"
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				$("tr[hall-id="+paramId+"]").attr("style", "display:none"); 
				alert("Hall deleted successfully");
			}
		});
}



function editHall(paramId) {

	var ajaxData = {
		hall_id : paramId,
		name: $("input[hall-name-id="+paramId+"]").val(),
		price: $("input[hall-cost-id="+paramId+"]").val(),
		action : "edit"
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				alert("Hall modified successfully");
			}
		}); 
}






function acceptRoomBooking(paramVoucher) {
	var ajaxData = {
		user_voucher : paramVoucher,
		action : 'accept-room-request'
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				$("span[reset-state-button-voucher="+paramVoucher+"]").attr("style", "display:block");						
				$("span[state-button-voucher="+paramVoucher+"]").attr("style", "display:none");	
				$("tr[guest-room-voucher="+paramVoucher+"]").addClass('accepted');				
				alert("Room request accepted successfully");
			}
		});	
}


function declineRoomBooking(paramVoucher) {
	var ajaxData = {
		user_voucher : paramVoucher,
		action : 'decline-room-request'
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				$("span[reset-state-button-voucher="+paramVoucher+"]").attr("style", "display:block");					
				$("span[state-button-voucher="+paramVoucher+"]").attr("style", "display:none");	
				$("tr[guest-room-voucher="+paramVoucher+"]").addClass('declined');		
				alert("Room request declined successfully");	
			}
		});	
}


function resetRoomBooking(paramVoucher) {
	var ajaxData = {
		user_voucher : paramVoucher,
		action : 'reset-room-request'
	}

	$.get(
		"../engine/tesseract/async/tpanel_ajax.php",
		ajaxData,
		function (data, status) {
			if(parseInt(data) && status) {
				$("span[state-button-voucher="+paramVoucher+"]").attr("style", "display:block");				
				$("span[reset-state-button-voucher="+paramVoucher+"]").attr("style", "display:none");	
				$("tr[guest-room-voucher="+paramVoucher+"]").removeClass('accepted');	
				$("tr[guest-room-voucher="+paramVoucher+"]").removeClass('declined');		
				alert("Room request reset successfully");		
			}
		});	
}

function getUserRoomData(paramVoucher) {
	var pushData = {
		user_voucher : paramVoucher,
		action: 'get-room-data'
	}

	$.getJSON(
		"../engine/tesseract/async/tpanel_json.php",
		pushData,
		function (data, status) {
			if (status) {
				$("data[tesseract=user-room_voucher]").html(data["user_room"]["slip_voucher"]);
				$("data[tesseract=user-extra_details]").html(data["user_room"]["extra_details"]);
				$("data[tesseract=user-number_of_persons]").html(data["user_room"]["number_of_persons"]);
			}
		});
}

function getUserHallData(paramVoucher) {
	var pushData = {
		user_voucher : paramVoucher,
		action: 'get-hal-data'
	}

	
}
