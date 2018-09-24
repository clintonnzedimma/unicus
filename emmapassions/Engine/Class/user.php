<?php
/**
 * @author Clinton Nzedimma
 * @package Users
 */
class User
{
	public $DB;
	function __construct()
	{	
		 $this->DB = new DB();
	}


	public function bookEvent(){
 		$full_name = sanitize_note($_REQUEST['first_name']." ". $_REQUEST['last_name']);
 		$phone = sanitize_note($_REQUEST['phone']);
 		$email = sanitize_note($_REQUEST['email']);
 		$address = sanitize_note($_REQUEST['address']);	
 		$event_id = sanitize_note($_REQUEST['event_id']);
 		$other_details = sanitize_note($_REQUEST['other_details']);
 		//automatic values
 		$date_of_reg = date('Y-m-d');
 		$slip_voucher = generate_voucher(4);
 
 		$sql = "INSERT INTO users (
 		id,
 		full_name,
 		phone,
 		email,
 		address,
 		date_reg,
 		slip_voucher,
 		other_details,
 		event_id
 	)
 	VALUES (
 		NULL,
 		'$full_name',
 		'$phone',
 		'$email',
 		'$address',
 		'$date_of_reg',
 		'$slip_voucher',
 		'$other_details',
 		'$event_id'
 	)
 	";
		$query = $this->DB->query($sql);
	}

	public function optionOfAvailableEvents ()
	 {
	 	$today_dt_obj = new DateTime(Date('Y-m-d'));
	 	$sql = "SELECT * FROM event";
	 	$query = $this->DB->query($sql);
	 	while ($row = $query->fetch_assoc()) {
	 		$start_dt_obj[$row['id']] =  new DateTime($row['start_date']);
	 		if ($start_dt_obj[$row['id']] > $today_dt_obj) {
	 			?>
	 			<option value='<?php echo $row['id'] ?>' <?php selectPostConst('event_id', $row['id']) ?> > <?php echo $row['name_of_event']  ?></option>
	 			<?php
	 		}
	 	}

	}	


	public function checkUserVoucher ($param_voucher) 
	{
		$param_voucher = sanitize_note($param_voucher);
		$sql = "SELECT * FROM users WHERE slip_voucher = '$param_voucher' ";
		$query = $this->DB->query($sql);
		$num_rows = $query->num_rows;

		return ($num_rows>0) ? true : false;
	}


	public function authenticateVoucher ($param_voucher) 
	{	
		$param_voucher = sanitize_note($param_voucher);
		$_SESSION['voucher'] = $param_voucher;
	}

	public function logOutVoucher () 
	{
		session_destroy();
	}

	public function isLoggedIn() 
	{
		return(isset($_SESSION['voucher'])) ? true : false;
	}

}


?>