<?php 
/**
*	@author Clinton Nzedimma, Paul Princewill (c) Novacom Webs Nigeria 2018
*	@package  tesseract Hotel Management System v 1.0.0
*	@subpackage User
*   @abstract  This is for a single room
*/

class room_singleton
{
	public $DB ;	
	public $id;
	public $data;
	function __construct($param_id)
	{	
		$this->DB = new DB();
		$this->id = sanitize_note($param_id);
	}

	public function _init_($id)
	{
		// figure this later
	}

public function get($par) {
	/**
	* @param is database row name
	* @method gets data of a room
	* @return string, int, float
	*/
		$par = sanitize_note($par);
		$sql = "SELECT * FROM rooms WHERE id='$this->id'";
		$query = $this->DB->query($sql);
		$num_rows = $query->num_rows;
		if ($num_rows!=0) {
			while ($row = $query->fetch_assoc()) {
				switch ($par) {
					case $par:
						$value=$row[$par];
						break;
					default:
						$value="<p style='color:red'> <b>'$par'</b> is a wrong value </p>";
						break;
				}
			}
		} else {
			$value = null;
		}
		return $value;
	}

	public function dateIsAvailable($param_arrival, $param_departure)
		{	
			/**
			* @param is arrival and departure date to check
			* @method checks if either date is available
			* @return boolean
			*/			
			$param_arrival = sanitize_note($param_arrival);
			$param_departure = sanitize_note($param_departure);	

			$sql = "SELECT * FROM hotel_room_bookings WHERE arrival='$param_arrival' OR departure='$param_departure' AND id='$this->id' ";
			$query = $this->DB->query($sql);
			$num_rows = $query->num_rows;
			return ($num_rows>0) ? true : false;
		}		

}

?>