<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<h2>Admin Menu</h2>
		<p>Welcome to admin area, <b><?php echo htmlentities($_SESSION["username"]); ?></b>.</p>
		<ul>
			<li><a href="manage_content.php">Manage Website Content</a></li>
			<li><a href="manage_admins.php">Manage Admin Users</a></li>
			<li><a href="showtable.php">Show All CV</a></li>
			<li><a href="search_emp.php">Add New Employee</a></li>
			<li><a href="show_emp.php">Show All Employee</a></li>
			<li><a href="unpaid_emp.php">Payment</a></li>
			<li><a href="show_complain.php">All Compains</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>	