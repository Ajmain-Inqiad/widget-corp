<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php

$cv_id = $_GET["id"];

$query = "select email from cv_basic where cv_id = {$cv_id}";
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
			mail to: <input type="text" style ="width: 200px" name="to" value="<?php echo $row["email"]; ?>">
			<br><br/>
			subject: <input type="text" name="sub">
			<br><br/>
			body: <input type="text" name="body" style ="width:600px; height:80px" value="Your Interview will be held on ">
			<br><br/>
			<input type="submit" value="click">
		</form>
	</div>

</div>
<?php include("../includes/layouts/footer.php"); ?>