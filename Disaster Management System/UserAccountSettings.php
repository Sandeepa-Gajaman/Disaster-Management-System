<!DOCTYPE html>
<html lang= "en">
<head>
<title>Account Settings</title>
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
<?php session_start(); require("Navbar.php");?>	
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<div class= "well headingWell"><h3 id= "h31">Change Account Password</h3></div>

<?php
	echo "<div class= 'container containerForm'>";
	echo "<form action= 'UserAccountSettings.php' method= 'POST' onsubmit= 'return validateForm();'>";
	
	echo "<label>New Password (5- 10 characters)</label>";
	echo "<input id= 'password' type= 'password' name= 'password' class= 'form-control' onkeyup= 'matchPasswords();'>";
	echo "<br/>";
	
	echo "<label id= 'labelPasswordConfirm'>Confirm New Password</label>";
	echo "<input id= 'passwordConfirm' type= 'password' name= 'passwordConfirm' class= 'form-control' onkeyup= 'matchPasswords();'>";
	echo "<br/>";
	
	echo "<button type= 'submit' name= 'submit' class= 'btn btn-default'>Save</button>";
	echo "</form>";
	echo "</div>";
?>
<?php
if(isset($_POST['submit'])){
	$password= $_POST['password'];
	$passwordConfirm= $_POST['passwordConfirm'];
	
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	$userId= $_SESSION['userId'];
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	//Server side validation.
	$password= mysqli_real_escape_string($connection, $password);
	$password= trim($password);
	if(empty($password)){header('Location: UserAccountSettings.php?error=2'); die;}
	if($passwordConfirm!= $password){header('Location: UserAccountSettings.php?error=3'); die;}
	if(strlen($password)< 5){header('Location: UserAccountSettings.php?error=4'); die;}
	if(strlen($password)> 10){header('Location: UserAccountSettings.php?error=5'); die;}
	if(preg_match("/\s+/", $password)){header('Location: UserAccountSettings.php?error=8'); die;}
	
	$password= sha1($password, false);	//Encryption.
	$query= "update useraccounttable set password= '$password' where userId= $userId";
	$execute= mysqli_query($connection, $query);
	mysqli_close($connection);
	if($execute== true){
		header('Location: UserAccountSettings.php?changeResult=6');
	}
	else if($execute== false){
		header('Location: UserAccountSettings.php?changeResult=7');
	}
}
?>
<?php
if(isset($_GET['error']) || isset($_GET['changeResult'])){
	$code= isset($_GET['error'])? $_GET['error']: $_GET['changeResult'];
	if($code== 2){echo "<div class= 'container containerForm'><h4 class= 'h42'>Fields are empty!</h4></div>";}
	else if($code== 3){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Passwords don't match!</h4></div>";}
	else if($code== 4){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Password too short!</h4></div>";}
	else if($code== 5){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Password too long!</h4></div>";}
	else if($code== 8){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Password can't include spaces!</h4></div>";}
	else if($code== 6){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h41'>Password changed!</h4></div>";}
	else if($code== 7){echo "<div id= 'errors2' class= 'container containerForm'><h4 class= 'h42'>Couldn't change password! Please try again.</h4></div>";}	
}
?>
<div class= "container containerForm"><h4 id= "errors" class= "h42"></h4></div>

<?php include("footer.php");?>
</body>
</html>