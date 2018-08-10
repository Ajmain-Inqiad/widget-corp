<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
	if(isset($_POST["submit"])){
		$target_file = "uploads/" . basename($_FILES['image']['name']);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if (file_exists($target_file)) {
			$_SESSION["message"] = "Rename Your file ";
			redirect_to("form.php");
		}
		 elseif($_FILES["image"]["size"] > 500000) {
			$_SESSION["message"] = "File is too large.";
			redirect_to("form.php");
		}
		elseif($imageFileType != "jpg" && $imageFileType != "jpeg") {
			$_SESSION["message"] = "Only JPG, JPEG files are allowed.";
			redirect_to("form.php");
		}
		else{
		$user_name =  $_POST["fname"];
		$user_mail = $_POST["mail"];
		$user_phn = $_POST["pnumber"];
		$user_nid = $_POST["nid"];
		$user_gender = $_POST["gender"];
		$user_bd = $_POST["bd"];
		$user_job_type = $_POST["job_type"];
		$user_job_cat = $_POST["job_cat"];
		$user_ssc_scl = $_POST["sscinst"];
		$user_ssc_year = $_POST["sscyear"];
		$user_ssc_major = $_POST["sscmajor"];
		$user_hsc_scl = $_POST["hscinst"]; 
		$user_hsc_year = $_POST["hscyear"]; 
		$user_hsc_major = $_POST["hscmajor"];
		$user_hns_scl = $_POST["hnsinst"]; 
		$user_hns_year = $_POST["hnsyear"]; 
		$user_hns_major = $_POST["hnsmajor"]; 
		$user_exp =	$_POST["exp"];		
		
		$query = "select email from cv_basic where email = '{$user_mail}'";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result);
		
		$query2 = "select nid from cv_basic where nid = '{$user_nid}'";
		$result2 = mysqli_query($connection, $query2);
		$row2 = mysqli_fetch_assoc($result2);
		
		if(empty($row) && empty($row2)){
		
			$query = "INSERT INTO cv_basic (";
			$query .= " name , email , bd , phone, nid, gender, job_type, job_cat, experience ";
			$query .= ") VALUES (";
			$query .= " '{$user_name}', '{$user_mail}', '{$user_bd}', '{$user_phn}', '{$user_nid}', '{$user_gender}', '{$user_job_type}' , '{$user_job_cat}', {$user_exp}";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			
			if($result){
				
				$result = mysqli_query($connection, "SHOW TABLE STATUS LIKE 'cv_basic'");
				$row = $result->fetch_assoc();
				$id = --$row['Auto_increment'];
				
				$ssc = "select exam_id from standard_exam where exam_name = 'ssc'";
				$ssc_result = mysqli_query($connection, $ssc);
				$ssc_row = mysqli_fetch_assoc($ssc_result);
				
				$hsc = "select exam_id from standard_exam where exam_name = 'hsc'";
				$hsc_result = mysqli_query($connection, $hsc);
				$hsc_row = mysqli_fetch_assoc($hsc_result);
				
				$hns = "select exam_id from standard_exam where exam_name = 'honors'";
				$hns_result = mysqli_query($connection, $hns);
				$hns_row = mysqli_fetch_assoc($hns_result);
				
				$image = $_FILES['image']['name'];
				$sql = "INSERT INTO cv_photo ( cv_id, image) VALUES ( $id,'$image')";
				$result2 = mysqli_query($connection, $sql);
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
					$query3 = "INSERT INTO cv_exam (";
					$query3 .= " cv_id, exam_id, institution, year, major";
					$query3 .= ") VALUES (";
					$query3 .= " {$id}, {$ssc_row['exam_id']}, '{$user_ssc_scl}', {$user_ssc_year}, '{$user_ssc_major}'";
					$query3 .= ")";
					$result2 = mysqli_query($connection, $query3);
					if($result2){
						$query4 = "INSERT INTO cv_exam (";
						$query4 .= " cv_id , exam_id , institution , year , major ";
						$query4 .= ") VALUES (";
						$query4 .= " {$id}, {$hsc_row['exam_id']}, '{$user_hsc_scl}', {$user_hsc_year}, '{$user_hsc_major}'";
						$query4 .= ")";
						$result3 = mysqli_query($connection, $query4);
						
						$query5 = "INSERT INTO cv_exam (";
						$query5 .= " cv_id , exam_id , institution , year , major ";
						$query5 .= ") VALUES (";
						$query5 .= " {$id}, {$hns_row['exam_id']} , '{$user_hns_scl}', {$user_hns_year}, '{$user_hns_major}'";
						$query5 .= ")";
						$result4 = mysqli_query($connection, $query5);
					
						if($result3 && $result4){
							$_SESSION["message"] = "CV created.";
							redirect_to("thanks.php?id=$id");
						}
					}
					else{
						$_SESSION["message"] = "CV creation failed.";
						redirect_to("form.php");
					}
				}
				else{
					$_SESSION["message"] = "CV creation failed.";
					redirect_to("form.php");
				}
			}else{
				$_SESSION["message"] = "CV creation failed.";
				redirect_to("form.php");
			}
		}
		else{
			$_SESSION["message"] = "Please provide a different email and different NID.";
			redirect_to("form.php");
		}
	}
}

?>