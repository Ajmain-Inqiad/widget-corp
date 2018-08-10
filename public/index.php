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
		<a href="employee_login.php">Login</a><br/>
		<a href="contact.php">Contact Info with Map</a><br/>
		<a href="form.php" target="_blank">Drop Your CV here </a>
	</div>
	<div id="page">
		<?php if($current_page){ ?>
			<h2><?php echo htmlentities($current_page["menu_name"]); ?></h2>
			<?php echo nl2br(htmlentities($current_page["content"])); ?>
		<?php } else{ ?>
			<p>Welcome!</p>
		<?php } ?>
		
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>