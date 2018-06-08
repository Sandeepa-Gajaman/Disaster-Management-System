<?php session_start();?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>
<?php
$reportId=$_POST['reportId'];
$name=$_POST['name'];
//echo $reportId;

$db= mysqli_connect('localhost','root','','incidentreportingapp');
if(!$db){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.

$file=$_FILES['file'];					//get file
$filename=$_FILES['file']['name'];		//get the file name
$fileTmpName=$_FILES['file']['tmp_name'];//get the tmp
$filesize=$_FILES['file']['size'];		//get the file size
$fileError=$_FILES['file']['error'];	//file error 0 or 1
$filetype=$_FILES['file']['type'];
//echo $filename;
$fileExt=explode('.',$filename);		//break the file into array
$fileActualExt=strtolower(end($fileExt)); //last element of array
$allowed= array('jpg','jpeg','png');	//allowed extention
	  
if(in_array($fileActualExt,$allowed)){
	//echo "<br/>File type allowed";	  
	if($fileError===0){
		if($filesize<100000000){
			$fileNamenew=uniqid('',true).".".$fileActualExt;
			$img= file_get_contents($_FILES['file']['tmp_name']);//gets content as string read the entire file into string
			$img= base64_encode($img);							//encode string to binary
			$fileDestination= 'uploads/'.$fileNamenew;			//Save a copy of the image in a file folder.
			move_uploaded_file($fileTmpName,$fileDestination); 
			
			$sql= "UPDATE incidentreportimages SET  image='$img',imagename='$fileNamenew' where reportId=$reportId and imagename='$name'" ;
			$res= mysqli_query($db,$sql);
			if($res== 1){
				//echo "<br/>Image saved!";
				header("Location: UpdateIncidentForm.php?reportId=$reportId");
				exit();
			}
			else{
			header("Location:UpdateIncidentForm.php?error=1&reportId=$reportId");
			exit();
			//Handle error.
		        }
		}
		else{
			header("Location:UpdateIncidentForm.php?error=10&reportId=$reportId");
			exit();
			//Handle error.
		}
	}
	else{
		header("Location:UpdateIncidentForm.php?error=8&reportId=$reportId");
		exit();
		//Handle error.
	}
}
else{
	header("Location:UpdateIncidentForm.php?error=9&reportId=$reportId");
	exit();
	//Handle error.
}
?>