<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_emp_logged_in(); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
$employee_name = $_SESSION["emp_name"];

?>
<div id="main">

	<div id="navigation">
		<ul class="subjects">
			<li class="selected"><a href="complain.php">Complain Box</a></li>
			<li class="selected"><a href="basic_emp_info.php">Employee Basic Info</a></li>
			<li class="selected"><a href="change_pass.php">Change Password</a></li>
			<li class="selected"><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="page">
		<?php echo message(); ?>
		Welcome, <b><?php echo $employee_name; ?></b>
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>	