<?php
// Start XML file, create parent node
$doc = new DOMDocument("1.0");//**Edited
$node = $doc->createElement("markers");//**Edited
$parnode = $doc->appendChild($node);//**Edited

//Opens the DB connection to get data.
$Connection= mysqli_connect("localhost", "root", "", "incidentreportingapp");//**Edited
$Query= 'SELECT * FROM incident WHERE approval=1';//**Edited
$result= mysqli_query($Connection, $Query);//**Edited

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = mysqli_fetch_assoc($result)){
  // Add to XML document node
  //Creates a marker.
  $node = $doc->createElement("marker");//**Edited
  $newnode = $parnode->appendChild($node);//**Edited

  //Sets the marker's attributes.
  $newnode->setAttribute("reportId", $row['reportId']);//**Edited
  $newnode->setAttribute("lat", $row['lattitude']);//**Edited
  $newnode->setAttribute("lng", $row['longitude']);//**Edited
  $newnode->setAttribute("title", $row['title']);//**Edited
  $newnode->setAttribute("city", $row['city']);//**Edited


  $dataThreatLevel= $row['threatLevel'];
  //checking the threatLevel number and display the related string
  if($dataThreatLevel== 1){$dataThreatLevel= "Low";} else if($dataThreatLevel== 2){$dataThreatLevel= "Medium";} else if($dataThreatLevel== 3){$dataThreatLevel= "High";}
  $newnode->setAttribute("threatLevel", $dataThreatLevel);//**Edited
}

//Outputs the extracted data.
mysqli_close($Connection);
echo $doc->saveXML();//**Edited
?>
