<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Empolyees</title>
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

    if ($_SERVER['REQUEST_METHOD']=='POST') {
      // var_dump($_GET['act']); exit();
      if ($_GET['act'] == 'add') {

          $Worker_ID = $_POST['Employee_ID'];
          $name = $_POST['Name'];
          $age = $_POST['Age'];
          $gender = $_POST['Gender'];
          $Position = $_POST['Position'];
          $Salary = $_POST['Salary'];
          $date = $_POST['Entry_date'];
          $password = $_POST['password'];
          // var_dump($_POST); exit();

          // <input type="text"name="Employee_ID" placeholder="Employee_ID" required="required" id="Employee_ID">
          // <input type="text"name="Name" placeholder="Name" required="required" id="Name">
          // <input type="text"name="Age" placeholder="Age" required="required" id="Age">
          // <input type="text"name="Gender" placeholder="Gender" required="required" id="Gender">
          // <p></p>
          // <input type="text"name="Position" placeholder="Position" required="required" id="Position">
          // <input type="text"name="Salary" placeholder="Salary" required="required" id="Salary">
          // <input type="date"name="Entry_date" placeholder="Entry_date" required="required" id="Entry_date">
          // <p></p>


          if (empty($Worker_ID) || empty($name) || empty($Position) || empty($Salary) || empty($age) || empty($gender) || empty($date)) {
            echo "<script>location.href='adm_2.php';</script>";
            exit;
          }

          // 判断第一位是否是0
          if($Worker_ID[0] != 0){
            echo "<script>location.href='adm_2.php';</script>";
            exit;
          }

          // 判断员工Id是否存在
          $sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
          $result = $mysqli->query($sql);
          $row = $result->fetch_assoc();
          if($row){
            echo "<script>location.href='adm_2.php';</script>";
            exit;
          }


          // employees表新增一条记录
          $sql = "insert into employees(EMPLOYEE_ID,EMPLOYEE_NAME,AGE,GENDER,POSITION,SALARY,LOCATION, ENTRY_DATE, PASSWORD) values ('{$Worker_ID}','{$name}','{$age}','{$gender}','{$Position}','{$Salary}','{$adminInfo['LOCATION']}','{$date}', '{$password}')";
          $res = $mysqli->query($sql);
            echo "<script>location.href='administrator.php';</script>";
            exit;
      }
      else{
        $Worker_ID = $_POST['Employee_ID'];
          // 1、首先查询该id是否存在employees表
          $sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
          $result = $mysqli->query($sql);
          $row = $result->fetch_assoc();
          if(!$row){
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
          echo "<script>location.href='administrator.php';</script>";
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
    
    <!-- Middle Column -->
    <div class=" main w3-col m10">
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <form name="form" method="post" action="adm_2.php"  enctype="multipart/form-data">
              <h4 class="w3-opacity">Add a new employee</h4>
                <input type="text"name="Employee_ID" placeholder="Employee ID" required="required" id="Employee_ID">
                <input type="text"name="Name" placeholder="Name" required="required" id="Name">
                <input type="text"name="Age" placeholder="Age" required="required" id="Age">
                Gender: 
                <select name="Gender" id="Gender" required>
                  <option value="Others"> Others </option>
                  <option value="Male"> Male </option>
                  <option value="Female"> Female </option>
                </select>
                <!-- <input type="text"name="Gender" placeholder="Gender" required="required" id="Gender"> -->
                <p></p>
                <input type="text"name="Salary" placeholder="Salary" required="required" id="Salary">
                <input type="text"name="password" placeholder="Password" required="required" id="password">
                Position:
                <select name="Position" id="Position" required>
                  <option value="Front End"> Front End </option>
                  <option value="Back End"> Back End </option>
                  <option value="Testing"> Testing </option>
                </select>
                <p></p>
                Entry Date:
                <input type="date"name="Entry_date" placeholder="Entry_date" required="required" id="Entry_date">
                <p></p>
                <button type="submit" name="submit" class="w3-button w3-theme" value="Add Staff" onclick="act1()"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
              </form>

              <!-- <input type="button" name="" value="Add Staff"  onclick="act1()"  /> -->
            </div>
          </div>
        </div>
      </div>
      
      <div class="w3-row-padding  w3-margin-bottom" >
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <form name="frm" method="post" action="adm_2.php"  enctype="multipart/form-data">
              <h4 class="w3-opacity">Delete an employee</h4>
              <input type="text"name="Employee_ID" placeholder="Employee ID" id="Employee_ID"><p></p>
              <button type="submint" name="submint" class="w3-button w3-theme" value="Delete" onclick="act2()"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
              <!-- <input type="button" name="" value="Add Staff"  onclick="act2()"  /> -->
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

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://github.com/as3ert/csc3170" target="_blank">Gruop 8</a></p>
</footer>
 
<script>
// Accordion

function act1(){
         document.form.action="adm_2.php?act=add";
         document.form.submit();
      }

function act2(){
         document.frm.action="adm_2.php?act=delete";
         document.frm.submit();   
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