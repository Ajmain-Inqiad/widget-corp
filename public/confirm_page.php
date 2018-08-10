<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	

<div id="main">

	<div id="navigation">
		
	</div>
	<div id="page">
		<br/>
		<button><a href="admin.php" style="text-decoration:none">Continue as Admin</a></button> &nbsp; <button><a href="employee.php" style="text-decoration:none">Continue as Employee</a></button>
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>	