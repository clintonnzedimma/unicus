<?php 
/**
* @author Clinton Nzedimma
* @controller for tpanel index login page
*/

// When login button request is made
if (submit_btn_clicked('tpanel-sign-in')) {
	/**
	* @var form values
	*/
	$username = sanitize_note ($_POST['username']);
	$password = sanitize_note($_POST['password']);

	/**
	* errors
	*/
	if (!Admin::checkLoginDetails($username, $password)) {
		$errors[] = "Invalid Tpanel Details !"; 
	}

	if (empty($username) || empty($password)) {
		$errors[] = "Fields cannot be empty !"; 
	}

	if(!empty($errors)) {
		echo "<script> alert('Tpanel Error !'); </script>";
	}

	if (empty($errors)) {
		echo "<script> alert('Tpanel authentication successful'); </script>";
		Admin::authenticate($username);
		header("Location:dashboard.php");
		exit();
	}
}


if (Admin::isLoggedIn()) {
	header("Location:dashboard.php");
	exit();
}


?>