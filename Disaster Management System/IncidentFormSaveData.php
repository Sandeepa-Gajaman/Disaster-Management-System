<?php session_start();?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<?php
$a=0;
if(isset($_POST['submit'])){
	$db= mysqli_connect('localhost','root','','incidentreportingapp');//set database connection 
	if(!$db){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
  
	date_default_timezone_set('Asia/Colombo'); 
	$time=date("h:i:sa");//get current time in colombo
       $date=date("Y.m.d");//get date
	   //echo $date;
	
   
	$userid= $_SESSION['userId'];
	$title=mysqli_real_escape_string($db,$_POST['title']);     
	$category=mysqli_real_escape_string($db,$_POST['category']);    
	$content=mysqli_real_escape_string($db,$_POST['content']);     
	$threatLevel=mysqli_real_escape_string($db,$_POST['level']);   
	$deaths=mysqli_real_escape_string($db,$_POST['deaths']);   
	$missing=mysqli_real_escape_string($db,$_POST['missing']);
	$severly=mysqli_real_escape_string($db,$_POST['severely']);
	$minory=mysqli_real_escape_string($db,$_POST['minor']);
	$lat=mysqli_real_escape_string($db,$_POST['dbLattitude']);
	$long=mysqli_real_escape_string($db,$_POST['dbLongitude']);
	$city=mysqli_real_escape_string($db,$_POST['dbCity']);
	
	//validation for image
   $files=$_FILES['files'];
	
	foreach($_FILES['files']['name'] as $position=> $file_name)
	{  
	
	$fileTmpName=$_FILES['files']['tmp_name'][$position];//temp loc
    $filesize=$_FILES['files']['size'][$position];//get file size (Are individual file sizes calculated, or is it for the whole array?).
	$fileError=$_FILES['files']['error'][$position];//0 or 1 corrupt
	$fileExt=explode('.',$file_name);  //explode
	$fileActualExt=strtolower(end($fileExt));   //string to lower and get last
	$allowed= array('jpg','jpeg','png');//allowed extensions.

	echo $filesize; echo"<br />";
	echo $fileTmpName;echo"<br />";
	//$allowed= array('jpg','jpeg','png');
	   if(!(in_array($fileActualExt,$allowed)))
	    {
			header('Location:IncidentForm.php?error=8');
		//echo("file extention");
		    exit();
		}
		else if($fileError===1)
		{
		   header('Location:IncidentForm.php?error=9');
		 //  echo("file error");
		   exit();	
		}
		else if($filesize>10000000)
		{
			//echo("file size");				
			header('Location:IncidentForm.php?error=10');
		   exit();
		}
	}
						
		
		
	    
	
	
	
	
	
	
	
	

	//Server side validation.
	if(empty($category)){header('Location:IncidentForm.php?error=4');}
	if(empty($content)){header('Location:IncidentForm.php?error=4');}
	if(empty($threatLevel)){header('Location:IncidentForm.php?error=4');}
	//if(empty($deaths)){header('Location:IncidentForm.php?error=4');}
	//if(empty($missing)){header('Location:IncidentForm.php?error=4');}
	//if(empty($severly)){header('Location:IncidentForm.php?error=4');}
	//if(empty($minory)){header('Location:IncidentForm.php?error=4');}
	if(empty($lat)){header('Location:IncidentForm.php?error=4');}
	if(empty($long)){header('Location:IncidentForm.php?error=4');}
	if(!preg_match("/^[0-9]+$/",$deaths)){header('Location:IncidentForm.php?error=4');}
	if(!preg_match("/^[0-9]+$/",$minory)){header('Location:IncidentForm.php?error=4');}
	if(!preg_match("/^[0-9]+$/",$missing)){header('Location:IncidentForm.php?error=4');}
	if(!preg_match("/^[0-9]+$/",$severly)){header('Location:IncidentForm.php?error=4');}
  	else{
		//Diagnostics code.
		/*echo $userid; echo"</br>"; echo $title; echo"</br>"; echo $category;echo"</br>"; echo $content; echo"</br>"; echo $threatLevel; echo"</br>"; echo $deaths; echo"</br>";
		echo $missing; echo"</br>"; echo $severly; echo"</br>"; echo $minory; echo"</br>"; echo $lat; echo"</br>"; echo $long; echo"</br>"; echo $city; echo"</br>";
		echo $date; echo"</br>"; echo $time; echo"</br>"; echo $city; echo"</br>";*/
		
		$sql="INSERT INTO incident(userId,title,content,threatLevel,category,date_,time_,lattitude,longitude,city,deaths,missing,severelyInjured,minorlyInjured)VALUES($userid,'$title','$content',$threatLevel,'$category','$date','$time',$lat,$long,'$city',$deaths,$missing,$severly,$minory)";
		$res= mysqli_query($db, $sql);
		if($res== 1){
			$sql="SELECT * FROM incident ORDER BY reportId DESC LIMIT 1";
			$res=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($res);
			$rid=$row['reportId'];
	
			$files=$_FILES['files'];
			foreach($_FILES['files']['name'] as $position=> $file_name){     
				$fileTmpName=$_FILES['files']['tmp_name'][$position];//temp loc
				$filesize=$_FILES['files']['size'][$position];//get file size (Are individual file sizes calculated, or is it for the whole array?).
				$fileError=$_FILES['files']['error'][$position];// 0 or 1
				$fileExt=explode('.',$file_name);  //explode
				$fileActualExt=strtolower(end($fileExt));   //string to lower and get last
				//$allowed= array('jpg','jpeg','png');//allowed extensions.

				
							$fileNamenew=uniqid('',true).".".$fileActualExt;
							$img=file_get_contents($_FILES['files']['tmp_name'][$position]);//gets content as string read the entire file into string
							$img=base64_encode($img);//encode string to binary
							$fileDestination='uploads/'.$fileNamenew;
							move_uploaded_file($fileTmpName,$fileDestination);
							$sql="INSERT INTO incidentreportimages(reportId,imagename,image)VALUES($rid,'$fileNamenew','$img')";
							$res=mysqli_query($db,$sql);
						
						
							
						 	//header("Location:a.php?error=$a");
							
			}
			header("Location: IncidentFormResult.php?status=1");
		}
	    else{
			header("Location: IncidentFormResult.php?status=2");
		}
	}
}
?>