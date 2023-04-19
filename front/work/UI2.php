
<!DOCTYPE html>
<html>
  <head>
    <title>Boss_UI</title>
    <meta charset="utf-8">
	<link rel="stylesheet"  href="UI.css" />
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
            echo "<script>location.href='UI2.php';</script>";
            exit;
          }

          // 判断第一位是否是1
          if($Worker_ID[0] != 0){
            echo "<script>location.href='UI2.php';</script>";
            exit;
          }

          // 判断员工Id是否存在
          $sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
          $result = $mysqli->query($sql);
          $row = $result->fetch_assoc();
          if($row){
            echo "<script>location.href='UI2.php';</script>";
            exit;
          }


          // employees表新增一条记录
          $sql = "insert into employees(EMPLOYEE_ID,EMPLOYEE_NAME,AGE,GENDER,POSITION,SALARY,PASSWORD,LOCATION, ENTRY_DATE) values ('{$Worker_ID}','{$name}','{$age}','{$gender}','{$Position}','{$Salary}','123456','{$adminInfo['LOCATION']}','{$date}')";
          $res = $mysqli->query($sql);

          // 
            echo "<scriptlocation.href='UI2.php';</script>";
            exit;
      }else{
        $Worker_ID = $_POST['Worker_ID1'];
          // 1、首先查询该id是否存在employees表
          $sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
          $result = $mysqli->query($sql);
          $row = $result->fetch_assoc();
          if(!$row){
            echo "<script>location.href='UI2.php';</script>";
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
          echo "<script>location.href='UI2.php';</script>";
            exit;
      }

    }

  ?>
  <body>
    <!-- 左边框 -->
    <div class="sidebar">
        <h2>menu</h2>
            <ul>
                <li><a href="UI1.php" href="#basic-info" id="info-link">Basic Information</a></li>
                <li><a href="UI2.php" href="#employee-appointments" id="employee-link">Staff Arrangement</a></li>
                <li><a href="UI3.php" href="#project-establishment" id="prj-link">Creat Project</a></li>
            </ul>
            <h3>company information</h3>
            <p>Company ID:<?php echo $adminInfo['SUBCOMPANY_ID']; ?></p>
            <p>location:<?php echo $adminInfo['LOCATION']; ?></p>
            <p>capital:<?php echo $adminInfo['BUDGET']; ?></p>
            <p>number of employees:<?php echo $staff['count']; ?></p>
            <p>number of projects:<?php echo $projects['count']; ?></p>
    </div>

    <!-- 主内容区 -->
    <div class="main">
     <form name="frm" method="post" action="UI2.php"  enctype="multipart/form-data">
      <table>
      <tr> 
        <td>
          <h2>Staff Arrangement</h2>
          <h3>Add Staff:</h3>
          </td>
      </tr>
      <tr>
        <td>
          <label for="Worker_ID" >Staff_ID:</label>
          <input type="text" name='Worker_ID' id='Worker_ID'>
          </td>
      </tr>
      <tr>
        <td>
          <label for="name" >Name:</label>
          <input type="text" name='name' id='name'>
          </td>
      </tr>
      <tr>
        <td>
          <label for="age" >Age:</label>
          <input type="text" name='age' id='age'>
          </td>
      </tr>
      <tr>
        <td>
          <label for="gender" >Gender:</label>
          <input type="text" name='gender' id='gender'>
          </td>
      </tr>
      <tr>
        <td>
            <label for="Position:" > Position : </label>
            <input type="text" name='Position' id='Position'>
          </td>
      </tr>
      <tr>
        <td>
            <label for="Salary" >Salary:</label>
            <input type="text" name='Salary' id='Salary'>
          </td>
      </tr>
      <tr>
        <td>
          <label for="date" >Entry_date:</label>
          <input type="date" name='date' id='date' required />
          </td>
      </tr>
        <tr> 
          <td>
          <h3>Delete:</h3>
          </td>
      </tr>
        <tr>
        <td>
          <label for="Worker_ID" >Staff_ID:</label>
          <input type="text" name='Worker_ID1' id='Worker_ID'>
          </td>
      </tr>
      <tr>
          <td>
            <input type="button" name="" value="Add Staff"  onclick="act1()"  />
            <input type="button" name="" value="Delete"  onclick="act2()"  />
          </td>
      </tr>
   </table>
   </form>


      <section id="project-establishment" style="display: none;">
      </section>
    </div>

    <script>
      function act1(){
        console.log(11111)
         document.frm.action="UI2.php?act=add";
         document.frm.submit();   
      }
      function act2(){
         document.frm.action="UI2.php?act=delete";
         document.frm.submit();   
      }
    </script>


  </body>
</html>
