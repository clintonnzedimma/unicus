<?php 
/**
*	@author Clinton Nzedimma (c) Novacom Webs Nigeria 2018
*	@package  tesseract Hotel Management System v 1.0.0
*	@subpackage Administraton Factory 
* 	@static Class
*/


class Admin 
{
	public static $DB;

	function __construct () {
		self::$DB = new DB();
	}
	
	public static function checkLoginDetails($param_username, $param_password) {
		$param_username = sanitize_note($param_username);
		$param_password = sanitize_note(grease($param_password));
		
		$sql = "SELECT * FROM admin WHERE username = '$param_username' AND password = '$param_password' ";
		$query = self::$DB->query($sql);
		$num_rows = $query->num_rows;
		return ($num_rows > 0) ? true : false;
	}

	public static function isLoggedIn () {
		return (isset($_SESSION['tpanel_admin'])) ? true : false;
	}

	public static function protectPage () {
		if (!self::isLoggedIn()) {
			header("Location:index.php");
			exit();
		}
	}

	public static function authenticate ($username) {
		$_SESSION['tpanel_admin'] = sanitize_note($username);
	}

	public static function logOut () {
		unset($_SESSION['tpanel_admin']);
	}
	
}

//Triggering Static Instantiation
new Admin (); 
?>

