<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	if(isset($_POST['submit'])){
		
		
		$required_fields = array("userid", "username");
		validate_presence($required_fields);
		
		
		$fields_with_max_length = array("username" => 30);
		validate_max_lengths($fields_with_max_length);
		
		if(empty($errors)){
			$userid = $_POST["userid"];
			$username =  mysql_prep($_POST["username"]);
			$pass = rand(0,100000);
			$hashed_password = password_encrypt($pass);
			
			$query = "INSERT INTO admins (";
			$query .= " emp_id, username, hashed_password";
			$query .= ") VALUES (";
			$query .= " {$userid}, '{$username}', '{$hashed_password}'";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			if($result){
				$_SESSION["message"] = "Admin created.";
				redirect_to("mail_admin.php?id=$userid&pass=$pass");
			}else{
				$_SESSION["message"] = "Admin creation failed.";
			}
		}
	}
	else{
	}

?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Create Admin</h2>
		
		<form action="new_admin.php" method="post">
			<p>Employee ID<sup style="color:red">*</sup>: 
				<input type="number" name="userid" value="" required />
			</p>
			<p>Username<sup style="color:red">*</sup>: 
				<input type="text" name="username" value="" required />
			</p>
			<p>Password<sup style="color:red">*</sup>:
				<input type="password" name="password" value="" disabled />
			</p>
			<input type="submit" name="submit" value="Create Admin" />
		</form>
		<br/>
		<a href="manage_admins.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>