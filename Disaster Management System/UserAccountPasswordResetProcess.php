<!DOCTYPE html>
<html lang= "en">
<head>
<title>Reset Password</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src= "UserAccountSettings.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "Well.css">
<link rel= "stylesheet" type= "text/css" href= "UserAccountSettings.css">
</head>

<body>
<?php require("Navbar.php");?>	

<div class= "well headingWell"><h3 id= "h31">Reset Your Account Password</h3></div>

<?php
//Verify the account recovery request.
if(isset($_GET['userId']) &&  isset($_GET['uniqueId'])){
	$userId= $_GET['userId'];
	$uniqueId= $_GET['uniqueId'];
	
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	
	$query= "select * from passwordrecovery where userId= $userId and uniqueId= $uniqueId";
	$execute= mysqli_query($connection, $query);
	$result= mysqli_num_rows($execute);
	mysqli_close($connection);
	
	//Display the form if request has been validated. 
	if($result> 0){	
		echo "<div class= 'container containerForm'>";
		echo "<form action= 'UserAccountPasswordResetProcess.php' method= 'POST' onsubmit= 'return validateForm();'>";
	
		echo "<label>New Password (5- 10 characters)</label>";
		echo "<input id= 'password' type= 'password' name= 'password' class= 'form-control' onkeyup= 'matchPasswords();'>";
		echo "<br/>";
	
		echo "<label id= 'labelPasswordConfirm'>Confirm New Password</label>";
		echo "<input id= 'passwordConfirm' type= 'password' name= 'passwordConfirm' class= 'form-control' onkeyup= 'matchPasswords();'>";
		echo "<br/>";
	
		echo "<input type= 'hidden' name= 'userId' value= $userId>";
		echo "<input type= 'hidden' name= 'uniqueId' value= $uniqueId>";
		echo "<button type= 'submit' name= 'submit' class= 'btn btn-default'>Save</button>";
		echo "</form>";
		echo "</div>";
	}
	else{
		//echo $userId." ".$uniqueId; 
		header('location:UserAccountPasswordResetProcess.php?error=7');
	}
}
?>
<?php
//Change the password after form submission.
if(isset($_POST['submit'])){
	$userId= $_POST['userId'];
	$uniqueId= $_POST['uniqueId'];
	$password= $_POST['password'];
	$passwordConfirm= $_POST['passwordConfirm'];
	
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	
	//Server side validation. 
	$password= mysqli_real_escape_string($connection, $password);
	$password= trim($password);
	if(empty($password)){header('Location: UserAccountPasswordResetProcess.php?error=2'); die;}
	if($passwordConfirm!= $password){header('Location: UserAccountPasswordResetProcess.php?error=3'); die;}
	if(strlen($password)< 5){header('Location: UserAccountPasswordResetProcess.php?error=4'); die;}
	if(strlen($password)> 10){header('Location: UserAccountPasswordResetProcess.php?error=5'); die;}
	if(preg_match("/\s+/", $password)){header('Location: UserAccountPasswordResetProcess.php?error=6'); die;}
	
	//Checking for duplicate form submission.
	$query= "select * from passwordrecovery where userId= $userId and uniqueId= $uniqueId";
	$execute= mysqli_query($connection, $query);
	$result= mysqli_num_rows($execute);
	if($result== 0){header('location:UserAccountPasswordResetProcess.php?error=7'); die;}
	//Deleting the recovery request.
	$query= "Delete from passwordrecovery where userId= $userId";
	$execute= mysqli_query($connection, $query);
	
	//Changing the password.
	$password= sha1($password, false);		//Encryption.
	$query= "update useraccounttable set password= '$password' where userId= $userId";
	$execute= mysqli_query($connection, $query);
	mysqli_close($connection);
	if($execute== true){
		header('Location: UserAccountPasswordResetProcess.php?changeResult=8');
	}
	else if($execute== false){
		header('Location: UserAccountPasswordResetProcess.php?changeResult=9');
	}	
}
?>
<?php
//Error notification.
if(isset($_GET['error']) || isset($_GET['changeResult'])){
	$code= isset($_GET['error'])? $_GET['error']: $_GET['changeResult'];
	if($code== 2){echo "<div class= 'container containerForm'><h4 class= 'h42'>Fields are empty!</h4></div>";}
	else if($code== 3){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Passwords don't match!</h4></div>";}
	else if($code== 4){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Password too short!</h4></div>";}
	else if($code== 5){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Password too long!</h4></div>";}
	else if($code== 6){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Password can't include spaces!</h4></div>";}
	else if($code== 7){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Link Expired</h4></div>";}	
	else if($code== 8){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h41'>Password Changed!</h4></div>";}
	else if($code== 9){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Couldn't change password! Please try again</h4></div>";}
}
?>
<div class= "container containerForm"><h4 id= "errors" class= "h42"></h4></div>

</body>
</html>