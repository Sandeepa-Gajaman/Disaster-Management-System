
<!DOCTYPE html>
<html lang= "en">
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Update Incident Report</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<body>
<script>
/*
function check1()
{
var status=true;
 var nme = document.getElementById("fileToUpload");
// alert(nme.files.length);
if(nme.files.length<1)
	  {
		  
		  status=false;
		  document.getElementById("imagesb").style.display="block";
		  alert('Please select image to upload');
		  
		  
	  }


return  status;
}*/

</script>


<?php
$db=mysqli_connect('localhost','root','','incidentreportingapp');
if(!$db){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.

$query= "select * from incidentreportimages where reportId=$reportId";
$res= mysqli_query($db, $query);

if(mysqli_num_rows($res)>0){
	echo "<div class= 'container-fluid'>";
	echo "<table class= 'table-bordered' style= 'margin-left: 25px;'>";
	echo "<tr>";
	while($row=mysqli_fetch_array($res)){
		echo "<td style= 'padding: 10px;'>";
		
		$reportId= $row['reportId'];
		$name= $row['imagename'];
		$img= $row['image'];
			
		//Creates forms for each image retrieved.
		echo "<form action= 'UpdateIncidentReportImagesProcess.php' method='post' enctype='multipart/form-data' >";
		echo '<img width="200" height="200" src="data:image;base64,'.$img.'">'; //uri
		echo "<br/><br/>";
		echo "<input type='hidden' name= 'name' value= $name>";
		echo "<input type='hidden' name= 'reportId' value= $reportId>";
		echo "<input type='file' name='file' id='fileToUpload'>";
		echo "<br/>";
		echo "<input type='submit' value= 'Upload' class= 'btn btn-info'>";
		echo "</form>";	
		
		echo "</td>";
	}
	echo "</tr>";
	echo "</table>";
	echo "</div>";
}
?>
</body>
</html>