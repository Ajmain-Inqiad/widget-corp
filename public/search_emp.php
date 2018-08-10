<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php

	$sql = "select * from cv_basic join cv_photo on cv_basic.cv_id= cv_photo.cv_id join cv_exam on cv_basic.cv_id = cv_exam.cv_id where cv_exam.exam_id = 3";
	$result = mysqli_query($connection, $sql);
	if(isset($_POST["search"])){
		$user_name = $_POST["search_name"];
		$sql ="select * from cv_basic join cv_photo on cv_basic.cv_id= cv_photo.cv_id join cv_exam on cv_basic.cv_id = cv_exam.cv_id where cv_basic.name like '{$user_name}%' and cv_exam.exam_id = 3";
		$result = mysqli_query($connection, $sql);
	}

?>
<div id="main">
	<div id="page" style="padding-left:1em">
		<a href="admin.php"> &laquo; Main Menu</a>
		<h2>Add Employee</h2>
		<form action="search_emp.php" method="post">

				Name: <input type="text" name="search_name" value=""><br/><br/>
				<input type="submit" name="search" value="Search Via Name">

		</form>
		<br/>
		<table border=2px width="100%" >
			<tr>
				<th style="text-align: left">Name</th>
				<th>Email</th>
				<th>Birth-date</th>
				<th>Phone</th>
				<th>National ID</th>
				<th>Gender</th>
				<th>Job type</th>
				<th>Job Category</th>
				<th>Experience</th>
				<th>University</th>
				<th>Passing year</th>
				<th>Department</th>
				<th>Image</th>
				<th>Action</th>
			</tr>
			<?php while($output = mysqli_fetch_assoc($result)) { ?>
			<tr>
					<td style="text-align: center"><?php echo $output["name"]; ?></td>
					<td style="text-align: center"><?php echo $output["email"]; ?></td>
					<td style="text-align: center"><?php echo $output["bd"]; ?></td>
					<td style="text-align: center"><?php echo $output["phone"]; ?></td>
					<td style="text-align: center"><?php echo $output["nid"]; ?></td>
					<td style="text-align: center"><?php echo $output["gender"]; ?></td>
					<td style="text-align: center"><?php echo $output["job_type"]; ?></td>
					<td style="text-align: center"><?php echo $output["job_cat"]; ?></td>
					<td style="text-align: center"><?php echo $output["experience"]; ?></td>
					<td style="text-align: center"><?php echo $output["institution"]; ?></td>
					<td style="text-align: center"><?php echo $output["year"]; ?></td>
					<td style="text-align: center"><?php echo $output["major"]; ?></td>
					<td style="text-align: center"><image src="uploads/<?php echo $output["image"]; ?>" height="50" width="70"></image></td>
					<td style="text-align: center"><button><a target='_blank' style="text-decoration:none" href="add_emp.php?id=<?php echo $output["cv_id"];?>">Add</a></button></td>
			</tr>
			<?php } ?>
		</table>
		<br/>
	</div>
</div>
<div style="margin-top:15%">
	<!--to block footer-->
</div>
