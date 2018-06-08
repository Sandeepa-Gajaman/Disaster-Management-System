<!DOCTYPE html>
<html lang= "en">
<head>
<title>All Incident Reports</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "Well.css">
<link rel= "stylesheet" type= "text/css" href= "Table.css">
</head>

<body>
<?php session_start(); require("Navbar.php");?>	
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<div class= "well headingWell"><h3 id= "h31">All Reported Incidents</h3></div>

<?php
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	
	$query= "Select * from incident order by date_, time_ desc";
	$execute= mysqli_query($connection, $query);
	$rows= mysqli_num_rows($execute);
	
	//Contains the code to get the table array from the db.
	echo "<div class= 'container'>";
	echo "<table class= 'table table-hover'>";
	echo "<tr><th>Category</th><th>City</th><th>Title</th><th>Threat Level</th><th>Date</th><th>Time</th><th>State</th><th>Approval</th></tr>";	
	while($data= mysqli_fetch_array($execute)){
		$dataReportId= $data['reportId'];
		$dataCategory= $data['category'];
		$dataCity= $data['city'];
		$dataTitle= $data['title'];
		$dataThreatLevel= $data['threatLevel'];
		$dataDate= $data['date_'];
		$dataTime= $data['time_'];
		$dataState= $data['state'];
		$dataApproval= $data['approval'];
		
		if($dataThreatLevel== 1){$dataThreatLevel= "Low";} else if($dataThreatLevel== 2){$dataThreatLevel= "Medium";} else if($dataThreatLevel== 3){$dataThreatLevel= "High";}
		if($dataState== 0){$dataState= "Over";} else if($dataState== 1){$dataState= "Active";}
		if($dataApproval== 0){$dataApproval= "Pending";} else if($dataApproval== 1){$dataApproval= "Approved";} else if($dataApproval== 2){$dataApproval= "Disapproved";}
		
		echo "<tr class= 'clickable-row' data-href= 'IncidentView.php?reportId=$dataReportId'><td>".$dataCategory."</td><td>".$dataCity."</td><td>".$dataTitle."</td><td>".$dataThreatLevel."</td><td>".$dataDate."</td><td>".$dataTime."</td><td>".$dataState."</td><td>".$dataApproval."</td></tr>";
	} 
	echo "</table>";
	echo "</div>";
?>

<?php include("footer.php");?>

<script>
jQuery(document).ready(function($){$(".clickable-row").click(function(){window.location= $(this).data("href");});});
</script>

</body>
</html>