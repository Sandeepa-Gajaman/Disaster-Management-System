<!DOCTYPE html>
<html lang= "en">
<head>
<title>Home</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"><!--Compatibility for devices with small screens-->
<meta name= "keywords" content= "Incident", "Accident", "Emergency", "Colombo">
<meta name= "description" content= "Report incidents in the Colombo district">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries through CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel= "stylesheet" type= "text/css" href= "IndexStyle.css">
<link rel= "stylesheet" type= "text/css" href= "Well.css">
</head>

<body>
<?php session_start(); include("Navbar.php");?>
<div class= "well headingWell"><h3 id= "h31">Welcome To The Online Incident Reporting Service</h3></div>

<div class= "container-fluid" style= "margin-bottom: 70px;">
<div class= "row">

<div class= "col-md-1"></div>
<div class= "col-md-6"><div id= "map"></div>

<div class= "row" style= "margin-top: 20px;">
<div class= "col-sm-4">Low Threat Level </b>&ensp;&ensp;&ensp;&ensp; <img src="yellow.png" alt="Threat Level is LOW (Level 1)"></div>
<div class= "col-sm-4">Medium Threat Level</b>&ensp; <img src="orange.png" alt="Threat Level is MEDIUM (Level 2)"></div>
<div class= "col-sm-4">High Threat Level</b>&ensp;&ensp;&ensp;&ensp; <img src="red.png" alt="Threat Level is HIGH (Level 3)"></div>
</div>

</div>

<div class= "container"><div id= "recentIncidents" class= "col-md-4"></div></div>
<div class= "col-md-1"></div>

</div>
</div>

<script>
var	y= 6.9016;	//Required to reset the map position. 
var x= 79.9600;	

//setting custom markers for map
var customColor = {
	High: {iconImage: 'red.png'},
	Medium: {iconImage: 'orange.png'},
	Low: {iconImage: 'yellow.png'}};

//Initializes the map.
function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {center: new google.maps.LatLng(6.9016, 79.9500),zoom: 11, gestureHandling: 'cooperative'});
	var infoWindow = new google.maps.InfoWindow;

	// downloadUrl depending on the name of our linking PHP or XML file (in this case its php).
	downloadUrl('IndexMapLink.php', function(data) {
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName('marker');

		Array.prototype.forEach.call(markers, function(markerElem) {
			var reportId = markerElem.getAttribute('reportId');
			var title = markerElem.getAttribute('title');
			var threatLevel = markerElem.getAttribute('threatLevel');
			var point = new google.maps.LatLng(parseFloat(markerElem.getAttribute('lat')), parseFloat(markerElem.getAttribute('lng')));
            var place = markerElem.getAttribute('city');

			//Creates the pop-up label for the pin.
    		var infowincontent = document.createElement('div');

    		var strong = document.createElement('strong');
    		strong.textContent = title
    		infowincontent.appendChild(strong);

    		infowincontent.appendChild(document.createElement('br')); //Line break.

    		var text = document.createElement('text');
    		text.textContent = "Threat Level: "+ threatLevel
    		infowincontent.appendChild(text);

			//Creates a marker icon.
            var iconImg = customColor[threatLevel] || {};
			
			//Creates a marker.
    		var marker = new google.maps.Marker(
	        {    map: map,
				 position: point,
				 icon: iconImg.iconImage,
				 title: place,
				 animation: google.maps.Animation.DROP
			}
			);


    		//show infowindow when mouse point on marker
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

<script>
//Displays data in the recent incidents section.
$(document).ready(function(){	//Wait for the document to finish loading.
	load_data();

    function load_data(page){$.ajax({
			url:"IndexRecentIncidentsLink.php",
			method:"POST",
			data:{page:page}, //data
			success: function(data){$('#recentIncidents').html(data);}
		})
	}

	$(document).on('click','.pagination_link',function(){var page=$(this).attr("id"); load_data(page);});
});
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMqon_DM8ILTx-3Y0TdqNuQxqkDvBlm0E&callback=initMap"></script>

<br><br>

<?php include("footer.php");?>

</body>
</html>
