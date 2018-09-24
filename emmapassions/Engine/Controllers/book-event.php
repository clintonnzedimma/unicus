<?php 
/**
* @author Clinton Nzedimma, Sam Otomewo, Mohammed
* @controller for booking form 
*/
$userFactory = new User();

$required_fields = array("first_name", "last_name", "email", "address", "event_id", "phone");
if (submit_btn_clicked('book-event')) {
	$first_name = sanitize_note($_REQUEST['first_name']);
	$last_name = sanitize_note($_REQUEST['last_name']);
	$email =  sanitize_note($_REQUEST['email']);
	$phone = sanitize_note($_REQUEST['phone']);
	$address = sanitize_note($_REQUEST['address']);
	$other_details = sanitize_note($_REQUEST['other_details']);
	$event_id = sanitize_note($_REQUEST['event_id']);

	$the_event = new event_Singleton($event_id);

	if (!is_phone_number($phone)) {
		$errors[] = "Please Input Valid Phone Number";
	}

	if (strlen($first_name)<3) {
		$errors[] = "Your first name should not be less than 3 character !";
	}

	if (strlen($last_name)<3) {
		$errors[] = "Your last name should not be less than 3 character !";
	}

	if (!sanitize_email($email)) {
		$errors[] = "Please input valid email !";
	}

	if (!$the_event->isAvailable()) {
		$errors[] = "This event is not available !";
	}



	// testing for errors
	if(!empty($errors)) {

		print_r($errors);
        $ERROR_MESSAGE = error_msg($errors);  
         		
	} 

	if (empty($errors)) {
		$success[] = "You have registered successfully for <i>".$the_event->get('name_of_event')."</i>. Wait for details in your email";
		$SUCCESS_MESSAGE = success_msg($success);
		$userFactory->bookEvent();
	}



}



?>

