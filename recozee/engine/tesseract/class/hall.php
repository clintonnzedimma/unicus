<?php
/**
 * @author Clinton Nzedimma (c) Novacom Webs Nigeria
 *	@package  tesseract Hotel Management System v 1.0.0
 *	@subpackage Hall Factory
 *	@license For Unicus Think Solutions Ltd under MIT License
 *  This class contains methods for halls
 * 
 */

class Hall
{
	
	protected $DB;
	function __construct()
	{
		$this->DB= new DB();
	}

	public function addNew ($param_name , $param_price)
	{
		$param_name = sanitize_note($param_name);
		$param_price = sanitize_note($param_price);

		$sql = "
		INSERT INTO halls (
			id,
			name,
			price
		)
		VALUES (
			NULL,
			'$param_name',
			'$param_price'
		)";

		$query = $this->DB->query($sql);
	}


	public function modifyById ($get_hall_id, $param_hall_name, $param_hall_price) {
		$get_hall_id= sanitize_note($get_hall_id);
		$param_hall_name=sanitize_note($param_hall_name);
		$param_hall_price=sanitize_note($param_hall_price);

		$sql="UPDATE halls SET
			name='$param_hall_name',
			price='$param_hall_price'
		 WHERE id='$get_hall_id' ";
		$query=$this->DB->query($sql);	 
}	



	public function deleteById ($get_id) {
		$get_id=sanitize_note($get_id);
		$sql="DELETE FROM halls WHERE id= '$get_id'";
		$query=$this->DB->query($sql);
	}

	public function countAll() {
		//this function returns the total number of rooms
		$sql="SELECT * FROM halls";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;
		return $num_rows;
	}


	public function idExists($param_id)
	{
		$param_id=sanitize_note($param_id);
		$sql="SELECT * FROM halls WHERE id= '$param_id' ";
		$query=$this->DB->query($sql);
		$num_rows=$query->num_rows;;

		if ($num_rows!=0) {
			return true;
		}
	}	



	public function tpanelHalls () {
		$sql = "SELECT * FROM halls";
		$query = $this->DB->query($sql);
		$num_rows = $query->num_rows;
		if ($num_rows!=0) {
			while ($row=$query->fetch_assoc()) {
					###BREAKING OUT
					?>
	                 <tr class="row100" hall-id="<?php echo $row['id'] ?>">
	                  <td ondblclick="disabled()" class="column100 column2" data-column="column2"></td>
	                  <td ondblclick="disabled()" class="column100 column3" data-column="column3"><input type="text" hall-name-id="<?php echo $row['id'] ?>" name="category" value="<?php echo $row['name'] ?>" ></td>
	                  <td ondblclick="disabled()" class="column100 column4" data-column="column4"><input type="number" hall-cost-id="<?php echo $row['id'] ?>" name="cost" value="<?php echo $row['price'] ?>" min="0"></td>
	                  <td class="column100 column1" data-column="column1"><span class="btn btn-sm btn-danger"  onclick="deleteHall(<?php echo $row['id'] ?>)"><i class="fa fa-trash-o" style="color:white;"></i></span></td>
	                  <td class="column100 column1" data-column="column1"><span class="btn btn-sm btn-success" onclick="editHall(<?php echo $row['id'] ?>)">Update</span></td>                             
	                </tr>
					<?php
					###BREAKING IN
				}	
		}
	}


}

?>