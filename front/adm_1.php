<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Projects</title>
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
    	echo "<script>location.href='login.php';</script>";
    	exit;
    }
    $sql = "SELECT * FROM administrators LEFT JOIN subcompanies ON administrators.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
    $result = $mysqli->query($sql);
    $adminInfo = $result->fetch_assoc();

    $sql = "SELECT * FROM subcompanies LEFT JOIN administrators ON subcompanies.SUBCOMPANY_ID = administrators.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
    $result = $mysqli->query($sql);
    $comInfo = $result->fetch_assoc();

    // check the number of workers
    $sql = "SELECT count(*) as count from employees WHERE LOCATION = '{$comInfo['LOCATION']}'";
    $result = $mysqli->query($sql);
    $staff = $result->fetch_assoc();

    // check the number of projects
    $sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$adminInfo['ADMINISTRATOR_ID']}";
    $result = $mysqli->query($sql);
    $projects = $result->fetch_assoc();

    $staffSql =  "SELECT * FROM employees WHERE LOCATION = '{$comInfo['LOCATION']}'";
    $staffrs= $mysqli->query($staffSql);
    $staffList = [];
    foreach ($staffrs as $k => $item) {
        array_push($staffList,$item);
    }
    
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      	if ($_GET['act'] == 'add') {
        // whether project_ID has already existed
			$sql = "select * from projects where (PROJECT_ID='{$_POST['Project_ID']}')";
			$result = $mysqli->query($sql);
			$row = $result->fetch_assoc();
			if ($row) {
				echo "<script>javascript:alert('Project_ID has already been existed!');location.href='adm_1.php';</script>";
				exit;
        	}
        
        // mark the manager in 'employees'
        $sql = " UPDATE employees SET MANAGE_PROJECT_ID = '{$_POST['Project_ID']}' WHERE EMPLOYEE_ID = '{$_POST['Manager_ID']}'";
        $res = $mysqli->query($sql);

        // check employees' total salary
        $frontIds = [];
        $backIds = [];
        $testIds = [];

        foreach ($_POST as $key => $value) {
        	if (strstr($key, '^')) {
            	$arr = explode('^', $key);
            	if ($arr[0] == 'Front End') {
              		$frontIds[] = $arr[1];
            	} elseif ($arr[0] == 'Back End') {
              		$backIds[] = $arr[1];
            	} else {
              		$testIds[] = $arr[1];
            	}
          	}
        }

        $frontCount = count($frontIds);
        $backCount = count($backIds);
        $testCount = count($testIds);

        if (empty($frontIds) && empty($backIds) && empty($testIds)) {
          	echo "<script>javascript:alert('Please at least chose one employee!');location.href='adm_1.php';</script>";
          	exit;
        }

        $total = 0;

        if (!empty($frontIds)) {
          	foreach ($frontIds as $id) {
				$sql1 = "select * from employees where EMPLOYEE_ID='{$id}'";
				$result1 = $mysqli->query($sql1);
				$row1 = $result1->fetch_assoc();
				$total += $row1['SALARY'];
          	}
        }

        if (!empty($backIds)) {
          	foreach ($backIds as $id) {
				$sql1 = "select * from employees where EMPLOYEE_ID='{$id}'";
				$result1 = $mysqli->query($sql1);
				$row1 = $result1->fetch_assoc();
				$total += $row1['SALARY'];
          	}
        }

        if (!empty($testIds)) {
          	foreach ($testIds as $id) {
				$sql1 = "select * from employees where EMPLOYEE_ID='{$id}'";
				$result1 = $mysqli->query($sql1);
				$row1 = $result1->fetch_assoc();
				$total += $row1['SALARY'];
          	}
        }
        
        // check the budget
        $sql = "select * from subcompanies where SUBCOMPANY_ID ='{$adminInfo['SUBCOMPANY_ID']}'";
        // var_dump($sql);exit();
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        // compare with budget
        if ($total > $row['BUDGET']) {
          	echo "<script>javascript:alert('over budget!');location.href='adm_1.php';</script>";
          	exit;
        } else {
          	// change the company's budget
          	$budget_update = $row['BUDGET'] - $total;
          	// var_dump($sql);exit();
          	$sql = " UPDATE subcompanies SET BUDGET = '{$budget_update}' WHERE SUBCOMPANY_ID = '{$adminInfo['SUBCOMPANY_ID']}'";
          	$res = $mysqli->query($sql);
        }
    	
		// projects add a new record
        $sql = "insert into projects(PROJECT_ID,ADMINISTRATOR_ID,PROJECT_NAME,START_DATE,END_DATE,FRONT_END_NUMBER,BACK_END_NUMBER,TESTING_NUMBER,BUDGET) values ('{$_POST['Project_ID']}','{$adminInfo['ADMINISTRATOR_ID']}','{$_POST['Project_name']}','{$_POST['Start_date']}','{$_POST['End_date']}','{$_POST['Front_end_number']}','{$_POST['Back_end_number']}','{$_POST['Testing_number']}','{$total}')";
        $res = $mysqli->query($sql);

		// jobs add new records
		if (!empty($frontIds)) {
			foreach ($frontIds as $id){
				$sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$id}','{$_POST['Project_ID']}')";
				$res = $mysqli->query($sql1);
			}
		}
		if (!empty($backIds)) {
			foreach ($backIds as $id) {
				$sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$id}','{$_POST['Project_ID']}')";
				$res = $mysqli->query($sql1);
			}
		} 
		if (!empty($testIds)) {
			foreach ($testIds as $id) {
				$sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$id}','{$_POST['Project_ID']}')";
				$res = $mysqli->query($sql1);
			}
		}
		// managers add a new record
		$sql = "insert into managers(MANAGER_ID,PROJECT_ID) values ('{$_POST['Manager_ID']}','{$_POST['Project_ID']}')";
		$res = $mysqli->query($sql);
		echo "<script>javascript:location.href='administrator.php';</script>";
		exit;
    }
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
					<p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i> <?php echo $adminInfo['ADMINISTRATOR_ID']; ?></p>
					<p><i class="fa fa-address-book fa-fw w3-margin-right w3-text-theme"></i> <?php echo $adminInfo['ADMINISTRATOR_NAME']; ?></p>
				</div>
			</div>
			<br>
      
		<!-- Company --> 
			<div class="w3-card w3-round w3-white w3-hide-small">
				<div class="w3-container">
					<p>Company Informations</p>
					<p class="w3-small">Company ID: <?php echo $adminInfo['SUBCOMPANY_ID']; ?></p>
					<p class="w3-small">location: <?php echo $adminInfo['LOCATION']; ?></p>
					<p class="w3-small">Budget: <?php echo $adminInfo['BUDGET']; ?></p>
					<p class="w3-small">number of employees: <?php echo $staff['count']; ?></p>
					<p class="w3-small">number of projects: <?php echo $projects['count']; ?></p>
				</div>
			</div>
			<br>
		<!-- End Left Column -->
		</div>

    	<!-- Right Column -->
		<div class=" main w3-col m10">
			<div class="w3-row-padding w3-margin-bottom">
				<div class="w3-col m12">
					<div class="w3-card w3-round w3-white">
						<div class="w3-container w3-padding">
						<h4 class="w3-opacity">Create a new project</h4>
						<form name="form" method="post" action="adm_1.php"  enctype="multipart/form-data">
						<input type="text"name="Project_ID" placeholder="Project ID" required="required" id="Project_ID">
						<input type="text"name="Project_name" placeholder="Project Name" required="required" id="Project_name">
						<p></p>
						<input type="text"name="Front_end_number" placeholder="Front End Number" required="required" id="Front_end_number">
						<input type="text"name="Back_end_number" placeholder="Back End Number" required="required" id="Back_end_number">
						<input type="text"name="Testing_number" placeholder="Testing Number" required="required" id="Testing_number">
						<p></p>
						<input type="date"name="Start_date" placeholder="Start_date" required="required" id="Start_date">
						<input type="date"name="End_date" placeholder="End_date" required="required" id="End_date"> 
						<p></p>
						<td>
							Front_end_staff:
							<?php
								foreach ($staffList as $staff) {
									if ($staff['POSITION'] == 'Front End') {
										echo "<input type='checkbox' name='Front End^{$staff['EMPLOYEE_ID']}' value='{$staff['EMPLOYEE_ID']}'>";
										echo "<label>{$staff['EMPLOYEE_NAME']} </label>";
									}
								}
							?>
							</td>
						<p></p>
							<td>
							Back_end_staff:
							<?php
								foreach ($staffList as $staff) {
									if ($staff['POSITION'] == 'Back End') {
										echo "<input type='checkbox' name='Back End^{$staff['EMPLOYEE_ID']}' value='{$staff['EMPLOYEE_ID']}'>";
										echo "<label>{$staff['EMPLOYEE_NAME']} </label>";
									}
								}
							?>
						</td>

						<p></p>
						<td>Testing_staff:
							<?php
								foreach ($staffList as $staff) {
									if ($staff['POSITION'] == 'Testing') {
										echo "<input type='checkbox' name='Testing^{$staff['EMPLOYEE_ID']}' value='{$staff['EMPLOYEE_ID']}'>";
										echo "<label>{$staff['EMPLOYEE_NAME']} </label>";
									}
								}
							?>
						</td>
						<p></p>
						<td>
							Manager:
							<select name='Manager_ID' id='Manager_ID' required>
							<?php
								echo "<option value=''> </option>";
								foreach ($staffList as $staff) {
									if ($staff['MANAGE_PROJECT_ID'] == NULL) {
										echo "<option value='{$staff['EMPLOYEE_ID']}'>{$staff['EMPLOYEE_NAME']}</option>";
									}
								}
							?>
							</select>
						</td>
						<p></p>
						<button class="w3-button w3-theme" type="submit" name="submit" value="Add" onclick="act1()"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
						</form>
					</div>
				</div>
			</div>
		</div>      
		<!-- End Middle Column -->
		</div>
	<!-- End Grid -->
	</div>
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d5">
  	<p>Powered by <a href="https://github.com/as3ert/csc3170" target="_blank">Gruop 8</a></p>
</footer>
 
<script>
// Accordion
function act1(){
    document.form.action="adm_1.php?act=add";
    document.form.submit();
}

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