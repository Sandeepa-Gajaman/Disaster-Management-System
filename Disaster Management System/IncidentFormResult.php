<!DOCTYPE html>
<html lang= "en">
<head>
<title>Result</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>

<body>
<?php session_start(); require("Navbar.php");?>	
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<?php 
if(isset($_GET['status'])){
	$status= $_GET['status'];
	if($status== 1){
		echo "<div class= 'container' style= 'border: 2px solid green; border-radius: 5px; height: 100px; color: green; margin-top: 25px; text-align: center; padding: 8px;'>
<h3 style= 'font-size: 30px;'><span style= 'font-size: 30px;' class= 'glyphicon glyphicon-ok-sign'>
</span>   Incident successfully reported! Please await approval.</h3></div>";
	}
	else if($status== 2){
		echo "<div class= 'container' style= 'border: 2px solid red; border-radius: 5px; height: 100px; color: red; margin-top: 25px; text-align: center; padding: 8px;'>
<h3 style= 'font-size: 30px;'><span style= 'font-size: 30px;' class= 'glyphicon glyphicon-exclamation-sign'>
</span>   Couldn't report incident! Please try again.</h3></div>";
	}
}
?>

<?php include("footer.php");?>

</body>
</html>
