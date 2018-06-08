<!DOCTYPE html>
<html lang= "en">
<head>
<title>Select Year</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
<?php 
if(isset($_SESSION['year'])){session_destroy();}
session_start(); 
//$_SESSION["year"];
?>
<?php include("Navbar.php"); ?>
<h1>Select The Year</h1>
<hr>

<?php
//mysql_connect('hostname', 'username', 'password');
//mysql_select_db('database-name');
$servername = "localhost";

//username to connect to the db
//the default value is root
$username = "root";

//password to connect to the db
//this is the value you would have specified during installation of WAMP stack
$password = "";

//name of the db under which the table is created
$dbName = "incidentreportingapp";

//establishing the connection to the db.
$conn = new mysqli($servername, $username, $password, $dbName);

//checking if there were any error during the last connection attempt
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//the SQL query to be executed
$query = "SELECT DISTINCT year(date_) as year FROM incident ";


//$sql = "SELECT username FROM userregistraton";
$result = $conn->query($query);

echo '<form align="center" method="get" action="StatisticsMain.php">';
echo 'Select year: <select name="year">';
while ($row = $result->fetch_assoc()) {
  echo "<option value='" . $row['year'] ."'>" . $row['year'] ."</option>";
}
echo '</select>';
echo '<input type="submit" name="" value="submit" >';
echo '</form>';

$conn->close();
?>

<!--<form align="center" method="get" action="IncidentChartsYear.php">
 Year:<input type="text" name="year" value="" >
    <input type="submit" value="submit">
</form>-->
<br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/>
<br/>

<?php include "footer.php";?>
</body>
</html>

