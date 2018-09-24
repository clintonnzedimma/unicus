<?php

/**
 * @author Clinton Nzedimma
 * @package Administration
 */

class Admin
 {
	public $DB;
	function __construct()
	{
		$this->DB = new DB();
	}

	public function addEvent() {
		$name_of_event =  sanitize_note($_REQUEST['name_of_event']);
		$description = sanitize_note($_REQUEST['description']);
		$start_date = sanitize_note($_REQUEST['start_date']);
		$location = sanitize_note($_REQUEST['location']);

		$sql = "INSERT INTO event (
				id,
				name_of_event,
				description,
				location,
				start_date
		)
		VALUES (
			NULL,
			'$name_of_event',
			'$description',
			'$location',
			'$start_date'
		)	
		";

		$query = $this->DB->query($sql);
	}

}

?>