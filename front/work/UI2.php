
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
        echo "<script>javascript:alert('未登录!');location.href='login.php';</script>";
        exit;
     }
      $sql = "SELECT * FROM administrators LEFT JOIN subcompanies ON administrators.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
      $result = $mysqli->query($sql);
      $adminInfo = $result->fetch_assoc();
    $act = !empty($_GET['act']) ? trim($_GET['act']) : '';

    if ($_SERVER['REQUEST_METHOD']==='POST') {

      if ($_GET['act'] == 'add') {
          $Worker_ID = $_POST['Worker_ID'];
          $name = $_POST['name'];
          $Position = $_POST['Position'];
          $Salary = $_POST['Salary'];

          if (empty($Worker_ID) || empty($name) || empty($Position) || empty($Salary) ) {
            echo "<script>javascript:alert('请填写完整员工信息!');location.href='UI2.php';</script>";
            exit;
          }

          // 判断第一位是否是0
          if($Worker_ID[0] != 0){
            echo "<script>javascript:alert('员工ID填写有误!');location.href='UI2.php';</script>";
            exit;
          }

          // 判断员工Id是否存在
          $sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
          $result = $mysqli->query($sql);
          $row = $result->fetch_assoc();
          if($row){
            echo "<script>javascript:alert('员工ID已经存在！');location.href='UI2.php';</script>";
            exit;
          }


          // employees表新增一条记录
          $sql = "insert into employees(EMPLOYEE_ID,EMPLOYEE_NAME,SALARY,POSITION,PASSWORD) values ('{$Worker_ID}','{$name}','{$Position}','{$Salary}','123456')";
          $res = $mysqli->query($sql);

          // 
            echo "<script>javascript:alert('添加成功!');location.href='UI2.php';</script>";
            exit;
      }else{
        $Worker_ID = $_POST['Worker_ID1'];
          // 1、首先查询该id是否存在employees表
          $sql = "select * from employees where (EMPLOYEE_ID='$Worker_ID')";
          $result = $mysqli->query($sql);
          $row = $result->fetch_assoc();
          if(!$row){
            echo "<script>javascript:alert('员工ID不存在!');location.href='UI2.php';</script>";
            exit;
          }
          // 2、删除employees表数据
          $sql = "delete FROM employees where (EMPLOYEE_ID='{$Worker_ID}')";
          $result = $mysqli->query($sql);

          // 3、删除jobs表数据
          $sql = "delete FROM jobs where (EMPLOYEE_ID='{$Worker_ID}')";
          $result = $mysqli->query($sql);

          // 4、删除jobs表数据
          $sql = "delete FROM managers where (MANAGER_ID='{$Worker_ID}')";
          $result = $mysqli->query($sql);
          echo "<script>javascript:alert('删除成功!');location.href='UI2.php';</script>";
            exit;
      }

    }

  ?>
  <body>
    <!-- 左边框 -->
    <div class="sidebar">
        <h2>菜单</h2>
            <ul>
                <li><a href="UI1.php" href="#basic-info" id="info-link">基本信息</a></li>
                <li><a href="UI2.php" href="#employee-appointments" id="employee-link">员工任用</a></li>
                <li><a href="UI3.php" href="#project-establishment" id="prj-link">项目设立</a></li>
            </ul>
            <h3>公司信息</h3>
            <p>Company ID:<?php echo $adminInfo['SUBCOMPANY_ID']; ?></p>
            <p>location:<?php echo $adminInfo['LOCATION']; ?></p>
            <p>capital:<?php echo $adminInfo['BUDGET']; ?></p>
            <p>number of employees:</p>
            <p>number of projects:</p>
    </div>

    <!-- 主内容区 -->
    <div class="main">
     <form name="frm" method="post" action="UI2.php"  enctype="multipart/form-data">
      <table>
      <tr> 
        <td>
          <h2>员工任用</h2>
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
<!--             <button  type="submit">Add Staff</button>
             <button type="submit">Delete</button> -->

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

<!--       <script>
        let infoLink = document.getElementById("info-link");
        let employeeLink = document.getElementById("employee-link");
        let prjLink = document.getElementById("prj-link");
        var sidebarLinks = document.querySelectorAll(".sidebar li");
        sidebarLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
        event.preventDefault();

    // 移除之前的阴影效果
        sidebarLinks.forEach(function(l) {
        l.classList.remove("active");
        });

    // 添加阴影效果
        this.classList.add("active");
        });
        });



        employeeLink.addEventListener("click", function(event) {
        event.preventDefault();
        let employeeSection = document.getElementById("employee-appointment");
        let mainSections = document.querySelectorAll(".main section");
        for (let i = 0; i < mainSections.length; i++) {
        mainSections[i].style.display = "none";
        }
        employeeSection.style.display = "block";
        })

        infoLink.addEventListener("click", function(event) {
        event.preventDefault();
        let infoSection = document.getElementById("basic-info");
        let mainSections = document.querySelectorAll(".main section");
        for (let i = 0; i < mainSections.length; i++) {
        mainSections[i].style.display = "none";
        }
        infoSection.style.display = "block";
        })

        prjLink.addEventListener("click", function(event) {
        event.preventDefault();
        let prjSection = document.getElementById("project-establishment");
        let mainSections = document.querySelectorAll(".main section");
        for (let i = 0; i < mainSections.length; i++) {
        mainSections[i].style.display = "none";
        }
        prjSection.style.display = "block";
        });
    </script> -->

  </body>
</html>
