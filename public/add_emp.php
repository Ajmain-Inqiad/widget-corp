<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	

<?php
	$emp = $_GET["id"];
	if(isset($_POST["submit"])){
		$user_dept = $_POST["dept"];
		$emp_salary = $_POST["salary"];
		$emp_bonus = $_POST["bonus"];
		$emp_tax = 0;
		if($emp_salary>10000){
			$emp_tax = ceil ($emp_salary * 0.07);
			$emp_salary = $emp_salary - $emp_tax; 
		}
		$emp_total = $emp_salary + $emp_bonus;
		$emp_last_paid = date('m');
		$sql = "select * from cv_basic join cv_photo on cv_basic.cv_id = cv_photo.cv_id where cv_basic.cv_id = {$emp}";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$emp_name=$row["name"];
		$emp_email = $row["email"];
		$emp_nid = $row["nid"];
		$emp_gen = $row["gender"];
		$emp_phn = $row["phone"];
		$emp_job_type = $row["job_type"];
		$emp_image = $row["image"];
		$emp_job_cat = $row["job_cat"];
		$sql1 = "insert into employee_basic (emp_name, emp_email, emp_nid, emp_gender, emp_phone, emp_job_type, emp_job_time, emp_dept, emp_image) values ('{$emp_name}', '{$emp_email}', '{$emp_nid}', '{$emp_gen}', '{$emp_phn}', '{$emp_job_type}', '{$emp_job_cat}', '{$user_dept}', '{$emp_image}')";
		$result = mysqli_query($connection, $sql1);
		$result2 = mysqli_query($connection, "SHOW TABLE STATUS LIKE 'employee_basic'");
		$row = $result2->fetch_assoc();
		$id = --$row['Auto_increment'];
		
		if($emp_job_cat === "full"){
			$query1 = "insert into employee_full values ({$id}, '{$emp_name}', '{$emp_job_type}', {$emp_salary}, {$emp_bonus}, {$emp_tax}, {$emp_total}, {$emp_last_paid})";
			$result = mysqli_query($connection, $query1);
			$pass = rand(0,100000);
			$query2 = "insert into employee_log (emp_id, emp_name, emp_password) values ({$id}, '{$emp_name}', $pass)";
			$result = mysqli_query($connection, $query2);
			if($result){
				redirect_to("confirm_emp_mail.php?id={$id}");
			}
		}
		else{
			$query2 = "insert into employee_part values ({$id}, '{$emp_name}', '{$emp_job_type}', {$emp_salary}, {$emp_bonus}, {$emp_tax}, {$emp_total}, {$emp_last_paid})";
			$result = mysqli_query($connection, $query2);
			$pass1 = rand(0,100000);
			$query2 = "insert into employee_log (emp_id, emp_name, emp_password) values ({$id}, '{$emp_name}', $pass1)";
			$result = mysqli_query($connection, $query2);
			if($result){
				redirect_to("confirm_emp_mail.php?id={$id}");
			}
		}
		
	}

?>
<div id="main">
	<div id="navigation">
		<br/>
		<a href="admin.php"> &laquo; Main Menu</a>
	</div>

	<div id="page">
	
		<form action="add_emp.php?id=<?php echo $emp ; ?>" method = "post">
			<br/>
			Department : <input type = "text" name="dept" value="" required><br/><br/>
			Salary : <input type = "number" name = "salary" value = "" required><br/><br/>
			Bonus :  <input type = "number" name = "bonus" value = "" required><br/>

			<br/>
			<input type = "submit" name = "submit" value = "Add Employee">
		</form>
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>