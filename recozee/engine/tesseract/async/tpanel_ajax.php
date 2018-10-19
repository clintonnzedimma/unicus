<?php
/**
* @author Clinton Nzedimma
* TPanel Dashboard AJAX Script
*/
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/env/ftf.php';
Admin::protectPage();
$roomFactory = new Room();
$userFactory = new User();
$hallFactory =  new Hall();


/* ADD ROOM */
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add-room') {
	if (isset($_REQUEST['category']) && isset($_REQUEST['number']) && isset($_REQUEST['price'])) {
		/**
		* @var sent via AJAX
		*/		
		$room_category = sanitize_note($_REQUEST['category']);
		$room_number = sanitize_note($_REQUEST['number']);
		$room_price = sanitize_note($_REQUEST['price']);

		/* Checking for errors */
		if (!sanitize_integer($room_number)) {
			$errors[] = "Please enter numeric Value for Room Number !";
		}

		if (!sanitize_integer($room_price)) {
			$errors[] = "Please enter numeric value for Room Price !";
		}

		if ($roomFactory->numberExists($room_number)) {
			$errors[] = "This room number <b>$room_number</b> already exists. Try another number !";
		}

		if (!$room_category || !$room_number || !$room_number || !$room_price ) {
			$errors[] = "Empty data !"; 
		}

		/* Success */
		if (empty($errors)) {
			$roomFactory->addNew($room_category, $room_number, $room_price);	
			$ajax_response = true;
		} else {
			$ajax_response = false;
		}
		echo $ajax_response;
	}	
}




/* MODIFY ROOM */
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
	if (isset($_REQUEST['category']) && isset($_REQUEST['number']) && isset($_REQUEST['price']) && isset($_REQUEST['room_id'])) {
		/**
		* @var sent via AJAX
		*/
		$room_id = sanitize_note($_REQUEST['room_id']);
		$room_category = sanitize_note($_REQUEST['category']);
		$room_number = sanitize_note($_REQUEST['number']);
		$room_price = sanitize_note($_REQUEST['price']);

		/**
		* @var automatic generated data
		*/	
		$the_room = new Room_Singleton($room_id);	// creating singleton room object
		$old_room_number = $the_room->get("room_number");

		/* Checking for errors */
		if (!sanitize_integer($room_number)) {
			$errors[] = "Please enter numeric Value for Room Number";
		}

		if (!sanitize_integer($room_price)) {
			$errors[] = "Please enter numeric value for Room Price";
		}

		if ($roomFactory->numberExists($room_number) && $room_number != $old_room_number) {
			$errors[] = "This room number <b>$room_number</b> already exists. Try another number";
		}

		if (!$room_category || !$room_number || !$room_number || !$room_price ) {
			$errors[] = "Empty data !"; 
		}


		/* Success */
		if ($roomFactory->idExists($room_id) && empty($errors)) {
			/*
			* If room exists and no errors, then modify it
			*/
			$ajax_response = true;
			$roomFactory->modifyById($room_id, $room_category, $room_number, $room_price);
		} else {
			$ajax_response = false;
		}

		echo $ajax_response;
	}

}




/* DELETE ROOM */
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete'  && isset($_REQUEST['room_id'])) { 
	/**
	* @var sent via AJAX
	*/
	$room_id = sanitize_note($_REQUEST['room_id']);

	if ($roomFactory->idExists($room_id)) {
		/*
		* If room exists, then delete it
		*/
		$ajax_response = true;		
		$roomFactory->deleteById($room_id);
	} else {
		$ajax_response = false;
	}

	echo $ajax_response;
}	


/* ADD HALL */
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add-hall' ) {
	if (isset($_REQUEST['name']) && isset($_REQUEST['price'])) {
		$hall_name = sanitize_note($_REQUEST['name']);
		$hall_price = sanitize_note($_REQUEST['price']);

		/* ERRORS */
		if ($hall_name == '' || !$hall_name) {
			$errors[] = "Please enter hall name !";
		}

		if (is_int($hall_price) || !sanitize_integer($hall_price)) {
			$errors[] = "Please input digit for phone number !";
		}

		/* Success */
		if(empty($errors)) {
			$hallFactory->addNew($hall_name, $hall_price);
			$ajax_response = true;
		} else {
			$ajax_response = false;
		}
		echo $ajax_response;
	}
}

/* EDIT HALL*/
if (isset($_REQUEST['action']) && $_REQUEST['action'] =='edit' ) {
	if (isset($_REQUEST['name']) && isset($_REQUEST['price']) && isset($_REQUEST['hall_id']) ) {
		$hall_id = sanitize_note($_REQUEST['hall_id']);
		$hall_name = sanitize_note($_REQUEST['name']);
		$hall_price = sanitize_note($_REQUEST['price']);

		if (!$hall_id || !$hall_name || !$hall_price) {
			$errors[] = "Missing value";
		}

		if (is_int($hall_price) || !sanitize_integer($hall_price)) {
			$errors[] = "Please input digit for phone number !";
		}

		/* Success */
		if(empty($errors)) {
			$hallFactory->modifyById($hall_id, $hall_name, $hall_price);
			$ajax_response = true;
		} else {
			$ajax_response = false;
		}				
		echo $ajax_response;
	}
}


/* DELETE HALL */
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete'  && isset($_REQUEST['hall_id'])) { 
	/**
	* @var sent via AJAX
	*/
	$hall_id = sanitize_note($_REQUEST['hall_id']);

	if ($hallFactory->idExists($hall_id)) {
		/*
		* If hall exists, then delete it
		*/
		$ajax_response = true;		
		$hallFactory->deleteById($hall_id);
	} else {
		$ajax_response = false;
	}

	echo $ajax_response;
}



/* SET USER => Accept or Decline  */
if (isset($_REQUEST['action'])  && isset($_REQUEST['user_voucher'])) {
	$the_user = new User_Singleton($_REQUEST['user_voucher']);

	if($_REQUEST['action'] == 'accept-room-request') {
		$userFactory->adminAcceptByVoucher($_REQUEST['user_voucher']);
		$ajax_response = true;
	}

	if ($_REQUEST['action'] == 'decline-room-request') {
		$userFactory->adminDeclineByVoucher($_REQUEST['user_voucher']);
		$ajax_response = true;
	}

	if($_REQUEST['action'] == 'reset-room-request') {
		$userFactory->adminResetByVoucher($_REQUEST['user_voucher']);
		$ajax_response = true;
	}

	echo $ajax_response;
}

?>
