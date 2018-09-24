<?php 
/**
* @author Clinton Nzedimma, Sam Otomewo, Mohammed
* @controller for voucher check page
*/
$userFactory = new User();


$required_fields = array("voucher");

if (submit_btn_clicked('check')) {
	$voucher = trim(sanitize_note($_REQUEST['voucher']));
	$first_voucher_split = substr($voucher, 0, 4);
	$second_voucher_split = substr($voucher, 4, 7); 

	$final_voucher = sanitize_note($first_voucher_split."-".$second_voucher_split);
	var_dump($final_voucher);
	if (!mandatory_fields($required_fields)) {
		$errors[] = "Please input EVENT VOUCHER !";
	}

	if (strlen($voucher)!=8 && !empty($voucher)) {
		$errors[] = "Please voucher does not go below or exceed 8 characters !";
	}

	if (!$userFactory->checkUserVoucher($final_voucher) && strlen($voucher)==8) {
		$errors[] = "Voucher does not exist !";
	}


	if (!empty($errors)) {
		$ERROR_MESSAGE = error_msg($errors);
	}

	if (empty($errors)) {
		$success[]="Authentication Successful";
		$SUCCESS_MESSAGE = success_msg($success);
		$userFactory->authenticateVoucher ($final_voucher);
		header("Location:details.php");
		exit();		
	}
;


}

?>

