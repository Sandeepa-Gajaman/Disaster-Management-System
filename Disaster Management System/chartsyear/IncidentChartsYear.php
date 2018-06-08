<!DOCTYPE html>
<html lang= "en">
<head>
<title>Incidents</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>

<body>
<?php session_start();
$_SESSION["year"]=$_GET["year"];
//$year=$_SESSION["year"];
 //include("Navbar.php");
 ?>	
<?php include("Navbar.php");
$year=$_SESSION["year"];
//echo $year;
echo '<h1 align="center">'.$year.' Incidents</h1>';
?>

<table border="0" width="100%">
<tr rowspan="2" align="center">
 <td colspan="2"> <div id="chart-container1">FusionCharts1 will render here</div></td>
</tr>
<tr>
 <td> <div id="chart-container" align="left">FusionCharts will render here</div></td>
 <td> <div id="chart-container2" align="right">FusionCharts2 will render here</div></td>
</tr>
<tr>
 <td> <div id="chart-container3" align="left">FusionCharts3 will render here</div></td>
 <td> <div id="chart-container4" align="right">FusionCharts4 will render here</div></td>
</tr>
<tr>
 <td> <div id="chart-container5" align="left">FusionCharts5 will render here</div></td>
</tr>
</table>
  <script src="js/jquery-2.1.4.js"></script>
  <script src="js/fusioncharts.js"></script>
  <script src="js/fusioncharts.charts.js"></script>
  <script src="js/themes/fusioncharts.theme.zune.js"></script>
  <script src="js/themes/fusioncharts.theme.ocean.js"></script>
  <script src="js/themes/fusioncharts.theme.fint.js"></script>
  <script src="js/themes/fusioncharts.theme.carbon.js"></script>
  <script src="js/appcatcountYear.js"></script>
  <script src="js/appdeathswholeYear.js"></script>
  <script src="js/appmissingwholeYear.js"></script>
  <script src="js/appseverelyInjuredwholeYear.js"></script>
  <script src="js/appminorlyInjuredwholeYear.js"></script>
  <script src="js/appdeathswholeYearMonth.js"></script>



<?php include "footer.php";?>
</body>
</html>