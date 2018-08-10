<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?> <!--going back to the parent directory to access the function file-->
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>	
<?php find_selected_page(); ?>

<div id="main">
	<div id="navigation">
		<br/>
		<a href="admin.php"> &laquo; Main Menu</a>
		<br/>
		<?php echo navigation($current_subject, $current_page); ?>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Create Subject</h2>
		
		<form action="create_subject.php" method="post">
			<p>Menu Name<sup style="color:red">*</sup>: 
				<input type="text" name="menu_name" value="" required/>
			</p>
			<p>Position<sup style="color:red">*</sup>:
				<select name="position">
					<?php
						$subject_set = find_all_subjects(false);
						$subject_count = mysqli_num_rows($subject_set);
						for($count=1; $count<=$subject_count+1; $count++){
							echo "<option value=\"{$count}\">{$count}</option>";
						}
					?>
					
				</select>
			</p>
			<p>Visible<sup style="color:red">*</sup>:
				<input type="radio" name="visible" value="0" />No
				&nbsp;
				<input type="radio" name="visible" value="1" />Yes
			</p>
			<input type="submit" name="submit" value="Create Subject" />
		</form>
		<br/>
		<a href="manage_content.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>