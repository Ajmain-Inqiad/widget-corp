<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_emp_logged_in(); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php

$emp_id = $_SESSION["emp_id"];
$emp_name = $_SESSION["emp_name"];

$query = "select emp_name, emp_email from employee_basic where emp_id = {$emp_id} and emp_name = '{$emp_name}'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
if(isset($_POST["submit"])){
	$emp_email = $_POST["email"];
	$com_sub = $_POST["com_type"];
	$complain = $_POST["comment"];
	$required_fields = array("email", "com_type", "comment");
	validate_presence($required_fields);
	if(empty($errors)){
		$query = "insert into complain_box (emp_id, name, email, complain_sub, complain) values ({$emp_id}, '{$emp_name}', '{$emp_email}', '{$com_sub}', '{$complain}')";
		$result = mysqli_query($connection, $query);
		if($result){
			$_SESSION["message"]="Complain has been accepted";
			redirect_to("employee.php");
		}
		else{
			$_SESSION["message"]="Complain has been not accepted";
			redirect_to("complain.php");
		}
	}
	else{
		$_SESSION["message"]="Complain has been not accepted";
		redirect_to("complain.php");
	}
}
?>

<div id="main">

	<div id="navigation">
		<a href="employee.php"> &laquo; Main Page </a>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Complain Box</h2>
		<form action="complain.php" method="post">
			Full Name:<br>
			<input type="text" name="fname" value="<?php echo $emp_name; ?>" required><br><br/>
			Email: <br>
			<input type="text" name="email" value="<?php echo $row["emp_email"]; ?>" required style="width:300px"><br><br>
			Subject:<br>
			<input type="radio" name="com_type" value="quit"> Quit Job<br>
			<input type="radio" name="com_type" value="leave"> Leave for some days<br>
			<input type="radio" name="com_type" value="others"> Others<br><br>
			Reason:<br>
			<textarea rows="8" cols="66" name="comment" placeholder="Enter text here" required></textarea><br>
			<a href="employee.php">Cancel</a> &nbsp; <input type="submit" name="submit" value="Submit">
		</form>
	
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>	









