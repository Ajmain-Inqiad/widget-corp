<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php

$emp_id = $_GET["id"];
$emp_pass = $_GET["pass"];

$query = "select employee_basic.emp_email, admins.username from employee_basic join admins on employee_basic.emp_id = admins.emp_id where employee_basic.emp_id = {$emp_id}";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

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
			body: <input type="text" name="body" style ="width:600px; height:80px" value="Your employee id: <?php echo $emp_id; ?>, Your Admin Login name: <?php echo $row["username"];?> and, Your Password: <?php echo $emp_pass; ?>">
			<br><br/>
			<input type="submit" value="click">
		</form>
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>