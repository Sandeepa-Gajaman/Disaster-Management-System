<!DOCTYPE html>
<html lang= "en">
<head>
<title>Login to continue</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>

<body>
<?php session_start(); require("Navbar.php");?>	

<?php 
echo "<div class= 'container' style= 'border: 2px solid red; border-radius: 5px; height: 100px; color: red; margin-top: 25px; text-align: center; padding: 8px;'>
<h3 style= 'font-size: 30px;'><span style= 'font-size: 30px;' class= 'glyphicon glyphicon-exclamation-sign'>
</span>   Please login to continue.</h3></div>";
?>

<?php include("footer.php");?>

</body>
</html>