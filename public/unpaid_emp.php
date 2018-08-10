<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php
$emp_full_time = "full";
$emp_part_time = "part";
$sql_part = "select emp_id from employee_basic where emp_job_time = '{$emp_part_time}'";
$result_part = mysqli_query($connection, $sql_part);
$row_part = mysqli_fetch_assoc($result_part);

$sql_full = "select emp_id from employee_basic where emp_job_time = '{$emp_full_time}'";
$result_full = mysqli_query($connection, $sql_full);
$row_full = mysqli_fetch_assoc($result_full);
if(empty($row_part)){
	$sql = "select * from employee_basic join employee_full on employee_basic.emp_id = employee_full.emp_id";
	$result = mysqli_query($connection, $sql);
}
elseif(empty($row_full)){
	$sql = "select * from employee_basic join employee_part on employee_basic.emp_id = employee_part.emp_id";
	$result = mysqli_query($connection, $sql);
}
else{
	$sql = "select * from employee_basic join employee_full on employee_basic.emp_id= employee_full.emp_id join employee_part on employee_basic.emp_id = employee_part.emp_id";
	$result = mysqli_query($connection, $sql);
}
?>
<div id="main">
	<div id="navigation" style="padding-bottom:15%">
		<br/>
		<a href="admin.php"> &laquo; Main Menu</a>
	</div>
	<div id="page" style="padding-left:1em">
		
		<h2>All Employees' Payment</h2>
		<br/>
		<table border=3px  style="width:100%">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Image</th>
				<th>Last Paid (Month)</th>
				<th>Action</th>
			</tr>
			<?php while($output = mysqli_fetch_assoc($result)) { ?>
			<tr>
				<td style="text-align: center"><?php echo $output["emp_id"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_name"]; ?></td>
				<td style="text-align: center"><img src="uploads/<?php echo $output["emp_image"]; ?>" height="50" width="70"></img></td>
				<td style="text-align: center"><?php echo $output["emp_last_paid"]; ?></td>
				<?php if(date('m')>$output["emp_last_paid"]) {?>
					
					<td style="text-align: center"><button><a href="pay_emp.php?id=<?php echo $output["emp_id"]; ?>&time=<?php echo $output["emp_job_time"]; ?>" style="text-decoration:none">Pay</a></button></td>

				<?php } else { ?>
					<td style="text-align: center"> No action required</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div style="margin-top:15%">
	<!--to block footer-->
</div>
<?php include("../includes/layouts/footer.php"); ?>