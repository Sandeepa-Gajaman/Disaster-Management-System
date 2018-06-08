<!DOCTYPE html>
<html lang= "en">
<head>
<title>Login</title>
<meta charset= "utf-8">
<meta name= "viewport" content= "width=device-width, initial-scale= 1"> 							<!--Compatibility for devices with small screens-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!--Linking the bootstrap libraries throug CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "LoginStyle.css">
<script src= "Validation.js"></script>
</head>

<body>
<?php session_start(); require("Navbar.php");?>	

<div class= "container containerForm">
<form id= "loginForm" action= "Login.php" method= "POST"  onsubmit= "return loginValidate()" onkeyup= "resetErrors()">
<div class= "form-group">
<label for= "userName">User Name</label>																			<!--Read cookie value if its set-->
<input name= "userName" id= "userName" type= "text" class= "form-control" onblur= "validateUserName()" value= "<?php if(isset($_COOKIE['userName'])){ echo $_COOKIE['userName'];}?>">
</div>
<br/>
<div class= "form-group">
<label for= "password">Password</label>
<input name= "password" id= "password" type= "password" class= "form-control" onblur= "validatePassword()">
</div>
<br/>
<button name= "submit" type= "submit" class= "btn btn-default">Login</button>
<br/><br/>
<!--Below code handles error messages-->
<?php if(isset($_GET['error'])){
	$error= $_GET['error'];
	//if($error== 1){echo "<h4>Couldn't connect to server! Please try again.</h4>";}
	if($error== 2){echo "<h4 id= 'error2' class= 'h42'>Invalid user name</h4>";}
	else if($error== 3){echo "<h4 id= 'error2' class= 'h42'>Incorrect password!</h4>";}
	else if($error== 4){echo "<h4 id= 'error2' class= 'h42'>Fields are empty!</h4>";}	
}
?>

<h4 class= 'h42' id= "error"></h4>
<a href= "UserAccountPasswordResetForm.php">Forgot User name or Password?</a>
</form> 
</div>

<!--Below code processes the login request-->
<?php 
if(isset($_POST['submit'])){
	try{
		login();
	} 
	catch(Exception $e){
		header('location:GeneralErrors.php?error=3');
	}
}

function login(){
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
	//Input validation.
	$userName= mysqli_real_escape_string($connection, $_POST['userName']);
	$password= mysqli_real_escape_string($connection, $_POST['password']);
	$userName= trim($userName);
	$password= trim($password);
	if(empty($userName) || empty($password)){mysqli_close($connection); header('Location:Login.php?error=4');}
	
	$query= "select userId, userName, password, userType, fName, lName from useraccounttable where userName= '$userName'";
	$execute= mysqli_query($connection, $query);
	$rows= mysqli_num_rows($execute);
	if($rows== 1){
		$temp= mysqli_fetch_array($execute);
		$tempPassword= $temp['password'];
		if(sha1($password)== $tempPassword){			//Password encryption.
			$_SESSION['userId']= $temp['userId'];
			$_SESSION['userName']= $temp['userName'];
			$_SESSION['userType']= $temp['userType'];
			$_SESSION['fName']= $temp['fName'];
			$_SESSION['lName']= $temp['lName'];
			
			//Create a cookie for the user name.
			if(!isset($_COOKIE['userName'])){
				setCookie("userName", $temp['userName'], time()+ (86400* 60), "/");
			}
			else{
				setCookie("userName", $temp['userName'], time()+ (86400* 60), "/");	//If cookie is already set, replace with a new value.
			}
			
			//Get the 'userType' field from the db and use an if statement to direct to the appropriate account type.
			if($temp['userType']== 'manager'){
				mysqli_close($connection);
				header('Location:ManagerAccountDashboard.php');
			}
			else if($temp['userType']== 'admin'){
				mysqli_close($connection);
				header('Location:AdminAccountDashboard.php');					//Please change.
			}
			else if($temp['userType']== 'normalUser'){
				mysqli_close($connection);
				header('Location:UserAccountDashboard.php');
			}			
		}
		else{
			mysqli_close($connection);
			header('Location:Login.php?error=3');
			die;
		}
	}
	else{
		mysqli_close($connection);
		header('Location:Login.php?error=2');
		die;
	}	
}
?>

<?php include("footer.php");?>

</body>
</html>