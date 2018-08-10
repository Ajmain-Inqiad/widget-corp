<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php

$emp_id = $_GET["id"];
$emp_job_time = $_GET["time"];
if($emp_job_time == "full"){
	$query = "select emp_last_paid from employee_full where emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$new_pay = ++$row["emp_last_paid"];
	if($new_pay == 13){
		$new_pay = 1;
	}
	$query = "update employee_full set emp_last_paid = {$new_pay} where emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	redirect_to("unpaid_emp.php");
}
else{
	$query = "select emp_last_paid from employee_part where emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$new_pay = ++$row["emp_last_paid"];
	$query = "update employee_part set emp_last_paid = {$new_pay} where emp_id = {$emp_id}";
	$result = mysqli_query($connection, $query);
	redirect_to("unpaid_emp.php");
}
?>