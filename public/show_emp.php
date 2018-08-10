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
if(isset($_POST["search"])){
	$emp_name = $_POST["search_name"];
	if(empty($row_part)){
	$sql = "select * from employee_basic join employee_full on employee_basic.emp_id = employee_full.emp_id where employee_basic.emp_name like '{$emp_name}%'";
	$result = mysqli_query($connection, $sql);
	}
	elseif(empty($row_full)){
		$sql = "select * from employee_basic join employee_part on employee_basic.emp_id = employee_part.emp_id where employee_basic.emp_name like '{$emp_name}%'";
		$result = mysqli_query($connection, $sql);
	}
	else{
		$sql = "select * from employee_basic join employee_full on employee_basic.emp_id= employee_full.emp_id join employee_part on employee_basic.emp_id = employee_part.emp_id where employee_basic.emp_name like '{$emp_name}%'";
		$result = mysqli_query($connection, $sql);
	}
}



?>
<div id="main">
	<div id="page" style="padding-left:1em">
		<a href="admin.php"> &laquo; Main Menu</a><br/><br/>
		<form action="show_emp.php" method="post">

				Name: <input type="text" name="search_name" value=""> &nbsp;
				<input type="submit" name="search" value="Search Via Name">

		</form>
		<br/>
		
		<h2>All Employees</h2>
		<br/>
		<table border=3px  style="width:100%">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>National ID</th>
				<th>Job type</th>
				<th>Job Time</th>
				<th>Department</th>
				<th>Basic Salary</th>
				<th>Tax of Employee</th>
				<th>Total Salary</th>
				<th>Image</th>
				<th>Action</th>
			</tr>
			<?php while($output = mysqli_fetch_assoc($result)) { ?>
			<tr>
				<td style="text-align: center"><?php echo $output["emp_id"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_name"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_email"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_phone"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_nid"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_job_type"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_job_time"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_dept"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_salary"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_tax"]; ?></td>
				<td style="text-align: center"><?php echo $output["emp_total"]; ?></td>
				<td style="text-align: center"><img src="uploads/<?php echo $output["emp_image"]; ?>" height="50" width="70"></img></td>
				<td style="text-align: center"><a href="delete_emp.php?id=<?php echo $output["emp_id"]; ?>&time=<?php echo $output["emp_job_time"] ;?>" onclick="return confirm('Are you sure?')">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div style="margin-top:15%">
	<!--to block footer-->
</div>
<?php include("../includes/layouts/footer.php"); ?>