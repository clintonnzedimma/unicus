<?php 
/**
* @author Clinton Nzedimma
*/
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/env/ftf.php'; 
$room = new Room();
$user = new User();
?>

<?php 

if(isset($_REQUEST['room_id']) && isset($_REQUEST['check_date'])) {
	/**
	* @var 
	*/
	$room_id = sanitize_note($_REQUEST['room_id']);
	$check_date = sanitize_note($_REQUEST['check_date']);

	if ($user->generalRoomDateRangeCheck($room_id, $check_date)) {
		$retval = array( "DateRangeCheck" => array("status" => true ));
	} else {
		$retval = array( "DateRangeCheck" =>  array("status" => false));
	}
	echo json_encode($retval);
}


if (isset($_REQUEST['room_id']) && isset($_REQUEST['arrival']) && isset($_REQUEST['departure'])) {
	$room_id = sanitize_note($_REQUEST['room_id']);
	$arrival = sanitize_note($_REQUEST['arrival']);
	$departure = sanitize_note($_REQUEST['departure']);

	$arrival_dt_obj =  new DateTime($arrival);
	$departure_dt_obj = new DateTime($departure);
	$number_of_days = $arrival_dt_obj->diff($departure_dt_obj)->format('%a');

	if ($room->idExists($room_id)) {
		$the_room = new Room_Singleton($room_id);
		$price_for_num_of_days = $number_of_days * $the_room->get('price');
		
		
		$data = array(
		"room" => array(
			"number" => $the_room->get('room_number'),
			"type" => $the_room->get('type'),
			"price" => intval($the_room->get('price')),	
		), 

		"userRequest" => array(
			"arrival" => $arrival,
			"departure" => $departure,
			"number_of_days" => intval($number_of_days),
			"price" => $price_for_num_of_days
		)
	);

		echo json_encode($data);


	}


}





?>
