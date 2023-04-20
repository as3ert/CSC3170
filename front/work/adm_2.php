<!DOCTYPE html>
<html lang="en">
<head>
<title>Administrator_web2</title>
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
		// 未登录，跳转
			echo "<script>location.href='login.php';</script>";
			exit;
		}
		$sql = "SELECT * FROM administrators LEFT JOIN subcompanies ON administrators.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
		$result = $mysqli->query($sql);
		$adminInfo = $result->fetch_assoc();

		$sql = "SELECT * FROM subcompanies LEFT JOIN administrators ON subcompanies.SUBCOMPANY_ID = administrators.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
		$result = $mysqli->query($sql);
		$comInfo = $result->fetch_assoc();

		// 查询员工数量
		$sql = "SELECT count(*) as count from employees WHERE LOCATION = '{$comInfo['LOCATION']}'";
		$result = $mysqli->query($sql);
		$staff = $result->fetch_assoc();

		// 查询项目数量
		$sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$adminInfo['ADMINISTRATOR_ID']}";
		$result = $mysqli->query($sql);
		$projects = $result->fetch_assoc();
		$act = !empty($_GET['act']) ? trim($_GET['act']) : '';

		if ($_SERVER['REQUEST_METHOD']==='POST') {

			if ($_GET['act'] == 'add') {
				$Worker_ID = $_POST['Worker_ID'];
				$name = $_POST['name'];
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$Position = $_POST['Position'];
				$Salary = $_POST['Salary'];
				$date = $_POST['date'];

				if (empty($Worker_ID) || empty($name) || empty($Position) || empty($Salary) || empty($age) || empty($gender) || empty($date)) {
					echo "<script>location.href='adm_2.php';</script>";
					exit;
				}

				// 判断第一位是否是1
				if($Worker_ID[0] != 0){
					echo "<script>location.href='adm_2.php';</script>";
					exit;
				}

				// 判断员工Id是否存在
				$sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
				$result = $mysqli->query($sql);
				$row = $result->fetch_assoc();
				if ($row) {
					echo "<script>location.href='adm_2.php';</script>";
					exit;
				}


				// employees表新增一条记录
				$sql = "insert into employees(EMPLOYEE_ID,EMPLOYEE_NAME,AGE,GENDER,POSITION,SALARY,PASSWORD,LOCATION, ENTRY_DATE) values ('{$Worker_ID}','{$name}','{$age}','{$gender}','{$Position}','{$Salary}','123456','{$adminInfo['LOCATION']}','{$date}')";
				$res = $mysqli->query($sql);
				echo "<scriptlocation.href='adm_2.php';</script>";
				exit;
			} else {
				$Worker_ID = $_POST['Worker_ID1'];

				// 1、首先查询该id是否存在employees表
				$sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
				$result = $mysqli->query($sql);
				$row = $result->fetch_assoc();
				if (!$row) {
					echo "<script>location.href='adm_2.php';</script>";
					exit;
				}

				// 2、删除employees表数据
				$sql = "delete FROM employees where (EMPLOYEE_ID='{$Worker_ID}')";
				$result = $mysqli->query($sql);

				// 3、删除jobs表数据
				$sql = "delete FROM jobs where (EMPLOYEE_ID='{$Worker_ID}')";
				$result = $mysqli->query($sql);

				// 4、删除managers表数据
				$sql = "delete FROM managers where (MANAGER_ID='{$Worker_ID}')";
				$result = $mysqli->query($sql);
				echo "<script>location.href='adm_2.php';</script>";
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
				<a href="adm_1.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
				<a href="adm_2.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
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
									<h4 class="w3-opacity">ADD AN NEW EMPLOYEE</h4>
									<input type="text"name="Employee_ID" placeholder="Employee_ID" required="required" id="Employee_ID">
									<input type="text"name="Name" placeholder="Name" required="required" id="Name">
									<input type="text"name="Age" placeholder="Age" required="required" id="Age">
									<input type="text"name="Gender" placeholder="Gender" required="required" id="Gender">
									<p></p>
									<input type="text"name="Position" placeholder="Position" required="required" id="Position">
									<input type="text"name="Salary" placeholder="Salary" required="required" id="Salary">
									<input type="date"name="Entry_date" placeholder="Entry_date" required="required" id="Entry_date">
									<p></p>
									<button type="button" class="w3-button w3-theme" value="Add Staff"  onclick="act1()"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
								</div>
							</div>
						</div>
					</div>

					<div class="w3-row-padding  w3-margin-bottom" >
						<div class="w3-col m12">
							<div class="w3-card w3-round w3-white">
								<div class="w3-container w3-padding">
									<h4 class="w3-opacity">DELETE AN EMPLOYEE</h4>
									<input type="text"name="Employee_ID" placeholder="Employee_ID" required="required" id="Employee_ID"><p></p>
									<input type="text"name="Name" placeholder="Name" required="required" id="Name"><p></p>
									<input type="text"name="Position" placeholder="Position" required="required" id="Position"><p></p>
									<button type="button" class="w3-button w3-theme" value="Delete"  onclick="act2()"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
								</div>
							</div>
						</div>
					</div>

					<script>
						function act1(){
							console.log(11111)
							document.frm.action="adm_2.php?act=add";
							document.frm.submit();   
						}
						function act2(){
							document.frm.action="adm_2.php?act=delete";
							document.frm.submit();   
						}
					</script>
				<!-- End Right Column -->
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