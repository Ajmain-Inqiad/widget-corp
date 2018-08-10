<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_emp_logged_in(); ?>

<?php
$emp_id = $_SESSION["emp_id"];
$emp_name = $_SESSION["emp_name"];
$query = "select emp_email, emp_phone from employee_basic where emp_id = {$emp_id} and emp_name = '{$emp_name}'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
if(isset($_POST["submit"])){
	$emp_email = $_POST["new_email"];
	$emp_phone = $_POST["new_phone"];
	$query = "update employee_basic set emp_email = '{$emp_email}', emp_phone = '{$emp_phone}' where emp_id = {$emp_id} and emp_name = '{$emp_name}'";
	$result = mysqli_query($connection, $query);
	if($result){
		$_SESSION["message"] = "Email and Phone number is updated";
		redirect_to("employee.php");
	}
	else{
		$_SESSION["message"] = "Email and Phone number is not updated";
		redirect_to("edit_emp_info.php");
	}
}
?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">

	<div id="navigation">
	
		<a href="employee.php">&laquo; Main Page </a>
		
	</div>
	<div id = "page">
	
		<h2>Change Info</h2>
		<form action="edit_emp_info.php">
		
			Email: <input type="email" name="new_email" value="<?php echo $row["emp_email"]; ?>" style="width:300px" required><br/><br/>
			Phone Number: <input type="text" name="new_email" value="<?php echo $row["emp_phone"]; ?>" style="width:300px" required><br/><br/>
			<a href="employee.php">Cancel</a> &nbsp; <input type="submit" name="submit" value="Change Info">
		
		</form>
	
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>