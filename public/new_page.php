<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?> <!--going back to the parent directory to access the function file-->
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page(); ?>
<?php
	if(!$current_subject){
		redirect_to("manage_content.php");
	}
?>
<?php
	if(isset($_POST['submit'])){
		
		
		$required_fields = array("menu_name", "position", "visible", "content");
		validate_presence($required_fields);
		
		
		$fields_with_max_length = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_length);
		
		if(empty($errors)){
			$subject_id = $current_subject["id"];
			$id = $current_subject["id"];
			$menu_name =  mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];
			$content = mysql_prep($_POST["content"]);
			
			$query .= "INSERT INTO pages (";
			$query .= " subject_id, menu_name, position, visible, content";
			$query .= ") VALUES (";
			$query .= " {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			if($result){
				$_SESSION["message"] = "Page created.";
				redirect_to("manage_content.php?subject=". urlencode($current_subject["id"]));
			}else{
				$message = "Page creation failed.";
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
		<br/>
		<a href="admin.php"> &laquo; Main Menu</a>
		<br/>
		<?php echo navigation($current_subject, $current_page); ?>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Create Page</h2>
		
		<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
			<p>Menu Name<sup style="color:red">*</sup>: 
				<input type="text" name="menu_name" value="" required/>
			</p>
			<p>Position<sup style="color:red">*</sup>:
				<select name="position">
					<?php
						$page_set = find_pages_for_subject($current_subject["id"], false);
						$page_count = mysqli_num_rows($page_set);
						for($count=1; $count<=$page_count+1; $count++){
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
			<p>Content<sup style="color:red">*</sup>:<br/>
				<textarea rows="20" cols="80" name="content"></textarea>
			</p>
			<input type="submit" name="submit" value="Create Page" />
		</form>
		<br/>
		<a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"])?>">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>