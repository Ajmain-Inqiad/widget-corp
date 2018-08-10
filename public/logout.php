<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	if(isset($_SESSION["emp_id"]) || isset($_SESSION["admin_id"])){
		$_SESSION["emp_id"] = null;
		$_SESSION["emp_name"] = null;
		$_SESSION["admin_id"]= null;
		$_SESSION["username"]= null;
		redirect_to("employee_login.php");
	}
?>
