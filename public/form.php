<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Widget Corp CV</title>
	<link rel="stylesheet" href="stylesheets/bootstrap.min.css">
	<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
	<script src="stylesheets/jquery.min.js"></script>
	<script src="stylesheets/bootstrap.min.js"></script>
	<style>
		h1{ text-align:center;
			color:#4CAF50;}
		input[type=text],[type=number],[type=date],[type=file],[type=email] {
			width: 50%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box; }
			
			input[type=submit] 
			{
			width: 50%;
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			}
			
			
			input[type=submit]:hover 
			{
			background-color: #45a049;
			}

		div {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
			}

	</style>
</head>
<body>

	<div>
		<?php echo message(); ?>
		<h1>Applicant Form</h1>
		<form action="create_cv.php" method="post" enctype="multipart/form-data">
			  Full Name:<br>
			  <input type="text" name="fname" value="" placeholder="Name"><br>
			  Email:<br>
			  <input type="email" name="mail" value="" placeholder="E-mail"><br>
			  Phone Number: <br>
			  <input type="text" name="pnumber" value="" placeholder="Phone number" ><br>
			  Date of Birth: <br>
			  <input type="date" name="bd" value = ""><br><br>
			  <b>Gender</b>:<br>
			  <input type="radio" name="gender" value="male"> Male <br>
			  <input type="radio" name="gender" value="female"> Female <br><br>
			  NID Number:<br>
			  <input type="text" name="nid"  value="" placeholder="NID Number"><br> 
			  <b>Job Type</b>:<br>
			  <input type="radio" name="job_type" value="secretary"> Secretary<br>
			  <input type="radio" name="job_type" value="engineer"> Engineer<br>
			  <input type="radio" name="job_type" value="Stuff"> Office Stuff<br>
			  <input type="radio" name="job_type" value="it"> Information and Technology <br><br>
			  <b>Job Catagory</b>:<br>
			  <input type="radio" name="job_cat" value="full"> Full-time <br>
			  <input type="radio" name="job_cat" value="part"> Part-time <br>
			  <div class="container">
			  <h2>Education:</h2>
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>Degree</th>
					<th>Institution Name</th>
					<th>Year</th>
					<th>Major</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>SSC</td>
					<td><input type="text" name="sscinst" placeholder="School name"><br></td>
					<td><input type="text" name="sscyear" placeholder="Passing Year"><br></td>
					<td><input type="text" name="sscmajor" placeholder="Science/Arts/Commerce"><br></td>
				  </tr>
				  <tr>
					<td>HSC</td>
					<td><input type="text" name="hscinst" placeholder="college name"></td>
					<td><input type="text" name="hscyear" placeholder="Passing Year"><br></td>
					<td><input type="text" name="hscmajor" placeholder="Science/Arts/Commerce"><br></td>
				  </tr>
				  <tr>
					<td>Honors</td>
					<td><input type="text" name="hnsinst" placeholder="University name"></td>
					<td><input type="text" name="hnsyear" placeholder="Passing Year"><br></td>
					<td><input type="text" name="hnsmajor" placeholder="Department"><br></td>
				  </tr>
				  
				</tbody>
			  </table>
			</div>
			   Experience:<br>
			   <input type="number" name="exp" min=0 placeholder="Experience"><br>
			   
			  Upload Image:<br>
			  <input type="file" accept=".jpg,.jpeg,.png" name="image"/>
			  <input type="submit" name="submit" value="Submit">
		</form>

	</div>

</body>
</html>