<?php
/**
 * @author Clinton Nzedimma
 * @package Users (A singler user)
 */
class User_Singleton
{
	public $voucher; 
	public $DB;
	public $event;
	function __construct($param_voucher)
	{	
		 $this->DB = new DB();
		 $this->voucher  = $param_voucher;
		 $this->event = new Event_Singleton($this->get('event_id'));
	}

	public function get($par) {
		$par = sanitize_note($par);
		$sql = "SELECT * FROM users WHERE slip_voucher = '$this->voucher' ";
		$query = $this->DB->query($sql);
		$num_rows = $query->num_rows;

		if ($num_rows>0) {
			while ($row = $query->fetch_assoc()) {
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
}


?>