<?php

/**
 * @author Clinton Nzedimma (c) Novacom Webs Nigeria
 *	@package  tesseract Hotel Management System v 1.0.0
 *	@subpackage Room Factory
 *	@license For Unicus Think Solutions Ltd under MIT License
 *  This class contains methods
 * 
 */
class  Room
{
	protected $DB;
	function __construct()
	{
		$this->DB= new DB();
	}


	public function addNew($input_roomType, $input_roomNumber, $input_roomPrice)
	{
		$input_roomType=sanitize_note($input_roomType);
		$input_roomNumber=sanitize_note(intval($input_roomNumber));
		$input_roomPrice=sanitize_note(intval($input_roomPrice));

		$hour=date('H'); // hour of post in 24 hour format
		$minute=date('i'); //minute 
		$second=date('s'); // second	
		$date_no=date('d'); //date 
		$month=date('m'); // month 
		$year=date('Y'); //year 

		$room_status="VACANT"; // room status is vacant for every new room


		$sql="INSERT INTO rooms (
			id,
			room_number, 
			type,
			price,
			status
		) 
		VALUES (
			NULL,
			'$input_roomNumber',
			'$input_roomType',
			'$input_roomPrice',
			'$room_status'
		)";
		$query=$this->DB->query($sql);
	
	}


	public function modifyById ($get_room_id, $input_roomType, $input_roomNumber, $input_roomPrice) {
		$get_room_id= sanitize_note($get_room_id);
		$input_roomType=sanitize_note($input_roomType);
		$input_roomNumber=sanitize_note($input_roomNumber);
		$input_roomPrice=sanitize_note($input_roomPrice);

		$sql="UPDATE rooms SET
			type='$input_roomType',
			room_number='$input_roomNumber',
			price='$input_roomPrice'
		 WHERE id='$get_room_id' ";

		$query=$this->DB->query($sql);	 
}	






	public function displayAllByTable () {
		$sql='SELECT * FROM rooms ';
		$query=$this->DB->query($sql);
		$num_rows= $query->num_rows;;

		$serial_number_count=NULL;

			echo 
'<table cellspacing="0" cellpadding="10">
	<tr class="fields"> <th>S/N</th> <th>Room Number</th> <th>Type</th> <th>Price</th>   <th>STATUS</th></tr>
	';	
		if ($num_rows!=0) {

			while ($row=$query->fetch_assoc()) {
				$serial_number_count++;
				# BREAKING OUT
				?>	
	

	<tr align="center" class="records"> 
		<td id='serial_number'><?php echo $serial_number_count; ?></td> 
		<td id='room_number'><?php echo $row['room_number']; ?></td> 
		<td id='room_type'><?php echo $row['type']; ?></td> 
		<td id='room_price'><?php echo "<span id='currency-sign'>".config::currency('sign')."</span>".number_format($row['price']); ?></td>

		<td id='room_status'><?php echo $row['status']; ?></td> 
	</tr>
				<?php		
				# BREAKING IN
			}
echo 
"</table>";			
		}
	}





	public function displayAllForEdit () {
		$sql='SELECT * FROM rooms WHERE status="VACANT" ';
		$query=$this->DB->query($sql);
		$num_rows= $query->num_rows;;
		$serial_number_count=NULL;

			echo 
'<table cellspacing="0" cellpadding="10">
	<tr class="fields"> <th>S/N</th> <th>Room Number</th> <th>Type</th> <th>Price</th>  </tr>
	';	
		if ($num_rows!=0) {

			while ($row=$query->fetch_assoc()) {
				$serial_number_count++;
				# BREAKING OUT
				?>	
	

	<tr align="center" class="records"> 
		<td id='serial_number'><?php echo $serial_number_count; ?></td> 
		<td id='room_number'><a href="?edit=<?php echo $row['id']; ?>"><?php echo $row['room_number']; ?></a></td> 
		<td id='room_type'><?php echo $row['type']; ?></td> 
		<td id='room_price'><?php echo "<span id='currency-sign'>".config::currency('sign')."</span>".number_format($row['price']); ?></td>
	</tr>
				<?php		
				# BREAKING IN
			}
echo 
"</table>";			
		}
	}




	public function displayAllByGrid () {
		$sql='SELECT * FROM rooms ';
		$query=$this->DB->query($sql);
		$num_rows= $query->num_rows;;

		$serial_number_count=NULL;


		if ($num_rows!=0) {

			while ($row=$query->fetch_assoc()) {
				$serial_number_count++;
				$animation_duration= ($serial_number_count*400>3000) ? 3000 : $serial_number_count*400;

				# BREAKING OUT
				?>	
<span class="rooms" data-aos="fade-up" data-aos-duration="<?php echo $animation_duration; ?>" room-state="<?php echo $row['status']?>">
	<p id="room-Number"><?php echo $row['room_number'] ?></p>
	<p id="room-Type"> <?php echo $row['type'] ?></p>
</span>
	<?php		
				# BREAKING IN
			}
			
		}
	}




	public function displayAllForDelete () {
		$sql='SELECT * FROM rooms WHERE status="VACANT" ';
		$query=$this->DB->query($sql);
		$num_rows= $query->num_rows;;

		$serial_number_count=NULL;

			echo 

'<form action="" method="POST">	<table cellspacing="0" cellpadding="10">
	<tr class="fields"> <th> </th> <th>S/N</th> <th>Room Number</th> <th>Type</th> <th>Price</th></tr>
	';	
		if ($num_rows!=0) {

			while ($row=$query->fetch_assoc()) {
				$serial_number_count++;
				# BREAKING OUT
				?>	
	

	<tr align="center" class="records"> 
		<td><input type="checkbox" name="<?php echo $row['id'] ?>"></td>
		<td id='serial_number'><?php echo $serial_number_count; ?></td> 
		<td id='room_number'><?php echo $row['room_number']; ?></td> 
		<td id='room_type'><?php echo $row['type']; ?></td> 
		<td id='room_price'><?php echo "<span id='currency-sign'>".config::currency('sign')."</span>".number_format($row['price']); ?></td>
	</tr>
				<?php		
				# BREAKING IN
			}
echo 
"</table> <input type='submit' value='Delete Selected' name='room-delete-submit'/> </form>";			
		}
	}




	public function numberExists($input_roomNumber)
	{
		$input_roomNumber=sanitize_note($input_roomNumber);
		$sql="SELECT * FROM rooms WHERE room_number= '$input_roomNumber' ";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;;

		if ($num_rows!=0) {
			return true;
		}
	}

	public function idExists($param_id)
	{
		$param_id=sanitize_note($param_id);
		$sql="SELECT * FROM rooms WHERE id= '$param_id' ";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;;

		if ($num_rows!=0) {
			return true;
		}
	}	

	public function numberById($input_id)
	{	
		$input_id=sanitize_note($input_id);
		$sql="SELECT room_number FROM rooms WHERE id='$input_id'";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;;

		if ($num_rows!=0) {
			while ($row=$query->fetch_assoc()) {
				$value=$row['room_number'];
			}
			return $value;
		}
	}




	


	public function getDataByNumber($input_roomNumber, $par)
	{
		$input_roomNumber=sanitize_note($input_roomNumber);
		$sql="SELECT * FROM rooms WHERE room_number='$input_roomNumber' ";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;;

		if ($num_rows!=0){
			while ($row=$query->fetch_assoc()) {
				switch ($par) {
					case 'id':
						$value=$row['id'];	
						break;

					case 'type':
						$value=$row['type'];
						break;

					case 'number':
						$value=$row['room_number'];	
						break;

					case 'price':
						$value=$row['price'];
						break;	

					case 'status':
						$value=$row['status'];			
						break;			
					
					default:
						$value="<p style='color:red'> <b>'$par'</b> is a wrong value </p>";
				}
				 return $value;
			}
		}
	}


	public function getDataById($input_ID, $par)
	{
		$input_ID=sanitize_note($input_ID);
		$sql="SELECT * FROM rooms WHERE id='$input_ID' ";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;;

		if ($num_rows!=0){
			while ($row=$query->fetch_assoc()) {
				switch ($par) {
					case 'id':
						$value=$row['id'];	
						break;

					case 'type':
						$value=$row['type'];
						break;

					case 'number':
						$value=$row['room_number'];	
						break;

					case 'price':
						$value=$row['price'];
						break;	

					case 'status':
						$value=$row['status'];			
						break;			
					
					default:
						$value="<p style='color:red'> <b>'$par'</b> is a wrong value </p>";
				}
				 return $value;
			}
		}
	}






