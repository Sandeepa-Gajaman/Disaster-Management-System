<!DOCTYPE html>
<html lang= "en">
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Update Incident Report</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src= "UpdateIncidentForm.js"></script> 
<link rel= "stylesheet" type= "text/css" href= "Well.css">
</head>
<body>

<?php
   //edit
if(isset($_GET['error'])){if($_GET['error']==1){
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> There is something wrong with upload
  </div></div>";
  }
  
  else if($_GET['error']==10)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Image size is too much!
  </div></div>";
  }
  
 else if($_GET['error']==5)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Not allowed
  </div></div>";
  }
   else if($_GET['error']==4)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Can't have empty Field or Can't have Invalid data
  </div></div>";
  }
   else if($_GET['error']==8)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Something wrong with uploaded image please Try Again!
  </div></div>";
  }
   else if($_GET['error']==9)
  {
  echo"<div class='container'>
  <div class='alert alert-warning alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>
    <strong>Warning!</strong> Invalid Image Type!
  </div></div>";
  }
}



?>




<?php session_start(); require("Navbar.php");?>						
<?php if(!isset($_SESSION['userId'])){header('Location: NoAccess.php'); die;}?>

<div class= "well headingWell"><h3 id= "h31">Update Incident</h3></div>

<?php
$reportId= $_GET['reportId'];										//Secure this part.
//database configuration.
$db=mysqli_connect('localhost','root','','incidentreportingapp');
if(!$db){header('location:GeneralErrors.php?error=1'); die;} //Handles a bad conection to the server.
$query="select * from incident where reportId=$reportId";			
$res=mysqli_query($db,$query);

$row=mysqli_fetch_array($res);
$reportId=$row['reportId'];
$title=$row['title'];
$content=$row['content'];
$threatLevel=$row['threatLevel'];
$category=$row['category'];
$deaths=$row['deaths'];
$missing=$row['missing'];
$severlyInjured=$row['severelyInjured'];
$minorlyInjured=$row['minorlyInjured'];

echo"<div class= 'container-fluid' style= 'margin-top: 50px;'>
<div class= 'row'>
<div class= 'col-md-12'>

</div>
</div>

</div>
<div class='container'>
<div class= 'col-md-12'>
<div class='row'>
         <div class='col-sm-2'>";?><?php if(isset($_GET['error'])){if($_GET['error']==4){echo "<h4 style= 'color: red'>Can't leave fields empty!</h4>";}}?><?php echo "</div><br/>
