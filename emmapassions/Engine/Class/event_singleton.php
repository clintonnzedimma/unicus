<?php
/**
 * 
 */
class Event_Singleton
{
	public $id; 
	public $DB;

	function __construct($param_id)
	{
		$this->id=sanitize_note($param_id);
		$this->DB=new DB();

	}


	public function get($par)
	{
		$par = sanitize_note($par);
		$sql = "SELECT * FROM event  WHERE id='$this->id' "; 
		$query = $this->DB->query($sql); 
		$num_rows = $query->num_rows;

		if($num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				switch($par){
					case $par:
					$value = $row[$par];
					break;


					default :
					$value = null;
					break;


				}
			}
			return $value;
		}

	}

	public function isAvailable()
	{
		$start_dt_obj = new DateTime($this->get('start_date')); 
		$today_dt_obj = new DateTime(Date('Y-m-d'));
		return ($start_dt_obj > $today_dt_obj) ? true : false;
	}
}



?>