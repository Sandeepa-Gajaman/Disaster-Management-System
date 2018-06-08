
<html lang= "en">
<head> 
<title>AdminAddNewUser</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!--Bootsrap libraries-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<script src= "AdminAddNewUser.js"></script> <!--javascript file-->
<style>

</style>
</head> 


<body > 
<?php session_start(); require("Navbar.php");?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>
<div id="Registration" class="container" align="center" style= "margin-bottom: 70px;"> 
<fieldset style="width:50%"><legend>Register New User Form</legend> 
<table border="0" class="table table-hover" > 

<form method="POST" action="AdminAddNewUserProcess.php" onsubmit="return AddNewUserValidation();"> 
 
<tr> 
<td>User Type</td>
<td>                    <select name="userType" id="userType">
                        <option value="normalUser">Normal User</option>
						<option value="manager">Manager</option>
						<option value="admin">Administrator</option>
						</select>
</td> 
</tr>
<tr> 
<td>First Name</td><td> <input type="text" name="fName" id="fName" placeholder="Enter First Name" onblur="f1();" />&nbsp;<span id="e1"></span></td> 
</tr>
<tr> 
<td>Last Name</td><td> <input type="text" name="lName" id="lName" placeholder="Enter Last Name"  onblur="f11();" />&nbsp;<span id= "e8"></span></td> 
</tr>  
<tr> 
<td>Address</td><td> <input type="text" name="address" id="address" placeholder="Enter Address" onblur="f2();"/>&nbsp;<span id= "e2"></td> 
</tr> 
<tr> 
<td>Contact Number</td><td> <input type="text" name="contactNumber" id="contactNumber" placeholder="Ex-0712345678" onblur="f3();" />&nbsp;<span id= "e3"></td> 
</tr>
<tr> 
<td>Email</td><td> <input type="text" name="email" id="email" placeholder= "Ex- someone@mailbox.com" onblur="f4();" />&nbsp;<span id= "e4"></td> 
</tr>
<tr> 
<td>Occupation</td><td> <input type="text" name="occupation" id="occupation" placeholder="Enter Occupation" onblur="f5();"/>&nbsp;<span id= "e5"></td> 
</tr>
<tr> 
<td>UserName</td><td> <input type="text" name="userName" id="userName" placeholder="Enter Username" onblur="f6();" />&nbsp;<span id= "e6"></td> 
</tr> 
<tr> 
<td>Password</td><td> <input type="password" name="password" id="password" placeholder= "Enter a Password" onblur="f7();" />&nbsp;<span id="e7"></td> 
</tr> 
<tr> 
<td>Confirm Password </td><td><input type="password" name="cpassword" id="cpassword" placeholder= "Re-enter Password" onblur="f9();" />&nbsp;<span id= "e9"></td>  
</tr> 
<tr> 
<td><input id="registerButton" type="submit" name="register" value="Register" ></td>
<td><a href="AdminAccountDashboard.php"><input id="backButton" type="button" name="back" value="Back" ></a></td>
</tr> 


</form> 
</table>
</fieldset>
</div>

<?php include("footer.php");?>
</body>