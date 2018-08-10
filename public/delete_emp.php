<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$emp_id = $_GET["id"];
$emp_job_time = $_GET["time"];

$query = "delete from employee_basic where emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);

$query = "delete from employee_log where emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);

$query = "delete from complain_box where emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);

$query = "select emp_id from admins where emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

if(empty($row)){
	if($emp_job_time == "full"){
		$query = "delete from employee_full where emp_id = {$emp_id}";
		$result = mysqli_query($connection, $query);
		redirect_to("show_emp.php");
	}
	else{
		$query = "delete from employee_part where emp_id = {$emp_id}";
		$result = mysqli_query($connection, $query);
		redirect_to("show_emp.php");
	}
}
else{
	$query = "delete from admins where emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	if($emp_job_time == "full"){
		$query = "delete from employee_full where emp_id = {$emp_id}";
		$result = mysqli_query($connection, $query);
		redirect_to("show_emp.php");
	}
	else{
		$query = "delete from employee_part where emp_id = {$emp_id}";
		$result = mysqli_query($connection, $query);
		redirect_to("show_emp.php");
	}
}



?>

