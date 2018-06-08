
<html lang= "en">
<head> <title>AdminUpdateUser</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</head> 


<body id="update"> 
<?php session_start(); require("Navbar.php");?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>
<form method="POST" action="AdminUpdateUserProcess.php" style= "margin-bottom: 70px;"> 
<div id="Update" class="container" align="center"> 
<fieldset style="width:50%"><legend>Update User Details Form</legend> 
<table border="0" class="table table-hover"> 
</table>
</div>


<div id="Update" class="container" align="center">
<table border="0" class="table table-hover">
<tr>
<th>User Name</th>
<th>User Type</th>
<th>First Name</th>
<th>Last Name</th>
<th>Address</th>
<th>Contact Number</th>
<th>Email</th>
<th>Occupation</th>
</tr>




<?php
$conn=mysqli_connect("localhost","root","","incidentreportingapp");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($conn,"SELECT * FROM useraccounttable");



while($row = mysqli_fetch_array($result))

{
echo "<tr>";
echo "<td>" ."<a href='AdminUpdateUserProcess.php?edit=$row[userName]'>edit</a></br>". $row['userName'] ."</td>";
echo "<td>" . $row['userType'] . "</td>";
echo "<td>" . $row['fName'] . "</td>";
echo "<td>" . $row['lName'] . "</td>";
echo "<td>" . $row['address'] . "</td>";
echo "<td>" . $row['contactNumber'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['occupation'] . "</td>";
echo "</tr>";
}


mysqli_close($conn);
?>

 
<td><a href="AdminAccountDashboard.php"><input id="backButton" type="button" name="back" value="Back" ></a></td>


</table>
</fieldset> 
</div>
</form>
<?php include("footer.php");?>

</body>
</html>