public function wasModifiedById ($get_id) {
	$get_id=sanitize_note($get_id);
	$sql="SELECT * FROM rooms WHERE id='$get_id' ";
	$query=$this->DB->query($sql);
	$num_rows=$query->num_rows;;

	
	if ($num_rows!=0) {
		$row=$query->fetch_assoc();
			if (empty($row['hour_of_modif']) && empty($row['minute_of_modif']) && empty($row['second_of_modif']) && empty($row['day_of_modif']) && empty($row['month_of_modif']) && empty($row['year_of_modif'])) {
				//not modifed
				return FALSE;
			} else {
				//modified
				return TRUE;
			}

		
		
	}


}


public function deleteById ($get_id) {
	$get_id=sanitize_note($get_id);
	$sql="DELETE FROM rooms WHERE id= '$get_id'";
	$query=$this->DB->query($sql);
}	




public function countAll() {
	//this function returns the total number of rooms
	$sql="SELECT * FROM rooms";
	$query=$this->DB->query($sql);
	$num_rows=$query->num_rows;;
	return $num_rows;
}

public function countWhere($par) {
	// this function returns the total number of rooms that are vacant, reserved or lodged
	$par=sanitize_note(strtoupper($par)); //input status
	$sql="SELECT * FROM rooms WHERE status='$par'";
	$query=$this->DB->query($sql);
	$num_rows=$query->num_rows;;

	return $num_rows;	

}


