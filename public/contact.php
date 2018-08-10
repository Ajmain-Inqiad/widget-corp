<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?> <!--going back to the parent directory to access the function file-->
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php find_selected_page(true); ?>

<div id="main">
	<div id="navigation">
		<?php echo public_navigation($current_subject, $current_page); ?>
		<br/>
		<a href="employee_login.php">Login</a>
		<br/>
		<a href="contact.php">Contact Info with Map</a><br/>
		<a href="form.php" target="_blank">Drop Your CV here </a>
	</div>
	<div id="page">
		<h1 style="color:#8D0D19;">Contact Info with Map</h1>
		<address>
			<h3>Widget Corporation</h3>
			Mohakhali, Dhaka<br/>
			Email: adcse370@gmail.com<br/>
			Phone: 017-XXXXXXXX
		</address>
		<br/>
		<a href="map_view.php">Location in Google Map</a>
		
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>