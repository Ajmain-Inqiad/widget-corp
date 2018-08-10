<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once ("classes/class.phpmailer.php"); ?>
<?php require_once ("classes/class.smtp.php"); ?>
<?php require_once ("classes/PHPMailerAutoload.php"); ?>
<?php
//include "classes/Mail.php";
$cv_id = $_GET["id"];
$query = "select email, name from cv_basic where cv_id = {$cv_id}";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug =1;
$mail->SMTPAuth=true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "adproject200@gmail.com";
$mail->Password = "12345678987654321admin";
$mail->SetFrom("adproject200@gmail.com");
$mail->Subject="CV submission";
$mail->Body="We have recieved your CV";
$mail->AddAddress($row["email"]);
if(!$mail->Send()){
	$_SESSION["message"] = "We have got your CV. Thanks ". $row["name"]; 
	redirect_to("form.php");
}
else{
	redirect_to("index.php");
}
?>