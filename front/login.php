<?php
  require './config.php';

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

	// Check whether the first digit is 0 or 1, if not, report an error
    $first = $name[0];
    if (!in_array($first, [0,1])) {
    	echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    	exit;
    }

	// If the first digit is 1, query the administrator table, if the query result is not empty, set the cookie and jump to the administrator page, otherwise report an error
    if ($first == 1) {
	    $sql = "select * from administrators where (ADMINISTRATOR_ID='$name') and (PASSWORD ='$password')";
	    $result = $mysqli->query($sql);
	    $row = $result->fetch_assoc();
	    if ($row) {
    	    setcookie('id',$name);
    		echo "<script>javascript:location.href='administrator.php';</script>";
    		exit;
	    }else{
    		echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    		exit;
	    }
	// If the first digit is 0, query the employee table, if the query result is not empty, set the cookie and jump to the employee page, otherwise report an error
    } elseif ($first == 0) {
	    $sql = "select * from employees where (EMPLOYEE_ID='$name') and (PASSWORD ='$password')";
	    $result = $mysqli->query($sql);
	    $row = $result->fetch_assoc();
	    if ($row) {
    	    setcookie('is_admin',0);
    	    setcookie('id',$name);
    		echo "<script>javascript:location.href='worker.php';</script>";
    		exit;
	    } else {
    		echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    		exit;
	    }
	// If the first digit is not 0 or 1, report an error
    } else {
    	echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    }
}

?>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8"><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="login.css" >
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5, h6 {font-family: "Open Sans", sans-serif}
</style>
</head>

<body class="w3-theme-l5">

	<!-- Navbar -->
	<div class="w3-top">
    	<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
    	<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
    	<a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-globe w3-margin-right"></i>InnovaSoft Company</a>
    	<a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
      	</a>
  		</div>
  	</div>

	<!-- Page Container -->
	<div class="w3-container w3-content login" style="max-width:1400px;margin-top:0px">
		<form class="login-form" method="post" action="login.php" enctype="multipart/form-data">
		<table align="center" width=300 height=10>
				<br>
				<br>
				<!-- Login User ID -->
				<div class="login_box">
					<input type="name" name="name" id="name" required="required">
					<label for="name">User ID</td>
				</div>
				<!-- Login Password -->
				<div class="login_box">
					<input type="password" name='password' id='password' required="required">
					<label for="password">Password</td>
				</div>
				<!-- Login Bottom -->
				<div><a style="padding-left: 40%;" ></a>
					<button type="submit" name='submit' value='Login'  class="btn"><b> Login </b></button>
				</div>
			<br>
		</form>
	</div>
</body>
<html>