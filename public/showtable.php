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
		$user_ex = $_POST["search_ex"];
		$user_job_type= $_POST["search_type"];
		$user_job_cat = $_POST["search_full"];
		$sql ="select * from cv_basic join cv_photo on cv_basic.cv_id= cv_photo.cv_id join cv_exam on cv_basic.cv_id = cv_exam.cv_id where cv_basic.experience > {$user_ex} and cv_basic.job_type='{$user_job_type}' and cv_basic.job_cat='{$user_job_cat}' and cv_exam.exam_id = 3 order by cv_basic.experience desc";
		$result = mysqli_query($connection, $sql);
	}

?>
<div id="main">
	<div id="page" style="padding-left:1em">
		<a href="admin.php"> &laquo; Main Menu</a>
		<h2>All CV's</h2>
		<form action="showtable.php" method="post">
			Experience:
			<input type="number" name="search_ex" min = 0 value="0">&nbsp;
			Job Type: <input type="text" name="search_type" value="engineer">&nbsp;
			Job Category: <input type="radio" name="search_full" value="full" checked>Full time
			<input type="radio" name="search_full" value="part">Part time &nbsp;
			<input type="submit" name="search" value="Search">
			
		</form>
		<br/>
		<table border=3px  style="width:100%">
			<tr>
				<th style="text-align: left">Name</th>
				<th >Email</th>
				<th >Birth-date</th>
				<th >Phone</th>
				<th >National ID</th>
				<th >Gender</th>
				<th >Job type</th>
				<th >Job Category</th>
				<th >Experience</th>
				<th >University</th>
				<th >Passing year</th>
				<th>Department</th>
				<th >Image</th>
				<th> Interview </th>
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
				<td style="text-align: center"><button><a href="interview_mail.php?id=<?php echo $output["cv_id"];?>" style="text-decoration:none">Call</a></button></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div style="margin-top:15%">
	<!--to block footer-->
</div>
