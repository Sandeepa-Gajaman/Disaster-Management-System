<!DOCTYPE html>
<html lang= "en">
<head>
<title>Emergency Contacts</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "EmergencyContactsStyle.css">
</head>

<body>
<?php session_start(); include("Navbar.php");?>	

<div id= "well1" class= "well"><h3 id= "h31">Here is a list of important contact numbers in case of an emergency</h3></div>

<div class= "container">
<table id= "table1" class= "table table-hover">
<tr><th>Service</th><th>Contact Number</th></tr>
<tr><td>Sri Lanka Police</td><td>119, 0112433333</td></tr>
<tr><td>Fire and Rescue</td><td>110, 0112422222</td></tr>
<tr><td>Accident Service</td><td>0112691111</td></tr>
<tr><td>Bomb Disposal</td><td>0112434251</td></tr>
<tr><td>St.Johns Ambulance</td><td>0112437744</td></tr> 
<tr><td>Colombo Municipal Council</td><td>0112684290</td></tr>
</table>
</div>

<?php include("footer.php");?>

</body>
</html>