<?php session_start();?>
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>
<?php
try{
	$serverName= "localhost";
	$serverUserName= "root";
	$serverPassword= "";
	$dbName= "incidentreportingapp";
	
	$connection= mysqli_connect($serverName, $serverUserName, $serverPassword, $dbName);
	if(!$connection){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.

	if(isset($_POST['reportId'])){
		$reportId= $_POST['reportId'];
	}

	if(isset($_POST['delete'])){
		$query= "Delete from incident where reportId= $reportId";
		$execute= mysqli_query($connection, $query);
		if($execute== 0){header('location:IncidentViewFunctionsResult.php?error=1');}
	
		$query= "Delete from incidentreportimages where reportId= $reportId";
		$execute= mysqli_query($connection, $query);
		if($execute== 0){header('location:IncidentViewFunctionsResult.php?error=1');}
		else{header('location:IncidentViewFunctionsResult.php?status=1');}
	}

	if(isset($_POST['setActive'])){
		$query= "Update incident set state= 1 where reportId= $reportId";
		$execute= mysqli_query($connection, $query);
		if($execute== 0){header('location:IncidentViewFunctionsResult.php?error=2');}
		else{header('location:IncidentViewFunctionsResult.php?status=2');}
	}

	if(isset($_POST['setOver'])){
		$query= "Update incident set state= 0 where reportId= $reportId";
		$execute= mysqli_query($connection, $query);
		if($execute== 0){header('location:IncidentViewFunctionsResult.php?error=2');}
		else{header('location:IncidentViewFunctionsResult.php?status=2');}
	}

	if(isset($_POST['approve'])){
		$query= "Update incident set approval= 1 where reportId= $reportId";
		$execute= mysqli_query($connection, $query);
		if($execute== 0){header('location:IncidentViewFunctionsResult.php?error=3');}
		else{header('location:IncidentViewFunctionsResult.php?status=3');}
	}

	if(isset($_POST['disapprove'])){
		$query= "Update incident set approval= 2 where reportId= $reportId";
		$execute= mysqli_query($connection, $query);
		if($execute== 0){header('location:IncidentViewFunctionsResult.php?error=4');}
		else{header('location:IncidentViewFunctionsResult.php?status=4');}
	}
}
catch(Exception $e){
	header('location:GeneralErrors.php?error=3'); die;
}
?>