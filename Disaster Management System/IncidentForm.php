<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Report Incident</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src= "IncidentForm.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "Well.css">
</head>
<body>

<?php session_start(); require("navbar.php"); ?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<?php
   //edit
if(isset($_GET['error'])){if($_GET['error']==4){
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> can't have empty field
  </div></div>";
  }
  
  else if($_GET['error']==3)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Can only input numeric value
  </div></div>";
  }
   else if($_GET['error']==8)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Invalid Format!
  </div></div>";
  }
  else if($_GET['error']==9)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> There is something wrong with Uploaded images Please Try Again!
  </div></div>";
  }
  else if($_GET['error']==10)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> File size is too much!
  </div></div>";
  }
  
}



?>

<div class= "well headingWell"><h3 id= "h31">Report New Incident</h3></div>

<div class= "container-fluid" style= "margin-top: 50px;">
<div class= "row">
<div class= "col-md-12">
<div id="map" style= "width: 100%; height: 300px"></div>
</div>
</div>
</div>

<div class="container" style= "margin-bottom: 70px;">
<div class= "col-md-12">
<div class="row">
         <div class="col-sm-2"><?php if(isset($_GET['error'])){if($_GET['error']==4){echo"can't leave fields empty!";}}?> </div><br/>
</div>
<div class="row">
		 <div class="col-sm-2"> <p id="pin" style="display: none;color:red;"> *Please pin a location</p></div><br/><br/>
</div>

	<form action= "incidentFormSaveData.php" method= "post" enctype= 'multipart/form-data' onsubmit= "return check();">
	<input  id= "formLattitude" type= "hidden" name= "dbLattitude" value= "">
	<input  id= "formLongitude" type= "hidden" name= "dbLongitude" value= "">
	<input  id= "formCity" type= "hidden" name="dbCity" value= "">
	
	<div class="row">
	    <div class="col-sm-2">
		   <label for="Category">Category:</label>    
        </div>
		<div class="col-sm-4">
         <select name="category">
             <option value='Fire'>Fires</option>
             <option value='Road Side accident'>Road Side accident</option>  
             <option value='Hurricance'>Hurricance</option>
             <option value='Land Slide'>Land Slide</option>
             <option value='Electrical Breakdown and Leakage'>Electrical Breakdown and Leakage</option>
             <option value='Flood'>Flood</option>
             <option value='other'>other</option>
   
          </select>
        </div>
	  </div><br>
 	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">Title:</label> 
	       
		   </div>
		   <div class="col-sm-4">
		     <input type='text' name='title'id="texta"onfocusout="myFunction()">
		   </div>
		    <div class="col-sm-2">
		     <p id="a" style="display: none;"> *Required Field</p>
		   </div>
       </div><br>
	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">content:</label> 
	       
		   </div>
		   <div class="col-sm-4">
		       <textarea placeholder='content' name='content' rows='10' cols='40'id="tArea"onfocusout="myFunction1()"></textarea>
		   </div>
		   <div class="col-sm-2">
		     <p id="b" style="display: none;"> *Required Field</p>
		   </div>
       </div></br>
	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">Threat Level:</label> 
	       
		   </div>
		   <div class="col-sm-4">
		    
		     <input  id='star-1' type='radio' name='level' title='High threat'value='1'/>
             <label  for='star-1'>Low </label>
             <input  id='star-2' type='radio' name='level' title='Medium threat'value='2'/>
             <label  for='star-2'title='Medium threat'>Medium</label>
             <input id='star-3' type='radio' name='level' title='High threat'value='3'/>
             <label  for='star-3'>High</label>
			
       </div>
	   <div class="col-sm-2">
		     <p id="threatb" style="display: none;"> *Required Field</p>
		   </div>
	  </div></br>
	   
	    <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">Images:</label> 
	       
		   </div>
		   <div class="col-sm-4">
		       <input type='file'id="fileToUpload" name='files[]'multiple>
		   </div>
		   <div class="col-sm-2">
		     <p id="imagesb" style="display: none;"> *Required Field</p>
		   </div>
       </div></br>
	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">No.of Deaths</label> 
	       
		   </div>
		   <div class="col-sm-4">
		       <input type='text' name='deaths'id="deathA"onfocusout="myfunction2();">
		   </div>
		   <div class="col-sm-2">
		     <p id="deathB" style="display: none;"> *Required Field</p>
		   </div>
       </div></br>
	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">No.of Missing</label> 
	       
		   </div>
		   <div class="col-sm-4">
		       <input type='text' name='missing'id="missingA"onfocusout="myfunction3();">
		   </div>
		   <div class="col-sm-2">
		     <p id="missingB" style="display: none;"> *Required Field</p>
		   </div>
       </div></br>
	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">No.of Severely</label> 
	       
		   </div>
		   <div class="col-sm-4">
		       <input type='text' name='severely'id="severelyA"onfocusout="myfunction4();">
		   </div>
		   <div class="col-sm-2">
		     <p id="severelyB" style="display: none;"> *Required Field</p>
		   </div>
       </div></br>
	   <div class="row">
	      <div class="col-sm-2">
		    <label for="Title">No.of Minor Injuries</label> 
	       
		   </div>
		   <div class="col-sm-4">
		       <input type='text' name='minor'id="minorA"onfocusout="myfunction5();">
		   </div>
		   <div class="col-sm-2">
		     <p id="minorB" style="display: none;"> *Required Field</p>
		   </div>
       </div></br>
	   <div class="row">
	     
		   <div class="col-sm-3">
		        <input name='submit' type='submit' value='submit'class="btn btn-default">
		   </div>
       </div></br>
	</form>
</div>
	
</div>

<?php include("footer.php");?>

<script>
var infowindow;
var marker;
var map;

function initMap() {
	//var latLongBounds= new google.maps.latLngBounds(6.9016, 80.0088);
    map = new google.maps.Map(document.getElementById('map'), {zoom: 11, center: {lat: 6.9016, lng: 80.0088}});
    var geocoder = new google.maps.Geocoder;
	//map.fitBounds(latLongBounds);
		
	function placeMarker(locationParameter) {
		if ( marker ) {
			marker.setPosition(locationParameter);
			geocodeLatLng(geocoder, map, marker);
		} 
		else {
			marker = new google.maps.Marker({position: locationParameter, map: map});
			geocodeLatLng(geocoder, map, marker);
		}
	}

	google.maps.event.addListener(map, 'click', function(event) {placeMarker(event.latLng);});
}

    function geocodeLatLng(geocoder, map, marker) {
		var coordinates = marker.getPosition();
		var tempLattitude= coordinates.lat();
		var tempLongitude= coordinates.lng();
		var city;
		document.getElementById("formLattitude").value= tempLattitude;
		document.getElementById("formLongitude").value= tempLongitude;
		
		if(!infowindow){
			infowindow = new google.maps.InfoWindow;
		}
		
		geocoder.geocode({'location': coordinates}, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent(results[0].address_components[1]['long_name']);
			  infowindow.open(map, marker);
			  city= results[0].address_components[1]['long_name'];
			  document.getElementById("formCity").value= city;
            } 
			else {
              window.alert('No results found');
            }
        } 
		else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
		google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
      }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMqon_DM8ILTx-3Y0TdqNuQxqkDvBlm0E&callback=initMap"></script>

</body>
</html>