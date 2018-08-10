<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php

$query = "select * from complain_box join employee_basic on complain_box.emp_id = employee_basic.emp_id";
$result = mysqli_query($connection, $query);

?>
<div id="main">
	<div id="navigation" style="padding-bottom:15%">
		<br/>
		<a href="admin.php"> &laquo; Main Menu</a>
	</div>
	<div id="page" style="padding-left:1em">
		
		<h2>All Employees' Complain</h2>
		<br/>
		<table border=3px  style="width:100%">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Image</th>
				<th>Email</th>
				<th>Message</th>
			</tr>
			<?php while($output = mysqli_fetch_assoc($result)) { ?>
			<tr>
				<td style="text-align: center"><?php echo $output["emp_id"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_name"]; ?></td>
				<td style="text-align: center"><img src="uploads/<?php echo $output["emp_image"]; ?>" height="50" width="70"></img></td>
				<td><?php echo $output["emp_email"]; ?></td>
				<td><?php echo $output["complain"]; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div style="margin-top:15%">
	<!--to block footer-->
</div>
<?php include("../includes/layouts/footer.php"); ?>