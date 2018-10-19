<?php 
/**
*	@author Clinton Nzedimma (c) Novacom Webs Nigeria 2018
*	@package  tesseract Hotel Management System v 1.0.0
*	@subpackage User
*   @abstract  This is for a hotel client or customer
* 	Note: This class is a singleton class
*/

class User_Singleton
{	
	public $DB;
	public $db_TBL;
	public $voucher;
	public $today;
	public $today_obj;
	public $room;
	
	function __construct($param)
	{	$this->DB =  new DB();
		$this->room = new Room();
		$this->today = date("Y-m-d"); // date in server format
		$this->today_obj = new DateTime($this->today);
		if(is_array($param)) {
			if(count($param)==1) {
				foreach ($param as $key => $value) {
					if ($key == "room_voucher") {
						$this->voucher = $value;
						$this->db_TBL = "hotel_room_bookings";
						
					}
				}
			}
		}	
	}

	public function get($par) {
		$par = sanitize_note($par);
		$this->voucher = sanitize_note($this->voucher);
		$sql = "SELECT * FROM $this->db_TBL WHERE slip_voucher='$this->voucher' ";
		$query = $this->DB->query($sql);
		$num_rows = $query->num_rows;
		if ($num_rows >0) {
			while ($row=$query->fetch_assoc()) {
				switch ($par) {
					case $par:
						$value = $row[$par];
						break;
					
					default:
						$value = null;
						break;
				}
			}
			return $value;
		}
	}


	public function roomRequestWasProcessed ()
	 {
		return ($this->get('date_of_process') && strlen($this->get('date_of_process'))>1) ? true :false;
	}	

	public function roomRequestIsPending() 
	{
		$arrival_dt_obj = new DateTime($this->get('arrival'));
		return ($this->today_obj<$arrival_dt_obj) ? true : false;
	}

	public function roomVoucherHasExpired()
	{
		$departure_dt_obj = new DateTime($this->get('departure'));
		return ($this->today_obj>=$departure_dt_obj) ? true  :false;
	}


	



}
?>
