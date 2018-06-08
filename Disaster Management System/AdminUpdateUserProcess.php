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

<script src= "AdminUpdate.js"></script> <!--javascript file-->

</head> 


<body> 

<?php session_start(); require("Navbar.php");?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>
<div id="Update" class="container" align="center" style= "margin-bottom: 70px;"> 
<fieldset style="width:50%"><legend>Update User Details Form</legend>
<table border="0" class="table table-hover">  
<form method="POST" action="AdminUpdateConnectivity.php" onsubmit="return AddNewUserValidation();"> 




<?php
$conn= mysqli_connect("localhost","root","","incidentreportingapp");
$name=$_GET['edit'];
$sql="select * from useraccounttable where userName='$name'";
$res=mysqli_query($conn,$sql);

$row=mysqli_fetch_array($res);

$userName=$row['userName'];
$userType=$row['userType'];
$fName=$row['fName'];
$lName=$row['lName'];
$address=$row['address'];
$contactNumber=$row['contactNumber'];
$email=$row['email'];
$occupation=$row['occupation'];
//$pass=$row['password'];
//$cpass=$row['cpassword'];

if(empty($fName)){
	echo '<script type="text/javascript">'; 
        echo 'alert("Insert First Name");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
	
}
else if(empty($lName)){
	echo '<script type="text/javascript">'; 
        echo 'alert("Insert Last Name");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
	
}
else if(empty($address)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Address");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
		
	
}
else if(empty($contactNumber)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Contact Number");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
		
	
}
else if(empty($occupation)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Occupation");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
	
}
else if(empty($userName)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert User Name");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
	
}
/*else if(empty(sha1($pass))){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Password");'; 
        echo 'window.location.href = "AdminUpdateUserProcess.php";';
        echo '</script>';
	
}
else if(!($pass == $cpass)){
	echo "Password dosen't match";
}*/

	

$sql="UPDATE useraccounttable SET userName = '$userName',userType='$userType' ,fName='$fName' ,lName=$lName, address='$address', contactNumber=$contactNumber,email='$email' ,occupation='$occupation' WHERE  userName = '$name'";
$res=mysqli_query ($conn,$sql);
if($res==1)
{
	//  echo 'window.location.href = "AdminUpdateUser.php";';
   header("Location:AdminUpdateUser.php");
   exit();
}


?>



<tr> 
<td>UserName</td><td> <input type="text" name="userName" id="userName" onblur="f6()" value='<?php echo $userName;?>'/><span id="e6"></span></td> 
</tr> 
<tr> 
<td>Change User Type</td>
<td>                    <select name="userType" id="userType" value='<?php echo $userType;?>'/>
                        <option value="normalUser">Normal User</option>
						<option value="manager">Manager</option>
						<option value="admin">Administrator</option>
						</select>
</td> 
</tr>
<tr> 
<td>Change First Name</td><td> <input type="text" name="fName" id="fName" onblur="f1()" value='<?php echo $fName;?>'/><span id="e1"></span></td> 
</tr>
<tr> 
<td>Change Last Name</td><td> <input type="text" name="lName" id="lName" onblur="f11()" value='<?php echo $lName;?>'/><span id= "e8"></span></td> 
</tr>  
<tr> 
<td>Change Address</td><td> <input type="text" name="address" id="address" onblur="f2()" value='<?php echo $address;?>'/><span id= "e2"></span></td> 
</tr> 
<tr> 
<td>Change Contact Number</td><td> <input type="text" name="contactNumber" id="contactNumber" onblur="f3()" value='<?php echo $contactNumber;?>'/><span id= "e3"></span></td> 
</tr>
<tr> 
<td>Change Email</td><td> <input type="text" name="email" id="email" onblur="f4()"  value='<?php echo $email;?>'/><span id= "e4"></span></td> 
</tr>
<tr> 
<td>Change Occupation</td><td> <input type="text" name="occupation" id="occupation" onblur="f5()"  value='<?php echo $occupation;?>'/><span id= "e5"></span></td> 
</tr>
 
<tr> 
<td><input id="updateButton" type="submit" name="update" value="Update"></td>
<td><a href="AdminUpdateUser.php"><input id="backButton" type="button" name="back" value="Back" ></a></td>
</tr> 

 
</form>
</table> 
</fieldset> 
</div>

<?php include("footer.php");?>

</body>
</html>

