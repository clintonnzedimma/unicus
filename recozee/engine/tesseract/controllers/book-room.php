<?php
/**
 * @author Clinton Nzedimma
 * @package Book Room Controller
 **/

$room = new Room();
$userFactory = new User();


    $required_fields = array('arrival', 'departure', 'number_of_persons', 'room_id', 'fullname', 'email' ,'phone');
    $today = date("Y-m-d");
   if (submit_btn_clicked('book-room')) {
        /**
         * @var initializing form values
         */
        $arrival = sanitize_note($_POST['arrival']); // server date  format
        $departure = sanitize_note($_POST['departure']); // server date format
        $number_of_persons = intval(sanitize_note($_POST['number_of_persons']));
        $room_id = sanitize_note ($_POST['room_id']);
        $extra_details = sanitize_note($_POST['extra_details']);
        $full_name = sanitize_note($_POST['full_name']);
        $email = sanitize_note($_POST['email']);
        $phone = sanitize_note($_POST['phone']);

        /**
        * @var processing date objects below
        */
        $today_dt_obj = new DateTime($today);
        $arrival_dt_obj = new DateTime($arrival);
        $departure_dt_obj = new DateTime($departure);
        $number_of_days = $arrival_dt_obj->diff($departure_dt_obj)->format('%a');


        /**
        * @param Validating form parameters
        */
        if (!mandatory_fields($required_fields)) {
            $errors[] = "Please fill required fields";
        } 
        if ($arrival_dt_obj>$departure_dt_obj) {
            $errors[] = "Invalid Date Duration, Departure later than  ";
        }

        if ($arrival_dt_obj < $today_dt_obj || $departure_dt_obj<$today_dt_obj) {
            $errors[] = "Date already passed";
        }

        if (!is_int($number_of_persons) || !$number_of_persons) {
            $errors[] ="Please Input Number of Persons";
        }

        if (!sanitize_email($email)) {
            $errors[] = "Please enter valid email"; 
        }

        if (strlen($phone)<11 || strlen($phone)>11) {
            $errors[] = "Please 11 digits for phone number";
        }

        if (!is_phone_number($phone)) {
            $errors[] = "Please enter a valid phone number";
        }

   }

   if (submit_btn_clicked('book-room') && empty($errors)) {
        $success[] = " ROOM BOOKED ";
        $SUCCESS_MESSAGE = success_msg($success);
        $userFactory->bookRoom();
   } else {
        $ERROR_MESSAGE = error_msg($errors);

   }


   
 ?>
