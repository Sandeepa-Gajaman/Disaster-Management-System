<!DOCTYPE html>
<html lang= "en">
<head>
<title>About Us</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "Well.css">
</head>

<body>
<?php session_start(); require("Navbar.php");?>	

<div class= "well headingWell"><h3 id= "h31">About Us</h3></div>

<div class= "container" align= "center">
<h3>This application helps to report incidents that occur in the Western Province of Sri Lanka.</h3>
</div>

<br/><br/>

<div class= "container" align="center">
<h2>Incidents which you can report</h2>
<br/>
<h4>Natural Disasters</h4>
<h4>Road Side Accidents</h4>
<h4>Fires</h4>
<h4>Electrical Breakdown & Leakages etc.</h4><br>
</div>

<div class= "container" align= "center">
<h2 align="center">Contact Us</h2>
<br/>
<h4><span class="glyphicon glyphicon-earphone"></span>&ensp;&ensp;Phone :&ensp;+94 11 2508070</h4>
<br>
<h4><span class="glyphicon glyphicon-inbox"></span>&ensp;&ensp;Email :&ensp;&ensp;illuminatinsbm123@gmail.com</h4>
</div>

<?php include("footer.php");?>
    
</body>
</html>