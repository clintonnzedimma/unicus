<?php
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/env/ftf.php';
$admin =  new Admin();

$required_fields = array('name_of_event', 'description', 'start_date', 'location');


if (submit_btn_clicked('add-event')) {
	$name_of_event = $_POST['name_of_event'];
	$description = $_POST['description'];
	$start_date = $_POST['start_date'];
	$location = $_POST['location'];

	$start_dt_obj = new DateTime($start_date);
	$today_dt_obj = new DateTime(date('Y-m-d'));

	if (!mandatory_fields($required_fields)) {
		$errors[] = "Please fill all fields";
	}

	if ($start_dt_obj<$today_dt_obj) {
		$errors[]="Please Input a date later than today";
	}




	if(!empty($errors)) {
		print_r($errors);
	}

	if (empty($errors)) {
		$success[] = "Event Added Successfully";
		print_r($success);
		$admin->addEvent();
	}

}


?>





<form method="post">
	<label>Name of Event</label>
	<input type="text" name="name_of_event">
	<br>
	<label>Description</label>
	<input type="text" name="description">
	<br>
	<label>Start Date</label>
	<input type="date" min="<?php date('Y-m-d') ?>" name="start_date">
	<br>
	<label>Location</label>
	<input type="text" name="location">		
	<br>
	<input type="submit" name="add-event" value="ADD EVENT">
</form>