public function optionsOfAllRooms($input_name) {
	/**
	* @param input name is name of input form
	*/ 

	$sql="SELECT * FROM rooms";
	$query=$this->DB->query($sql);
	$num_rows=$query->num_rows;;

	if ($num_rows!=0) {
		while ($row=$query->fetch_assoc()) {
			# BREAKING OUT
			?>

<option value="<?php echo $row['id'] ?>" <?php selectPostConst($input_name, $row['id']); ?> > Room  <?php echo $row['room_number']  ?> - <?php echo $row['type'] ?>  (<?php echo config::currency('sign') ?> <?php echo number_format($row['price']) ?>) </option>

			<?php
			# BREAKING IN
		}
	}
}

public function optionsOfVacantRooms($input_name) {
	/**
	* @param input name is name of input form
	*/ 
	$sql="SELECT * FROM rooms WHERE status='VACANT' ";
	$query=$this->DB->query($sql);
	$num_rows=$query->num_rows;;

	if ($num_rows!=0) {
		while ($row=$query->fetch_assoc()) {
			# BREAKING OUT
			?>

<option value="<?php echo $row['id'] ?>" <?php selectPostConst($input_name, $row['id']); ?> > ROOM  <?php echo $row['room_number'] ?> </option>

			<?php
			# BREAKING IN
		}
	}
}




public function setStatusById($input_id, $room_status) {
		$input_id= sanitize_note($input_id);
		$room_status= sanitize_note($room_status);	

		//if input room status values are vacant, resevred or lodged
		if ($room_status=="VACANT" || $room_status=="RESVERVED" || $room_status=="LODGED") {
			$sql="UPDATE rooms SET status='$room_status'  WHERE id='$input_id' ";
			$query=$this->DB->query($sql);
		}
}

public function isLodgedById($input_id) {
	$input_id= sanitize_note($input_id);
	$sql="SELECT * FROM rooms WHERE id='$input_id' AND status='LODGED'" ;
	$query=$this->DB->query($sql);
	$num_rows=$query->num_rows;;

	if($num_rows!=0) {
		return true;
	}

}




public function tpanelRooms () {
	$sql = "SELECT * FROM rooms";
	$query = $this->DB->query($sql);
	$num_rows = $query->num_rows;
	if ($num_rows!=0) {
		while ($row=$query->fetch_assoc()) {
				###BREAKING OUT
				?>
                <tr class="row100" room-id="<?php echo $row['id'] ?>">
                  <td ondblclick="disabled()" class="column100 column2" data-column="column2"><input type="number" room-number-id="<?php echo $row['id'] ?>" name="roomNumber" value="<?php echo $row['room_number'] ?>" min="0"></td>
                  <td ondblclick="disabled()" class="column100 column3" data-column="column3"><input type="text" room-category-id="<?php echo $row['id'] ?>" name="category" value="<?php echo $row['type'] ?>" ></td>
                  <td ondblclick="disabled()" class="column100 column4" data-column="column4"><input type="number" room-cost-id="<?php echo $row['id'] ?>" name="cost" value="<?php echo $row['price'] ?>" min="0"></td>
                  <td class="column100 column1" data-column="column1"><span class="btn btn-sm btn-danger" onclick="deleteRoom(<?php echo $row['id'] ?>)"><i class="fa fa-trash-o" style="color:white;"></i></span></td>
                  <td class="column100 column1" data-column="column1"><span class="btn btn-sm btn-success" onclick="editRoom(<?php echo $row['id'] ?>)">Update</span></td>                             
                </tr>
				<?php
				###BREAKING IN
			}	
	}
}




}
?>
