<?php 
$conn=mysqli_connect("localhost","root","","incidentreportingapp");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userType = $_POST['userType'];
$fName = $_POST['fName'];
$lName = $_POST['lName']; 
$address = $_POST['address'];
$contactNumber = $_POST['contactNumber'];
$occupation = $_POST['occupation'];
$userName = $_POST['userName']; 
$email = $_POST['email']; 
$pass = $_POST['password'];
$cpass = $_POST['cpassword']; 
$encriptPassword = sha1($pass);


if(empty($fName)){
	echo '<script type="text/javascript">'; 
        echo 'alert("Insert First Name");'; 
       // echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
	
}
else if(empty($lName)){
	echo '<script type="text/javascript">'; 
        echo 'alert("Insert Last Name");'; 
       // echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
	
}
else if(empty($address)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Address");'; 
      //  echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
		
	
}
else if(empty($contactNumber)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Contact Number");'; 
     //   echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
		
	
}
else if(empty($occupation)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Occupation");'; 
       // echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
	
}
else if(empty($userName)){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert User Name");'; 
       // echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
	
}
else if(empty(sha1($pass))){ 
    echo '<script type="text/javascript">'; 
        echo 'alert("Insert Password");'; 
     //   echo 'window.location.href = "AdminAddNewUser.php";';
        echo '</script>';
	
}
else if(!($pass == $cpass)){
	echo "Password dosen't match";
}

	
else{
$sql="INSERT INTO useraccounttable (userType,fName,lName,userName,email,password,address,occupation,contactNumber) VALUES ('$userType','$fName','$lName','$userName','$email','$encriptPassword','$address','$occupation','$contactNumber')";
$res=mysqli_query ($conn,$sql);
echo '<script type="text/javascript">'; 
        echo 'alert("Data Stored");'; 
        echo 'window.location.href = "AdminAccountDashboard.php";';
        echo '</script>';

}
if(isset($_POST['register'])){
}


?>