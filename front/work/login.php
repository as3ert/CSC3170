<?php
  require './config.php';
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // 判断第一位是0还是1，如果都不是报错
    $first = $name[0];
    if (!in_array($first, [0,1])) {
    	echo "<script>javascript:alert('登录失败!');location.href='login.php';</script>";
    	exit;
    }

    if ($first == 1) {
	    $sql = "select * from administrators where (ADMINISTRATOR_ID='$name') and (PASSWORD ='$password')";
	    $result = $mysqli->query($sql);
	    $row = $result->fetch_assoc();
	    if ($row) {
    	    setcookie('id',$name);
    		echo "<script>javascript:alert('登录成功!');location.href='UI1.php';</script>";
    		exit;
	    }else{
    		echo "<script>javascript:alert('登录失败!');location.href='login.php';</script>";
    		exit;
	    }
    }elseif ($first == 0) {
	    $sql = "select * from employees where (EMPLOYEE_ID='$name') and (PASSWORD ='$password')";
	    $result = $mysqli->query($sql);
	    $row = $result->fetch_assoc();
	    if ($row) {
    	    setcookie('is_admin',0);
    	    setcookie('id',$name);
    		echo "<script>javascript:alert('登录成功!');location.href='worker.php';</script>";
    		exit;
	    }else{
    		echo "<script>javascript:alert('登录失败!');location.href='login.php';</script>";
    		exit;
	    }
    }else {
    	echo "<script>javascript:alert('登录失败!');location.href='login.php';</script>";
    }
}
?>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8">
<link rel="stylesheet"  href="login.css" >
</head>

<body>
<div class="login" > 
     <form class="login-form" method="post" action="login.php"  enctype="multipart/form-data">
      <table  align="center" width=350 height=230; style="font-family:宋体;font-size:50px;">
      <div class="login_box">
          <input type="name" name="name" id="name" required="required">
          <label for="name" >User ID</label>
        </div>
      <div class="login_box">
        <input type="password" name='pwd' id='pwd' required="required">
        <label for="pwd">Passward</label>
      </div>
      <a>
      <input type="submit" name='submit' value='Login'  class="btn"/>    
      </a>
   </table>
   </form>
</div>
</body>
<html>