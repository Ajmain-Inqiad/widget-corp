		<div id="footer" style="height:50px">
			<a href="form.php" target="_blank" style="color:powderblue">Drop Your CV here </a><br/><br/>
			Copyright <?php echo date("Y"); ?>, Widget Corp
		</div>
	
	
	</body>
</html>
<?php
	if(isset($connection)){
		mysqli_close($connection);
	}
?>