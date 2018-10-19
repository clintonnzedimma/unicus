<?php 
/**
*	@author Clinton Nzedimma (c) Novacom Webs Nigeria 2018
*	@package  tesseract Hotel Management System v 1.0.0
*	@subpackage User
*   @abstract  This is for a hotel client or customer
* 	Note: Class is heavily polymorphic
*/

class User
{	
	public $DB;
	public $room;
	function __construct()
	{
		$this->DB =  new DB();
		$this->room = new Room();
	}

	public function bookRoom()
		{
				/**
				* @method Books down room
				* @var are parameters that will be submitted to database
				*/

		        $arrival = sanitize_note($_POST['arrival']); // server date  format
		        $departure = sanitize_note($_POST['departure']); // server date format
		        $number_of_persons = sanitize_note($_POST['number_of_persons']);
		        $room_id = sanitize_note ($_POST['room_id']);
		        $extra_details = sanitize_note($_POST['extra_details']);
		        $full_name = sanitize_note($_POST['full_name']);
		        $email = sanitize_note($_POST['email']);
		        $phone = sanitize_note($_POST['phone']);

		        /**
				* @var automatic values
		        */
		        $slip_voucher = generate_voucher(5);
		        $slip_pin = generate_pin();
				$time_of_booking = date("H:i"); // time in 24 hour
				$date_of_booking = date("Y-m-d"); // date in server format 

		        /**
		        * @var processing date objects below
		        */		
		        $arrival_dt_obj = new DateTime($arrival);
		        $departure_dt_obj = new DateTime($departure);
		        $number_of_days = $arrival_dt_obj->diff($departure_dt_obj)->format('%a');
		        $cost = $number_of_days * $this->room->getDataById($room_id, 'price');

				$sql = "INSERT INTO hotel_room_bookings (
							id,
							arrival,
							departure,
							number_of_persons,
							extra_details,
							full_name,
							email,
							cost,
							slip_voucher,
							slip_pin,
							time_of_booking,
							date_of_booking,
							room_id,
							phone
				)
					VALUES (
						NULL, 
						'$arrival', 
						'$departure', 
						'$number_of_persons', 
						'$extra_details',
						'$full_name', 
						'$email', 
						'$cost', 
						'$slip_voucher', 
						'$slip_pin', 
						'$time_of_booking', 
						'$date_of_booking',  
						'$room_id', 
						'$phone'
			)";
				$query = $this->DB->query($sql);	
		}

	public function roomVoucherExists($param)
		{
			/**
			* @param is voucher
			* @method checks if room voucher exists
			* @return boolean
			*/
			$param = sanitize_note($param);
			$sql = "SELECT * FROM hotel_room_bookings WHERE slip_voucher = '$param'";
			$query = $this->DB->query($sql);
			$num_rows = $query->num_rows;
			return($num_rows>0) ? true : false;
		}

	public function roomTrackLoginIsValid($param_voucher, $param_pin)
		{
			/**
			* @param are voucher & pin
			* @method checks if slip voucher and pin tally
			* @return boolean
			*/
			$param_voucher = sanitize_note($param_voucher);
			$param_pin = sanitize_note($param_pin);
			$sql = "SELECT * FROM hotel_room_bookings WHERE slip_voucher = '$param_voucher' AND slip_pin = '$param_pin'";
			$query = $this->DB->query($sql);
			$num_rows = $query->num_rows;
			return($num_rows>0) ? true : false;

		}	

	public function roomSessionAuthenticate($par)
		{
			/**
			*	@param is voucher
			*	@method logs in voucher
			*/
			$_SESSION["room_voucher"] = sanitize_note($par);
		}	

	public function roomVoucherIsLoggedIn()
		{
			/**
			*/
			return ($_SESSION["room_voucher"]) ? true : false;
		}		


	public function protectPage()
		{
			/**
			*	@method checks if user is logged in and redirects
			*/
			if (!$_SESSION) {
				header("Location:book.php");
				exit();
			}
		}

	public function generalRoomDateRangeCheck($input_room_id, $input_date)
	{
		$input_room_id = sanitize_note($input_room_id);
		$sql = "SELECT * FROM hotel_room_bookings WHERE id='$input_room_id' ";
		$query = $this->DB->query($sql);
		
		$num_rows = $query->num_rows;

		$the_user = array();
		$count_check = NULL;
		if ($num_rows!=0) {
			while ($row = $query->fetch_assoc()) {
					$the_user[$row['id']] = new User_Singleton(['room_voucher' => $row['slip_voucher']]);
					

					
					if (!$the_user[$row['id']]->roomRequestWasProcessed() && time_object::check_in_range($input_date, $the_user[$row['id']]->get("arrival"),  $the_user[$row['id']]->get("departure") ))  {
						$count_check ++;
					}
			}

			return ($count_check>0) ? true :false;
		}

	}

	public function tpanelGuest () {
		$sql = "SELECT * FROM hotel_room_bookings";
		$query = $this->DB->query($sql);
		$num_rows = $query->num_rows;


		if ($num_rows != 0) {
			while ($row = $query->fetch_assoc()) {
				### BREAKING OUT 
				?>

<tr  onmouseover="getUserRoomData('<?php echo $row['slip_voucher'] ?>')" class="row100" style="
    cursor: pointer; 
" guest-room-voucher="<?php echo $row['slip_voucher'] ?>" onclick="getUserRoomData('<?php echo $row['slip_voucher'] ?>')">
                        <td ondblclick="disabled()" class="column100 column2" data-column="column2" ><?php echo $row['slip_voucher'] ?></td>
                         <td ondblclick="disabled()" class="column100 column2" data-column="column2" ><?php echo $row['full_name'] ?></td>
                              <td ondblclick="disabled()" class="column100 column3" data-column="column3" ><?php echo $this->room->getDataById($row['room_id'],'number') ?>  -  <?php echo $this->room->getDataById($row['room_id'],'type') ?> </td>
                              <td class="column100 column1" data-column="column1"> &#8358 <?php echo number_format($row['cost']) ?></td>
                              <td class="column100 column1" data-column="column1"><span class="btn btn-sm btn-success" <?php if ($row['status'] == 'accepted' || $row['status'] == 'declined'): ?> style="display: none;" <?php endif ?>  onclick="acceptRoomBooking('<?php echo $row['slip_voucher'] ?>')" state-button-voucher="<?php echo $row['slip_voucher'] ?>">Accept</span></td>
<td   class="column100 column1" data-column="column1" ><span  <?php if ($row['status'] == 'accepted' || $row['status'] == 'declined'): ?> style="display: none;" <?php endif ?>  class="btn btn-sm btn-danger" onclick="declineRoomBooking('<?php echo $row['slip_voucher']?>')" state-button-voucher="<?php echo $row['slip_voucher'] ?>">Decline</span></td>  	
<td   class="column100 column1" data-column="column1" "><span <?php if ($row['status'] == 'accepted' || $row['status'] == 'declined'): ?> style="display: block;" <?php else: ?> style="display: none;"  <?php endif ?>  class="btn btn-sm btn-warning" onclick="resetRoomBooking('<?php echo $row['slip_voucher'] ?>')" reset-state-button-voucher ="<?php echo $row['slip_voucher']?>">Reset</span></td>
</tr>			
				<?php
				### BREAKING IN
			}
		}
	}
	


	public function adminAcceptByVoucher($param_voucher)
	{
		$param_voucher = sanitize_note($param_voucher);
		$sql = "UPDATE hotel_room_bookings SET status = 'accepted' WHERE slip_voucher = '$param_voucher' ";
		$query =$this->DB->query($sql); 
	}

	public function adminDeclineByVoucher($param_voucher)
	{
		$param_voucher = sanitize_note($param_voucher);
		$sql = "UPDATE hotel_room_bookings SET status = 'declined' WHERE slip_voucher = '$param_voucher' ";
		$query =$this->DB->query($sql); 
	}
	
	public function adminResetByVoucher($param_voucher)
	{
		$param_voucher = sanitize_note($param_voucher);
		$sql = "UPDATE hotel_room_bookings SET status = '' WHERE slip_voucher = '$param_voucher' ";
		$query =$this->DB->query($sql); 
	}	

	public function countRoomPendingRequests()
	{
		$sql = " SELECT * FROM  hotel_room_bookings";
		$query =$this->DB->query($sql);
		$sum = 0;
		while ($row = $query->fetch_assoc()) {
				$the_guest[$row['slip_voucher']] = new User_Singleton (["room_voucher" => $row['slip_voucher']]);
				if ($the_guest[$row['slip_voucher']]->roomRequestIsPending()) {
					$sum ++;
				}
			}
			return $sum;	
	}

	public function countRoomProcessedRequests()
	{
		$sql = " SELECT * FROM  hotel_room_bookings";
		$query =$this->DB->query($sql);
		$sum = 0;
		while ($row = $query->fetch_assoc()) {
				$the_guest[$row['slip_voucher']] = new User_Singleton (["room_voucher" => $row['slip_voucher']]);
				if ($the_guest[$row['slip_voucher']]->roomRequestWasProcessed()) {
					$sum ++;
				}
			}
			return $sum;	
	}	

	public function countRoomExpiredRequests()
	{
		$sql = " SELECT * FROM  hotel_room_bookings";
		$query =$this->DB->query($sql);
		$sum = 0;
		while ($row = $query->fetch_assoc()) {
				$the_guest[$row['slip_voucher']] = new User_Singleton (["room_voucher" => $row['slip_voucher']]);
				if ($the_guest[$row['slip_voucher']]->roomVoucherHasExpired()) {
					$sum ++;
				}
			}
			return $sum;	
	}	

}
?>
