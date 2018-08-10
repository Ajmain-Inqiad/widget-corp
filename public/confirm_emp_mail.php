<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	

<?php

$emp_id = $_GET["id"];

$query = "select employee_basic.emp_name, employee_basic.emp_email, employee_log.emp_password from employee_basic join employee_log on employee_basic.emp_id = employee_log.emp_id where employee_basic.emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$employee_password = $row["emp_password"];
$hashed_password = password_encrypt($row["emp_password"]);
$query = "update employee_log set emp_password = '{$hashed_password}' where emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);
?>

<div id="main">

	<div id="navigation">
	<br/>
		<a href="admin.php"> &laquo; Main Menu</a>
	</div>
	<div id="page">
		<form action="sendingmail.php" method="post">
			mail to: <input type="text" style ="width: 200px" name="to" value="<?php echo $row["emp_email"]; ?>">
			<br><br/>
			subject: <input type="text" name="sub">
			<br><br/>
			body: <input type="text" name="body" style ="width:500px; height:80px" value="Your employee id: <?php echo $emp_id; ?>, Your Login name: <?php echo $row["emp_name"];?> and, Your Password: <?php echo $employee_password; ?>">
			<br><br/>
			<input type="submit" value="click">
		</form>
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>