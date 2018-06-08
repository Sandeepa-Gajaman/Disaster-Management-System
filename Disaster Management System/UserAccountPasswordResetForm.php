<!DOCTYPE html>
<html lang= "en">
<head>
<title>Account Recovery</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "Well.css">
<link rel= "stylesheet" type= "text/css" href= "UserAccountSettings.css">
</head>

<body>
<?php require("Navbar.php"); require('PHPMailer/PHPMailerAutoload.php');?>	

<div class= "well headingWell"><h3 id= "h31">Recover Your Account</h3></div>

<?php
	echo "<div class= 'container containerForm'>";
	echo "<form action= 'UserAccountPasswordResetForm.php' method= 'POST'>";
		
	echo "<label id= 'labelEmail'>Enter Email Address</label>";
	echo "<input id= 'email' type= 'email' name= 'email' class= 'form-control'>";
	echo "<br/>";
	
	echo "<button type= 'submit' name= 'submit' class= 'btn btn-default'>Send</button>";
	echo "</form>";
	echo "</div>";
?>
<?php
if(isset($_POST['submit'])){
	$email= $_POST['email'];
	
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	//Server side validation.
	$email= mysqli_real_escape_string($connection, $email);
	$email= trim($email);
	if(empty($email)){header('Location: UserAccountPasswordResetForm.php?error=2'); die;}
	if(preg_match("/\s+/", $email)){header('Location: UserAccountPasswordResetForm.php?error=3'); die;}
	
	//Looks for user account with the specified email address.
	$query= "select userId, userName, fName, email from useraccounttable where email= '$email'";
	$execute= mysqli_query($connection, $query);
	$result= mysqli_num_rows($execute);
	
	//Sending the recovery email.
	if($result> 0){							//Check if the account exists.
		$data= mysqli_fetch_array($execute);
		$userId= $data['userId'];
		$userName= $data['userName'];
		$fName= $data['fName'];
		$email= $data['email'];
		
		//Attempts to find and delete previous, unused account recovery requests from the DB.
		$query= "Select userId from passwordrecovery where userId= $userId";
		$execute= mysqli_query($connection, $query);
		$result= mysqli_num_rows($execute);
		if($result> 0){
			$query= "Delete from passwordrecovery where userId= $userId";
			$execute= mysqli_query($connection, $query);
		}
		$uniqueId= mt_rand(100000, 999999);
		$filePath= "http://localhost:8080/Web%20App/Incident%20Reporting%20App/UserAccountPasswordResetProcess.php";	//Name of the file to access, sent in the recovery email.
		$subject= "Incident Reporting App Account Recovery";
		$message= "<p>Here is your account's recovery link- $filePath?userId=$userId&uniqueId=$uniqueId  <b>Your user name is- '$userName'</b>.</p>";
		$messagePlain= "Here is your account's recovery link- $filePath?userId=$userId&uniqueId=$uniqueId  Your user name is- '$userName'.";
		
		//Inserts new account recovery request to the DB.
		$query= "Insert into passwordrecovery (userId, uniqueId) values ($userId, $uniqueId)";
		$execute= mysqli_query($connection, $query);
		mysqli_close($connection);
		
		//Sets the email object's properties.				***Please enable 'Access by less secure apps' in google account settings.
		$mail = new PHPMailer;								//Creates a new PHPMailer email object.
		//Use the SMTP verbose debugger for advanced SMTP debug information.
		//Connection initialization.
		$mail->isSMTP();                                    // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                             // Enable SMTP authentication
		$mail->Username = 'illuminatinsbm123@gmail.com';    // SMTP username
		$mail->Password = 'galileo123';                     // SMTP password
		$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                  // TCP port to connect to

		$mail->isHTML(true);
		$mail->setFrom('illuminatinsbm123@gmail.com', 'Incident Reporting App Support Team');
		$mail->addAddress($email, $fName);     // Add a recipient
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = $messagePlain;
		
		$mail->SMTPOptions = array('ssl' => array(			//This part is not supposed to be here check this out. This imposes a security risk in which
			'verify_peer' => false,							//the mail server is not verified. 
			'verify_peer_name' => false,
			'allow_self_signed' => true
		));

		if(!$mail->send()) {
			header('Location: UserAccountPasswordResetForm.php?error=5');
			//echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
		} 
		else {
			header('Location: UserAccountPasswordResetForm.php?changeResult=6');
			//echo $userId." ".$uniqueId;
		}
	}
	else if($result== 0){
		header('Location: UserAccountPasswordResetForm.php?error=4');
	}
}
?>
<?php
//Error notification.
if(isset($_GET['error']) || isset($_GET['changeResult'])){
	$code= isset($_GET['error'])? $_GET['error']: $_GET['changeResult'];
	if($code== 2){echo "<div class= 'container containerForm'><h4 class= 'h42'>Field is empty!</h4></div>";}
	else if($code== 3){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Email can't contain white space!</h4></div>";}
	else if($code== 4){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>No account with specified email found!</h4></div>";}
	else if($code== 5){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Couldn't send recovery email! Please try again.</h4></div>";}	
	else if($code== 6){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h41'>Recovery email sent!</h4></div>";}
}
?>
<div class= "container containerForm"><h4 id= "errors" class= "h42"></h4></div>

<?php include("footer.php");?>
</body>
</html>