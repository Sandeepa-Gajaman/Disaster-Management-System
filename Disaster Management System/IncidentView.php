<!DOCTYPE html>
<html lang= "en">
<head>
<title>Incident Report</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "IncidentViewStyle.css">
</head>

<body>
<?php session_start(); require("Navbar.php");?>	
<?php
if(!isset($_GET['reportId']) || $_GET['reportId']== ''){header('Location:GeneralErrors.php?error=3'); die;}
$reportId= $_GET['reportId'];
$_SESSION['reportId']=$reportId; 							//Extremely important.

$db=mysqli_connect('localhost','root','','incidentreportingapp');
if(!$db){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.

$qry1="Select * from incident WHERE reportId='$reportId' ";
$res1=mysqli_query($db,$qry1);
if(mysqli_num_rows($res1)== 0){header('Location:GeneralErrors.php?error=2'); die;}

$qry="select * from incidentreportimages WHERE reportId='$reportId'";
$res=mysqli_query($db,$qry);

$row1=mysqli_fetch_array($res1);
$title=$row1['title'];
$content=$row1['content'];
$category=$row1['category'];
$date_=$row1['date_'];
$time_=$row1['time_'];
$city=$row1['city'];
$threatLevel=$row1['threatLevel'];
$deaths=$row1['deaths'];
$missing=$row1['missing'];
$severelyInjured=$row1['severelyInjured'];
$minorlyInjured=$row1['minorlyInjured'];
$approval=$row1['approval'];
$state=$row1['state'];
$userId= $row1['userId'];

if($threatLevel== 1){$tempThreatLevel= "Low";} else if($threatLevel== 2){$tempThreatLevel= "Medium";} else if($threatLevel== 3){$tempThreatLevel= "High";}
if($state== 0){$tempState= "Over";} else if($state== 1){$tempState= "Active";}
if($approval== 0){$tempApproval= "Pending";} else if($approval== 1){$tempApproval= "Approved";} else if($approval== 2){$tempApproval= "Disapproved";}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
echo "<div class= 'container-fluid'>";
echo "<div class= 'row'>";////////////First row starts.

echo "<div class= 'col-md-8'>";////////////First column starts.

echo "<div class= 'row'>";
echo "<h3  align= 'center'>".$title."</h3>";
echo "</div>";

echo "<br/><div class= 'row'>";
echo "<div class= 'col-sm-8'><h4 align= 'left'>Category:  ".$category."</h4></div>";
echo "<div class= 'col-sm-4'><h4 align= 'left'>Severity:  ".$tempThreatLevel."</h4></div>";
echo "</div>";

echo "<div class= 'row'>";
echo "<div class= 'col-sm-8'><h4 align= 'left'>Date:  ".$date_."</h4></div>";
echo "<div class= 'col-sm-4'><h4 align= 'left'>Time:  ".$time_."</h4></div>";
echo "</div>";

echo "<div class= 'row'>";
echo "<div class= 'col-sm-8'><h4 align= 'left'>Town:  ".$city."</h4></div>";
echo "<div class= 'col-sm-4'><h4 align= 'left'>Status:  ".$tempState."</h4></div>";
echo "</div>";

if(isset($_SESSION['userId'])){
	if($userId== $_SESSION['userId'] || $_SESSION['userType']== 'manager'){
		echo "<div class= 'row'>";
		echo "<div class= 'col-sm-12'><h4 align= 'left'>Approval:  ".$tempApproval."</h4></div>";
		echo "</div>";
	}
}

echo "<br/><div class= 'row'>";
echo "<div class= 'col-sm-12'><h5>".$content."</h5></div>";
echo "</div>";

echo "<br/><div class= 'row'>";
echo '<table class= "table" align= "center" style= "width: 97%;">';
echo '<tr><th>Deaths</th><th>Missing</th><th>Severely Injured</th><th>Minorly Injured</th></tr>';
echo '<tr><td>'.$deaths.'</td><td>'.$missing.'</td><td>'.$severelyInjured.'</td><td>'.$minorlyInjured.'</td></tr>';
echo "</table>";
echo "</div>";

//Show functions based on account types.
echo "<div class= 'row'>";
echo "<table class= 'table'>";
echo "<tr>";
if(isset($_SESSION['userId'])){
	if($userId== $_SESSION['userId'] || $_SESSION['userType']== 'manager'){
		
		echo "<td>";
		echo "<form method= 'get' action= 'UpdateIncidentForm.php'>";
		echo "<input type= 'hidden' name= 'reportId' value=$reportId>";
		echo "<input type= 'submit' name= 'update' value= 'Edit Report' class= 'btn btn-info functionButton'>";
		echo "</form>";
		echo "</td>";
		
		if($state== 0){
			echo "<td>";
			echo "<form method= 'post' action= 'IncidentViewFunctions.php'>";
			echo "<input type= 'hidden' name= 'reportId' value=$reportId>";
			echo "<input type= 'submit' name= 'setActive' value= 'Mark Incident as Active' class= 'btn btn-primary functionButton'>";
			echo "</form>";
			echo "</td>";
		}
		if($state== 1){
			echo "<td>";
			echo "<form method= 'post' action= 'IncidentViewFunctions.php'>";
			echo "<input type= 'hidden' name= 'reportId' value=$reportId>";
			echo "<input type= 'submit' name= 'setOver' value= 'Mark Incident as Over' class= 'btn btn-warning functionButton'>";
			echo "</form>";
			echo "</td>";
		}
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo "<form method= 'post' action= 'IncidentViewFunctions.php'>";
		echo "<input type= 'hidden' name= 'reportId' value=$reportId>";
		echo "<input type= 'submit' name= 'delete' value= 'Delete Report' class= 'btn btn-danger functionButton'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	}
}

echo "<tr>";
if(isset($_SESSION['userId'])){
	if($_SESSION['userType']== 'manager'){
		if($approval== 0){
			echo "<td>";
			echo "<form method= 'post' action= 'IncidentViewFunctions.php'>";
			echo "<input type= 'hidden' name= 'reportId' value=$reportId>";
			echo "<input type= 'submit' name= 'approve' value= 'Approve Report' class= 'btn btn-success functionButton'>";
			echo "</form>";
			echo "</td>";
			
			echo "<td>";
			echo "<form method= 'post' action= 'IncidentViewFunctions.php'>";
			echo "<input type= 'hidden' name= 'reportId' value=$reportId>";
			echo "<input type= 'submit' name= 'disapprove' value= 'Disapprove Report' class= 'btn btn-danger functionButton'>";
			echo "</form>";
			echo "</td>";
		}	
	}
}
echo "</tr>";
echo "</table>";
echo "</div>";

echo "</div>";////////////First column ends.

echo "<div class= 'col-md-4'>";////////////Second column starts.
echo "<div class= 'container'><div id= 'map1'></div></div>";
echo "</div>";////////////Second column ends.

echo "</div>";//Main row ends.
echo "</div>";

echo "<br/><div class= 'container' style= 'margin-bottom: 70px;'>";
echo "<table class= 'table'>";
echo "<tr>";
if(mysqli_num_rows($res)> 0){
	while($row= mysqli_fetch_array($res)){
		$img= $row['image'];
		echo "<td>";
		echo '<img width="200" height="200" src="data:image;base64,'.$img.'" style= "padding: 5px; border: 1px solid grey; margin: 5px;">'; //uri
		echo "</td";
	}
}
echo "</tr>";
echo "</table>";
echo "</div>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>	

<?php include("footer.php");?>						
<script>
var	y= 6.9016;		//Required to reset the map position.
var x= 79.9600;	

    //seting custom markers for map
    var customColor = {
	High: {iconImage: 'red.png'},
	Medium: {iconImage: 'orange.png'},
	Low: {iconImage: 'yellow.png'}};

//Initializes the map.
function initMap() {
	var map = new google.maps.Map(document.getElementById('map1'), {center: new google.maps.LatLng(6.9016, 79.9600),zoom: 11});
	var infoWindow = new google.maps.InfoWindow;

	// Change this depending on the name of your PHP or XML file (in this case its php).
	downloadUrl('IncidentViewLink.php', function(data) {
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName('marker');

		    Array.prototype.forEach.call(markers, function(markerElem) {
			var reportId = markerElem.getAttribute('reportId');
			var title = markerElem.getAttribute('title');				//**Edited.
			var threatLevel = markerElem.getAttribute('threatLevel');//**Edited.
			var point = new google.maps.LatLng(parseFloat(markerElem.getAttribute('lat')), parseFloat(markerElem.getAttribute('lng')));
            var place = markerElem.getAttribute('city');

			//Creates the pop-up label for the pin.
    		var infowincontent = document.createElement('div'); //Creates the Divition

    		var strong = document.createElement('strong');
    		strong.textContent = title//**Edited.
    		infowincontent.appendChild(strong);

    		infowincontent.appendChild(document.createElement('br')); //Line break.

    		var text = document.createElement('text');
    		text.textContent = "Threat Level: "+ threatLevel //**Edited.
    		infowincontent.appendChild(text);

			//Creates a marker icon.
            var iconImg = customColor[threatLevel] || {};

			//Creates a marker.
				var marker = new google.maps.Marker(
					      {map: map,
								 position: point,
								 icon: iconImg.iconImage,
								 title: place,
								 animation: google.maps.Animation.DROP}
							 );


    		//show infoWindow when mouse point on marker
            marker.addListener('click', function()
           {
	          infoWindow.setContent(infowincontent); infoWindow.open(map, marker);
           }
           );

            // hide the infowindow when user mouses-out
            marker.addListener('mouseout', function() {
            infoWindow.close();
            });

		});
	});
}


function downloadUrl(url, callback) {
	var request = window.ActiveXObject ?
	new ActiveXObject('Microsoft.XMLHTTP') :
	new XMLHttpRequest;

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
		request.onreadystatechange = doNothing;
		callback(request, request.status);
		}
	};

	request.open('GET', url, true);
	request.send(null);
}

function doNothing() {}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdFsGvE8odKeizBKywsA3OFILrLcWVeA8&callback=initMap"></script>

<?php 

?>
</body>
</html>