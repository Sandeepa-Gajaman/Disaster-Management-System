<!DOCTYPE html>
<html lang= "en">
<head>
<title>Incidents</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

<link rel= "stylesheet" type= "text/css" href= "Well.css">
<link rel= "stylesheet" type= "text/css" href= "Table.css">
</head>

<body>
<?php session_start(); require("Navbar.php");?>	

<div class= "well headingWell"><h3 id= "h31">Database Of All Approved Incidents</h3></div>

<?php
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	
	try{
		$query= "Select * from incident where approval= 1 order by date_, time_ desc";
		$execute= mysqli_query($connection, $query);
		$rows= mysqli_num_rows($execute);
	}
	catch(Exception $e){
		header('location:GeneralErrors.php?error=3');
	}
?>
<div class="container">
<div class="table-responsive">

<table id="report_data" class="table table-striped table-bordered">
<thead>
<tr>
<td>Category</td>
<td>City</td>
<td>Title</td>
<td>Severity</td>
<td>Date</td>
<td>Time</td>
<td>State</td>
</tr>
</thead>
<?php
while($data = mysqli_fetch_array($execute)){
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

    echo "<tr class= 'clickable-row' data-href= 'IncidentView.php?reportId=$dataReportId'>";
    echo "<td>".$dataCategory."</td>";
	echo "<td>".$dataCity."</td>";
	echo "<td>".$dataTitle."</td>";
    echo "<td>".$dataThreatLevel."</td>";
    echo "<td>".$dataDate."</td>";
    echo "<td>".$dataTime."</td>"; 
	echo "<td>".$dataState."</td>";
    echo "</tr>";
}
?>
</table>

</div>
</div>
<?php include("footer.php");?>
 
 <script>
 $(document).ready(function(){$('#report_data').DataTable();});
 
 jQuery(document).ready(function($){$(".clickable-row").click(function(){window.location= $(this).data("href");});});
 </script>

</body>
</html>