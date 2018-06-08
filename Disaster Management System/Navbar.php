<nav class="navbar navbar-default" style= "background-color: #E6E6FA;">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-4">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="Index.php">Incident Reporting App</a>
		</div>
		<div class= "collapse navbar-collapse" id= "navbar-collapse-4">
			<ul class="nav navbar-nav navbar-left" style= 'margin-left: 50px;'>
				<li><a href="Index.php">Home</a></li>
				<li><a href="Incidents.php">Incidents</a></li>
				<li><a href= "StatisticsYearSelect.php">Statistics</a></li>
				<li><a href= "EmergencyContacts.php">Emergency Contacts</a></li>
				<li><a href= "AboutUs.php">About Us</a></li>
			</ul>
			<ul class= "nav navbar-nav navbar-right" style= 'margin-left: 50px;'>
			<?php if(isset($_SESSION['userId'])){
				if($_SESSION['userType']== 'manager'){
					echo "<li><a href= 'ManagerAccountDashboard.php'>".$_SESSION['fName']." ".$_SESSION['lName']."</a></li>";
				}
				else if($_SESSION['userType']== 'admin'){
					echo "<li><a href= 'AdminAccountDashboard.php'>".$_SESSION['fName']." ".$_SESSION['lName']."</a></li>";
				}
				else if($_SESSION['userType']== 'normalUser'){
					echo "<li><a href= 'UserAccountDashboard.php'>".$_SESSION['fName']." ".$_SESSION['lName']."</a></li>";
				}
			} 
			?>
			<?php if(isset($_SESSION['userId'])){echo "<li><a href= 'Logout.php'>Log Out  <span class= 'glyphicon glyphicon-off'></a></li>";}
				else{ echo "<li><a href= 'Login.php'>Log In  <span class= 'glyphicon glyphicon-log-in'></a></li>";} 
			?>
			</ul>
		</div>
	</div>
</nav>
