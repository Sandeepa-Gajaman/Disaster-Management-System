<?php session_start();?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>
<?php
if(isset($_POST['submit'])){
	$db= mysqli_connect('localhost','root','','incidentreportingapp');//set database connection 
	if(!$db){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
  
	date_default_timezone_set('Asia/Colombo'); 
	$time=date("h:i:sa");//get current time in colombo
	$date=date("Y.m.d");//get date
   
	$reportId= $_POST['reportId'];
	$title=mysqli_real_escape_string($db,$_POST['title']);     
	$category=mysqli_real_escape_string($db,$_POST['category']);    
	$content=mysqli_real_escape_string($db,$_POST['content']);     
	$threatLevel=mysqli_real_escape_string($db,$_POST['level']);   
	$deaths=mysqli_real_escape_string($db,$_POST['deaths']);   
	$missing=mysqli_real_escape_string($db,$_POST['missing']);
	$severly=mysqli_real_escape_string($db,$_POST['severely']);
	$minory=mysqli_real_escape_string($db,$_POST['minor']);
	
	//Server side validation.
	if(empty($category)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId"); exit();}
	if(empty($content)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");exit();}
	if(empty($threatLevel)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");exit();}
	//if(empty($deaths)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");}
	//if(empty($missing)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");}
	//if(empty($severly)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");}
	//if(empty($minory)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");}
	if(!preg_match("/^[0-9]+$/",$deaths)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");exit();}
	if(!preg_match("/^[0-9]+$/",$minory)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");exit();}
	if(!preg_match("/^[0-9]+$/",$missing)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");exit();}
	if(!preg_match("/^[0-9]+$/",$severly)){header("Location:UpdateIncidentForm.php?error=4&reportId=$reportId");exit();}
	else{
		$sql= "UPDATE incident SET title = '$title',category='$category' ,content='$content' ,threatLevel=$threatLevel, date_='$date', time_='$time', deaths=$deaths, missing=$missing, severelyInjured=$severly, minorlyInjured=$minory, approval=0 WHERE reportId=$reportId";
		$res= mysqli_query($db,$sql);
		if($res==1){
			header("Location: UpdateIncidentFormResult.php?status=1");
		}
		else{
			header("Location: UpdateIncidentFormResult.php?status=2");
		}											
	}
}
?>