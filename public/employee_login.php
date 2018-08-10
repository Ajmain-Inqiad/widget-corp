<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	$username = "";
	$userid = "";
	if(isset($_POST['submit'])){
		
		
		$required_fields = array("username", "password", "userid");
		validate_presence($required_fields);
 
		
		if(empty($errors)){
			$username = $_POST["username"];
			$userid = $_POST["userid"];
			$password = $_POST["password"];
			$found_employee = attempt_emp_login($userid, $username, $password);
			$found_admin = attempt_login($userid, $username, $password);
			
			if($found_employee && $found_admin){
				$_SESSION["emp_id"] = $found_employee["emp_id"];
				$_SESSION["emp_name"] = $found_employee["emp_name"];
				$_SESSION["admin_id"] = $found_admin["id"];
				$_SESSION["username"] = $found_admin["username"];
				redirect_to("confirm_page.php");
				
			}elseif($found_admin){
				$_SESSION["admin_id"] = $found_admin["id"];
				$_SESSION["username"] = $found_admin["username"];
				redirect_to("admin.php");
			}
			elseif($found_employee){
				$_SESSION["emp_id"] = $found_employee["emp_id"];
				$_SESSION["emp_name"] = $found_employee["emp_name"];
				redirect_to("employee.php");
			}
			else{
				$_SESSION["message"] = "Username/Password/UserID is invalid"; 
			}
		}
	}
	else{
		
	}

?>
<?php include("../includes/layouts/header.php"); ?>	
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Login</h2>
		
		<form action="employee_login.php" method="post">
			<p>Employee ID: 
				<input type="number" name="userid" value="<?php echo $userid; ?>" />
			</p>
			<p>Username: 
				<input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
			</p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>