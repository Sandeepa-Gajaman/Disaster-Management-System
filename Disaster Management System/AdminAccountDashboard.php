<!DOCTYPE html>
<html lang= "en">
<head>
<title>Dashboard: Admin</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "AdminAccountDashboard.css">
</head>

<body>
<?php session_start(); require("Navbar.php");?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>	

<div class= "container customContainer">
<a href= "AdminAddNewUser.php"><div class= "well customWell"><p>Add New User Account</p></div></a>
<a href= "AdminUpdateUser.php"><div class= "well customWell"><p>Update User Account</p></div></a>
<a href= "AdminDeleteUser.php"><div class= "well customWell"><p>Delete User Account</p></div></a>
<a href= "UserAccountSettings.php"><div class= "well customWell"><p>Change Account Password</p></div></a>
</div>

<?php include("footer.php");?>

</body>
</html>