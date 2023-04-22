<!DOCTYPE html>
<html lang="en">
<head>
<title>Home Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
</head>

	<?php
		require './config.php';
		$id = $_COOKIE['id'];
		if (empty($id)) {
			// echo "<script>location.href='login.php';</script>";
			exit;
		}
		$sql = "SELECT * FROM administrators LEFT JOIN subcompanies ON administrators.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
		$result = $mysqli->query($sql);
		$administrator_Info = $result->fetch_assoc();

		$sql = "SELECT * FROM subcompanies LEFT JOIN administrators ON subcompanies.SUBCOMPANY_ID = administrators.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
		$result = $mysqli->query($sql);
		$company_Info = $result->fetch_assoc();

    	// check the number of workers
		$sql = "SELECT count(*) as count from employees WHERE LOCATION = '{$company_Info['LOCATION']}'";
		// var_dump($sql);exit();
		$result = $mysqli->query($sql);
		$staff = $result->fetch_assoc();

    	// check the number of projects
		$sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$administrator_Info['ADMINISTRATOR_ID']}";
		$result = $mysqli->query($sql);
		$projects = $result->fetch_assoc();

		// check the projects belong to the boss
    $sql =  "SELECT projects.*,managers.MANAGER_ID,employees.* FROM (projects left join managers ON projects.PROJECT_ID = managers.PROJECT_ID) left join employees ON managers.MANAGER_ID = employees.EMPLOYEE_ID  WHERE ADMINISTRATOR_ID = {$administrator_Info['ADMINISTRATOR_ID']}";
		$projectrs= $mysqli->query($sql);
		$projectList = [];
		foreach($projectrs as $k => $item){
			array_push($projectList,$item);
		}
  	?>

	<body class="w3-theme-l5">

		<!-- Navbar -->
		<div class="w3-top">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
				<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
				<a href="administrator.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Home</a>
				<a href="adm_1.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Manage Projects"><i class="fa fa-globe"></i></a>
				<a href="adm_2.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Manage Employees"><i class="fa fa-user"></i></a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
					<img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
				</a>
			</div>
		</div>

		<!-- Navbar on small screens -->
		<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
			<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
			<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
			<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
			<a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
		</div>

		<!-- Page Container -->
		<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
			<!-- The Grid -->
			<div class="w3-row">

				<!-- Left Column -->
				<div class="w3-col m2">
					
					<!-- Profile -->
					<div class="w3-card w3-round w3-white">
						<div class="w3-container">
						<h4 class="w3-center">My Profile</h4>
						<p class="w3-center"><img src="https://www.w3schools.com/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
						<hr>
						<p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i> <?php echo $administrator_Info['ADMINISTRATOR_ID']; ?></p>
						<p><i class="fa fa-address-book fa-fw w3-margin-right w3-text-theme"></i> <?php echo $administrator_Info['ADMINISTRATOR_NAME']; ?></p>
						</div>
					</div>
					<br>
			
					<!-- Accordion -->
					<div class="w3-card w3-round">
						<div class="w3-white">
							<button onclick="Function1('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>My Projects</button>
							<div id="Demo1" class="w3-hide w3-container">
								<br>
								<button type='button' class='w3-button w3-theme-d1 w3-margin-bottom w3-sepia-min w3-round' onclick='All()'>Show All</button>
								<?php
									foreach($projectList as $k => $project){
									$num = ++ $k;
									echo "<button type='button' class='w3-button w3-theme-d1 w3-margin-bottom w3-sepia-min w3-round' onclick='Function2({$num})'>Project {$num}</button>";
									}
								?>
							</div>
							<!-- <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button> -->
						</div>      
					</div>
					<br>
					<!-- Company --> 
					<div class="w3-card w3-round w3-white w3-hide-small">
						<div class="w3-container">
							<p>Company Information</p>
							<p class="w3-small">Company ID: <?php echo $administrator_Info['SUBCOMPANY_ID']; ?></p>
							<p class="w3-small">Location: <?php echo $administrator_Info['LOCATION']; ?></p>
							<p class="w3-small">Budget: <?php echo $administrator_Info['BUDGET']; ?></p>
							<p class="w3-small">Number of employees: <?php echo $staff['count']; ?></p>
							<p class="w3-small">Number of projects: <?php echo $projects['count']; ?></p>
						</div>
					</div>
					<br>
				</div>

				<!-- Right Column -->
				<div class=" main w3-col m10">

					<!-- Padding -->
					<div class="w3-row-padding">
						<div class="w3-col m12">
							<div class="w3-container w3-padding w3-card w3-round w3-theme-d4"></div>
						</div>
					</div>

					<?php
						foreach($projectList as $k => $project){
						$num = ++ $k;
						echo "<section class='w3-container w3-card w3-white w3-round w3-margin' id={$num}><br>";
						echo "<h6 class='w3-text-theme'><i class='fa fa-calendar fa-fw w3-margin-right'></i>{$project['START_DATE']} - {$project['END_DATE']}</h6>";
						echo "<h4>Project Name: {$project['PROJECT_NAME']}</h4>";
						echo "<hr class='w3-clear'>";
						echo "<p>Project ID: {$project['PROJECT_ID']}</p>";
						echo "<p>Budget: {$project['BUDGET']}</p>";
						echo "<p>Manager name: {$project['EMPLOYEE_NAME']}</hp>";
						echo "<p>Manager ID: {$project['EMPLOYEE_ID']}</hp>";
						echo "</section>";
						}
					?>
				<!-- End Middle Column -->
				</div>
			<!-- End Grid -->
			</div>
		<!-- End Page Container -->
		</div>
		<br>

		<footer class="w3-container w3-theme-d5">
			<p>Powered by <a href="https://github.com/as3ert/csc3170" target="_blank">Group 8</a></p>
		</footer>
		
		<script>
		
		// Accordion
		function Function1(id) {
			var x = document.getElementById(id);
			if (x.className.indexOf("w3-show") == -1) {
				x.className += " w3-show";
				x.previousElementSibling.className += " w3-theme-d1";
			} else { 
				x.className = x.className.replace("w3-show", "");
				x.previousElementSibling.className = 
				x.previousElementSibling.className.replace(" w3-theme-d1", "");
			}
		}

		function Function2(id){
			var idSection = document.getElementById(id);
			var mainSections = document.querySelectorAll(".main section");
			for (var i = 0; i < mainSections.length; i++) {
				mainSections[i].style.display = "none";
			}
			idSection.style.display = "block";
		}

		function All(){
			var mainSections = document.querySelectorAll(".main section");
			for (var i = 0; i < mainSections.length; i++) {
				mainSections[i].style.display = "block";
			}
		}

		// Used to toggle the menu on smaller screens when clicking on the menu button
		function openNav() {
			var x = document.getElementById("navDemo");
			if (x.className.indexOf("w3-show") == -1) {
				x.className += " w3-show";
			} else { 
				x.className = x.className.replace(" w3-show", "");
			}
		}
		</script>
	</body>
</html> 