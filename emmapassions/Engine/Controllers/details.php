<?php 
/**
* @author Clinton Nzedimma, Sam Otomewo, Mohammed
* @controller for voucher check page
*/
$userFactory =  new User();


if (submit_btn_clicked('log-out')) {
	$userFactory->logOutVoucher();
	header("Location:index.php");
	exit();
}

?>