<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once ("classes/class.phpmailer.php"); ?>
<?php require_once ("classes/class.smtp.php"); ?>
<?php require_once ("classes/PHPMailerAutoload.php"); ?>
<?php 
//include "classes/Mail.php";
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
$mail->Subject=$_POST["sub"];
$mail->Body=$_POST["body"];
$mail->AddAddress($_POST["to"]);
if(!$mail->Send()){
	redirect_to("search_emp.php");
}
else{
	redirect_to("admin.php");
}
?>