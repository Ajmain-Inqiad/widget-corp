<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_emp_logged_in(); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
$emp_name = $_SESSION["emp_name"];
$emp_id = $_SESSION["emp_id"];
if(isset($_POST["submit"])){
	$new_password = $_POST["new_pass"];
	$hashed_password = password_encrypt($new_password);
	$query = "update employee_log set emp_password = '{$hashed_password}' where emp_id = {$emp_id} and emp_name = '{$emp_name}'";	
	$result = mysqli_query($connection, $query);
	if($result){
		$_SESSION["message"] = "Password is updated";
		redirect_to("employee.php");
	}
}
?>

<div id="main">

	<div id="navigation">
	
		<a href="employee.php"> &laquo; Main Page</a>
	</div>
	<div id="page">
		<br/>
		<form action="change_pass.php" method="post">
		
			New Password: <input type="password" name="new_pass" value=""><br/> <br/>
			<a href="employee.php">Cancel</a> &nbsp; <input type="submit" name="submit" value="Change">
		
		</form>
	
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>