</div>";?>


	<form action= 'UpdateIncidentFormProcess.php' method='post' onsubmit="return hellocheck()">
	<div class='row'>
	    <div class='col-sm-2'>
		   <label for='Category'>Category:</label>    
        </div>
		<div class='col-sm-4'>
         <select name='category'>
             <option value='Fire'<?php if ($category == 'Fire') echo ' selected="selected"'; ?>>Fires</option>
             <option value='Road Side accident'<?php if ($category == 'Road Side accident') echo ' selected="selected"'; ?>>Road Side accident</option>  
             <option value='Hurricance'<?php if ($category == 'Hurricance') echo ' selected="selected"'; ?>>Hurricance</option>
             <option value='Land Slide'<?php if ($category == 'Land Slide') echo ' selected="selected"'; ?>>Land Slide</option>
             <option value='Electrical Breakdown and Leakage'<?php if ($category == 'Electrical Breakdown and Leakage') echo ' selected="selected"'; ?>>Electrical Breakdown and Leakage</option>
             <option value='Flood'<?php if ($category == 'Flood') echo ' selected="selected"'; ?>>Flood</option>
             <option value='other' <?php if ($category == 'other') echo ' selected="selected"'; ?>>other</option>
   
          </select>
        </div>
	  </div><br>
	  <?php echo"
 	   <div class=row'>
	      <div class='col-sm-2'>
		    <label for='Title'>Title:</label> 
	       
		   </div>
		   <div class=col-sm-4'>
		     <input type='text' name='title'id='texta'onfocusout='myFunction()'value='$title'>
		   </div>
		    <div class='col-sm-2'>
		     <p id='a' style='display: none;'> *Required Field</p>
		   </div>
       </div><br>
	   <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>content:</label> 
	       
		   </div>
		   <div class='col-sm-4'>
		       <textarea placeholder='content' name='content' rows='10' cols='40'id='tArea'onfocusout='myFunction1()'>$content</textarea>
		   </div>
		   <div class='col-sm-2'>
		     <p id='b' style='display: none;'> *Required Field</p>
		   </div>
       </div></br>
	   <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>Threat Level:</label> 
	       
		   </div>
		   <div class='col-sm-4'>";?>
		    
		     <input  id='star-1' type='radio' name='level' title='High threat'value='1'<?php  if($threatLevel==1)echo 'checked="checked"';?>/>
             <label  for='star-1'>Low </label>
             <input  id='star-2' type='radio' name='level' title='Medium threat'value='2'<?php  if($threatLevel==2)echo 'checked="checked"';?>/>
             <label  for='star-2'title='Medium threat'>Medium</label>
             <input id='star-3' type='radio' name='level' title='High threat'value='3'<?php  if($threatLevel==3)echo 'checked="checked"';?>/>
             <label  for='star-3'>High</label>
			
       </div>
	  <?php echo "
	   <div class='col-sm-2'>
		     <p id='threatb' style='display: none;'> *Required Field</p>
		   </div>
	  </div></br>
	   
	    <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>Images:</label> 
	       
		   </div>
		   <div class='col-sm-4'>
		   </div>
		   <div class='col-sm-2'>
		     <p id='imagesb' style='display: none;'> *Required Field</p>
		   </div>
       </div></br>
	   <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>No.of Deaths</label> 
	       
		   </div>
		   <div class='col-sm-4'>
		       <input type='text' name='deaths'id='deathA'onfocusout='myfunction2();' value='$deaths'>
		   </div>
		   <div class='col-sm-2'>
		     <p id='deathB' style='display: none;'> *Required Field</p>
		   </div>
       </div></br>
	   <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>No.of Missing</label> 
	       
		   </div>
		   <div class='col-sm-4'>
		       <input type='text' name='missing'id='missingA'onfocusout='myfunction3();'value='$missing'>
		   </div>
		   <div class='col-sm-2'>
		     <p id='missingB' style='display: none;'> *Required Field</p>
		   </div>
       </div></br>
	   <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>No.of Severely</label> 
	       
		   </div>
		   <div class='col-sm-4'>
		       <input type='text' name='severely'id='severelyA'onfocusout='myfunction4();'value='$severlyInjured'>
		   </div>
		   <div class='col-sm-2'>
		     <p id='severelyB' style='display: none;'> *Required Field</p>
		   </div>
       </div></br>
	   <div class='row'>
	      <div class='col-sm-2'>
		    <label for='Title'>No.of Minor Injuries</label> 
	       
		   </div>
		   <div class='col-sm-4'>
		       <input type='text' name='minor'id='minorA'onfocusout='myfunction5();'value='$minorlyInjured'>
		   </div>
		   <div class='col-sm-2'>
		     <p id='minorB' style='display: none;'> *Required Field</p>
		   </div>
       </div></br>
	   <div class='row'>
	     
		   <div class='col-sm-3'>
				<input name='reportId' type='hidden' value=$reportId>
		        <input name='submit' type='submit' value='Save Changes'class='btn btn-default'>
		   </div>
       </div></br>
	</form>
</div>
	
</div>";
echo "<br/>";
?>
<?php require("UpdateIncidentReportImages.php");?>

<div class= "container-fluid" style= "margin-bottom: 70px;"></div>

<?php include("footer.php");?>

</body>
</html>