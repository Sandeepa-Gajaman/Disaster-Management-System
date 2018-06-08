<?php
$connection= mysqli_connect('localhost','root','','incidentreportingapp');//Set database connection.
if(!$connection){echo "<h4 style= 'color: red;'>Unable to contact server</h4>"; die;} //Handles a bad conection to the server.
  
$records_per_page= 5;//Sets the number of records to be shown.
$page='';
$output= '';

if(isset($_POST["page"])){
	$page= $_POST["page"]; //Gets the page number.
	//echo "Second time.";
}
else{   
	$page= 1;	//Initializing the variable the first time the page is loaded.
	//echo "First time.";
}

$start_from =($page - 1) * $records_per_page;	//Increment the record number starting variable for pagination .
$query= "select * from incident where approval= 1 and state= 1 LIMIT $start_from, $records_per_page";
$result= mysqli_query($connection, $query);

$output .="<table class='table table-bordered' width= '100%' style= 'margin-top: 10px;'><tr><th width='85%'>Recent Incidents</th></tr>";//Opens a table. 
while($row= mysqli_fetch_array($result)){ 
	$reportId = $row["reportId"]; ;		
	$output .="<tr><td>".$row['content']."</td><td align= 'center'><a href='IncidentView.php?reportId=$reportId'>View</a></td> </tr> ";
}
$output .='</table><br />';	//Closes the table.

//Create the pagination links by getting the number of records in the DB.
$query= "select * from incident where approval= 1 and state= 1";
$result= mysqli_query($connection, $query);
$total_records= mysqli_num_rows($result);
$total_pages= ceil($total_records/$records_per_page); //Rounding off the number.

for($i= 1; $i<= $total_pages; $i++){
	$output .="<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
}

//Send the output to be read by the ajax request.
echo $output;
?>