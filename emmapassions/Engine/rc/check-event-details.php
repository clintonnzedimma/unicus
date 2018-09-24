<?php 
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/env/ftf.php';
$user =  new User();
if($user->IsLoggedIn()) :
	$the_user = new User_Singleton($_SESSION['voucher']);
?>


<div align="left">	
	<h3>Event Details</h3>
	<p>
		<b>Name</b> : <span><?php echo $the_user->event->get('name_of_event') ?></span>
		<br>
		<b>Description</b> : <span> <?php echo $the_user->event->get('description') ?></span>
		<br>
		<b>Location</b> : <span><?php echo $the_user->event->get('location') ?></span>
		<br>
		<b>Happening On</b> : <span> <?php echo $the_user->event->get('start_date') ?></span>
	</p>

	<h3>User Details</h3>
	<p>
		<b>Full Name</b> : <span><?php echo $the_user->get('full_name') ?></span>
		<br>
		<b>Phone</b> : <span> <?php echo $the_user->get('phone') ?></span>
		<br>
		<b>Email</b> : <span> <?php echo $the_user->get('email') ?> </span>
		<br>
		<b>Registered On</b> : <span> <?php echo $the_user->get('date_reg') ?></span>
	</p>	
</div>

<form method="post">
	<?php
		if (submit_btn_clicked('log-out')) {
			$user->logOutVoucher();
			header("Location:inquire.php");
			exit();			
		}

	?>
	<input type="submit" name="log-out" value="log out">	
</form>
<?php endif ?>


<?php if (!$user->IsLoggedIn()): 
			header("Location:inquire.php");
			exit();	
?>
	You need to be logged in
<?php endif ?>