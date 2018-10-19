<?php
/**
* @author Clinton Nzedimma
* TPanel Dashboard JSON Script
*/
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/env/ftf.php';
Admin::protectPage();
$roomFactory = new Room();
$userFactory = new User();
$hallFactory =  new Hall();

if (isset($_REQUEST['user_voucher']) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'get-room-data') {
	if($userFactory->roomVoucherExists($_REQUEST['user_voucher'])) {
		$the_user = new User_Singleton([ "room_voucher" => $_REQUEST['user_voucher']]);
		$json_response = array(
			"user_room" => array(
				/* Database table values */
				"id" => $the_user->get('id'),
				"arrival" => $the_user->get('arrival'),
				"departure" => $the_user->get('departure'),
				"number_of_persons" => $the_user->get('number_of_persons'),
				"extra_details"  => $the_user->get('extra_details'),
				"full_name" => $the_user->get('full_name'),
				"email" => $the_user->get('email'),
				"cost" =>	intval($the_user->get('cost')),
				"slip_voucher" => $the_user->get('slip_voucher'),
				"time_of_booking" => $the_user->get('time_of_booking'),
				"date_of_booking" => $the_user->get('date_of_booking'),
				"date_of_process" => $the_user->get('date_of_process'),
				"room_id" => $the_user->get('room_id'),
				"phone" => $the_user->get('phone'),

				/* processed data from database */
				"_room_number" => $roomFactory->getDataById($the_user->get('room_id'), "number"),
				"_room_type" => $roomFactory->getDataById($the_user->get('room_id'), "type"),
				"_room_cost" => intval($roomFactory->getDataById($the_user->get('room_id'), "price"))
			));

		echo json_encode($json_response);
	}
}
?>