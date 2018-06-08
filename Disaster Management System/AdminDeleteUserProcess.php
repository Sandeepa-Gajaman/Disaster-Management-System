
<form action="AdminDeleteUser.php" method="get">
  <button type="submit" >Delete</button>
</form>


<?php

$conn=mysqli_connect("localhost","root","","incidentreportingapp");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userName = $_POST['delusername'];
echo $userName;

if(empty($userName)){
	   echo '<script type="text/javascript">'; 
        echo 'alert("Required filed");'; 
        echo 'window.location.href = "AdminDeleteUser.php";';
        echo '</script>';
	
                    } 

else if (!$conn) {
	
	    echo '<script type="text/javascript">'; 
        echo 'alert("something wrong with the connection try agian!");'; 
        echo 'window.location.href = "AdminDeleteUser.php";';
        echo '</script>';
   
                 }

else  {
	
	$sql="delete from useraccounttable where userName='$userName'";//delete a record 
	$res=mysqli_query($conn,$sql);
	
	if($res==1)
	  {
	echo '<script type="text/javascript">'; 
        echo 'alert("Deleted");'; 
        echo 'window.location.href = "AdminDeleteUser.php";';
        echo '</script>';
      }
	else{
		echo"fail";
	    }

    }
	




?>