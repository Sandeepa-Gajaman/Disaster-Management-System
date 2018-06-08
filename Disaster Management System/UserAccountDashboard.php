<!DOCTYPE html>
<html lang= "en">
<head>
<title>Dashboard: User</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "UserAccountDashboard.css">
</head>

<body>
<?php session_start(); require("Navbar.php");?>	
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<div class= "container customContainer">
<a href= "IncidentForm.php"><div class= "well customWell"><p>Report New Incident</p></div></a>
<a href= "UserMyIncidents.php"><div class= "well customWell"><p>My Incidents </p></div></a>
<a href= "UserAccountSettings.php"><div class= "well customWell"><p>Change Account Password</p></div></a>
</div>

<?php include("footer.php");?>

</body>
</html>