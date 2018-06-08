
<?php

$userName=$_POST['userName'];
$userType=$_POST['userType'];
$fName=$_POST['fName'];
$lName=$_POST['lName'];
$address=$_POST['address'];
$contactNumber=$_POST['contactNumber'];
$email=$_POST['email'];

$occupation=$_POST['occupation'];

echo $userName;
echo $userType;
echo $fName;
echo $lName;
echo $address;
echo $contactNumber;
echo $email;
echo $occupation;


$conn= mysqli_connect("localhost","root","","incidentreportingapp");
$sql="UPDATE useraccounttable SET userType='$userType' ,fName='$fName' ,lName='$lName', address='$address', contactNumber='$contactNumber',email='$email' ,occupation='$occupation' WHERE  userName = '$userName'";
$res=mysqli_query ($conn,$sql);
if($res==1)
{
	//  echo 'window.location.href = "AdminUpdateUser.php";';
  header("Location:AdminUpdateUser.php");
   exit();
}
else
{
	echo "not work";


}


?>