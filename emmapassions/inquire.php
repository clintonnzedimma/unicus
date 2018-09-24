<?php 
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/env/ftf.php';

$user =  new User();

$required_fields = array('first_voucher', 'second_voucher');

if (submit_btn_clicked('check-my-slip')) {
	$first_voucher = sanitize_note($_POST['first_voucher']);
	$second_voucher = sanitize_note($_POST['second_voucher']);

	$final_voucher = sanitize_note($first_voucher."-".$second_voucher);

	if (strlen($first_voucher)!=4 || strlen($second_voucher)!=4 || strlen($final_voucher)!=9 ) {
		$errors[]= "Voucher Error ! ";
	}

	if(!$user->checkUserVoucher($final_voucher) && strlen($first_voucher)==4 && strlen($second_voucher)==4) {
		$errors[] = "Voucher does not exist !"; 
	}

	if (!empty($errors)) {
		print_r($errors);
		var_dump($final_voucher);
	}

	if (empty($errors)) {
		$user->authenticateVoucher ($final_voucher); 
		header("Location:check-event-details.php");
		exit();
	}

}


?>


<form method="post">
	<input type="text" name="first_voucher" maxlength="4" size="10">
	-
	<input type="text" name="second_voucher" maxlength="4" size="10">
	<input type="submit" name="check-my-slip" value="CHECK">
</form>