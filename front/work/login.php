<?php
  require './config.php';
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // 判断第一位是0还是2，如果都不是报错

    $first = $name[0];
    if (!in_array($first, [0,2])) {
    	echo "<script>javascript:alert('登录失败!');location.href='login.php';</script>";
    	exit;
    }

    if ($first == 0) {
	    $sql = "select * from administers where (ADMINISTER_ID='$name') and (PSSDWORD ='$password')";
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
    }elseif ($first == 1) {
	    $sql = "select * from employees where (EMPLOYEE_ID='$name') and (PSSDWORD ='$password')";
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
<html>
<head>
<title>Login</title>
<meta charset="UTF-8">
<link rel="stylesheet"  href="login.css" />
<style>
</style>
</head>
<body>
<div class="login" > 
<table style="width: 100%;height:100%;" >

     <form class="login-form" method="post" action="login.php"  enctype="multipart/form-data">
      <table  align="center" width=350 height=230; style="font-family:宋体;font-size:25px;">
      <tr align="center"> 
          <td colspan="1" style="font-size:35px;">登录</td>
      </tr>
      <tr class="login_box">
          <td align="center">User ID</td>
          <td>
          <input type="name" maxlength="20" name="name" placeholder="User ID" style="width:180px;font-size:20px;border-radius: 8px;" required="">
          </td>
      </tr>
      <tr class="login_box">
          <td align="center">Passward</td>
          <td >
          <input name="password" type="password" maxlength="16" placeholder="Passward" style="width:180px;font-size:20px;border-radius: 8px;" required="">
      </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        <input type="submit" name='submit' value='Login' style="font-size:17px;border-radius: 12px;" class="btn"/>
      </tr>
   </table>
   </form>
</table>
</div>
</body>
<html>