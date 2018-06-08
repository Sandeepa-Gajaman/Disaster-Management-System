<html>

<head>
<title>AdminDeleteUser</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<?php session_start(); require("Navbar.php");?>

<div id="Delete" class="container" align="center" style= "margin-bottom: 70px;"> 
<fieldset style="width:50%"><legend>Delete Registerd Users</legend> 
<table border="0" class="table table-hover"> 


<form method="POST" action="AdminDeleteUserProcess.php"> 
<tr>
</td>User Name<input type="text" name="delusername" required></td>
</tr>
</tr>
<td><input id="button" type="submit" name="delete" value="Delete">
</tr> 

<td>
Already Users
</td>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>User Name</th>
<th>User Type</th>
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
echo "<td>" . $row['fName'] . "</td>";
echo "<td>" . $row['lName'] . "</td>";
echo "<td>" . $row['userName'] . "</td>";
echo "<td>" . $row['userType'] . "</td>";
echo "</tr>";
}


mysqli_close($conn);
?>
<td><a href="AdminAccountDashboard.php"><input id="backButton" type="button" name="back" value="Back" ></a></td>
</form>
</table>
</fieldset> 
</div>
<?php include("footer.php");?>
</html>
