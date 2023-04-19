<?php
  require './config.php';

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // 判断第一位是0还是1，如果都不是报错
    $first = $name[0];
    if (!in_array($first, [0,1])) {
    	echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    	exit;
    }

    if ($first == 1) {
	    $sql = "select * from administrators where (ADMINISTRATOR_ID='$name') and (PASSWORD ='$password')";
	    $result = $mysqli->query($sql);
	    $row = $result->fetch_assoc();
	    if ($row) {
    	    setcookie('id',$name);
    		echo "<script>javascript:alert('Login successfully!!');location.href='UI1.php';</script>";
    		exit;
	    }else{
    		echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    		exit;
	    }
    } elseif ($first == 0) {
	    $sql = "select * from employees where (EMPLOYEE_ID='$name') and (PASSWORD ='$password')";
	    $result = $mysqli->query($sql);
	    $row = $result->fetch_assoc();
	    if ($row) {
    	    setcookie('is_admin',0);
    	    setcookie('id',$name);
    		echo "<script>javascript:alert('Login successfully!!');location.href='worker.php';</script>";
    		exit;
	    } else {
    		echo "<script>javascript:alert('Login failure!!');location.href='login.php';</script>";
    		exit;
	    }
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
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
</head>

<body class="w3-theme-l5">
	<div class="w3-container w3-content login" style="max-width:1400px;margin-top:0px">
		<form class="login-form" method="post" action="login.php" enctype="multipart/form-data">
		<table align="center" width=300 height=10>
				<br>
				<br>
				<div class="login_box">
					<input type="name" name="name" id="name" required="required">
					<label for="name" >User ID</td>
				</div>
				<div class="login_box">
					<input type="password" name='password' id='password' required="required">
					<label for="password">Password</td>
				</div>
				<div><a style="padding-left: 40%;" ></a>
					<button type="submit" name='submit' value='Login'  class="btn"><b> Login </b></button>
				</div>
			<br>
		</form>
	</div>
</body>
<html>
