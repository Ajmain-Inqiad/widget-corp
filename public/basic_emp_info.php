<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_emp_logged_in(); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php

$emp_id = $_SESSION["emp_id"];
$emp_name = $_SESSION["emp_name"];

$query = "select emp_job_time from employee_basic where emp_id = {$emp_id} and emp_name = '{$emp_name}'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
if($row["emp_job_time"] == "full"){
	$query = "select * from employee_basic join employee_full on employee_basic.emp_id = employee_full.emp_id where employee_basic.emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
}
else{
	$query = "select * from employee_basic join employee_full on employee_basic.emp_id = employee_full.emp_id where employee_basic.emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
}
?>

<div id="main">
	<div id="navigation">
		<a href="employee.php"> &laquo; Main Page</a>
	</div>
	<div id="page">
	
		<h2>Basic Info of <?php echo $emp_name; ?></h2><br/>
		<img src="uploads/<?php echo $row["emp_image"]; ?>" height="100" width="100"></img><br/><br/>
		Employee ID: <?php echo $row ["emp_id"] ;?> <br/><br/>
		Full Name: <?php echo $row ["emp_name"] ;?> <br/><br/>
		Email: <?php echo $row["emp_email"]; ?> <br/><br/>
		Phone: <?php echo $row ["emp_phone"] ;?> <br/><br/>
		Job Type: <?php echo $row ["emp_job_type"] ;?> <br/><br/>
		Job Time: <?php echo $row ["emp_job_time"] ;?> <br/><br/>
		Department: <?php echo $row["emp_dept"] ;?> </br><br/>
		Basic Salary: <?php echo $row["emp_salary"];?> tk <br/><br/>
		Tax of Employee: <?php echo $row["emp_tax"];?> tk <br/><br/>
		Last Paid: Month <?php echo $row["emp_last_paid"];?> <br/><br/>
		<a href="edit_emp_info.php">Edit Your Mail and Phone Number</a>	
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>