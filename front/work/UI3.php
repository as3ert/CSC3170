
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

    // 查询员工数量

    $sql = "SELECT count(*) as count from subcompanies WHERE SUBCOMPANY_ID = {$adminInfo['SUBCOMPANY_ID']}";

    // var_dump($sql);exit();
    $result = $mysqli->query($sql);
    $staff = $result->fetch_assoc();


    // 查询项目数量
    $sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$adminInfo['ADMINISTRATOR_ID']}";
    $result = $mysqli->query($sql);
    $projects = $result->fetch_assoc();

    $staffSql =  "SELECT * FROM subcompanies WHERE SUBCOMPANY_ID = {$adminInfo['SUBCOMPANY_ID']}";
    $staffrs= $mysqli->query($staffSql);
    $staffList = [];
    foreach($staffrs as $k => $item){
        array_push($staffList,$item);

    }
    // echo json_encode($staffList);exit();
    if(isset($_POST["submit"])){
        // 查询Project_ID是否存在
        $sql = "select * from projects where (PROJECT_ID='{$_POST['Project_ID']}')";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if($row){
          echo "<script>javascript:alert('Project_ID已经存在！');location.href='UI3.php';</script>";
          exit;
        }

        // 判断Manager_ID是否存在
        $sql = "select * from employees where EMPLOYEE_ID='{$_POST['Manager_ID']}'";

        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if(!$row){
          echo "<script>javascript:alert('Manager_ID不存在！');location.href='UI3.php';</script>";
          exit;
        }
        $ids = [$_POST['Front End'],$_POST['Back End'],$_POST['Testing']];
        // 查询员工的总工资
        $total = 0;
        $sql1 = "select * from employees where EMPLOYEE_ID='{$_POST['Front End']}'";
        $result1 = $mysqli->query($sql1);
        $row1 = $result1->fetch_assoc();

        $sql2 = "select * from employees where EMPLOYEE_ID='{$_POST['Back End']}'";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_assoc();

        $sql3 = "select * from employees where EMPLOYEE_ID='{$_POST['Testing']}'";
        $result3 = $mysqli->query($sql3);
        $row3 = $result3->fetch_assoc();
        $total = $row1['SALARY'] + $row2['SALARY'] + $row3['SALARY'];
        
        // 查询预算
        $sql = "select * from subcompanies where SUBCOMPANY_ID ='{$adminInfo['SUBCOMPANY_ID']}'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        // 和预算做比较
        if ($total > $row['BUDGET']) {
          echo "<script>javascript:alert('预算超标！');location.href='UI3.php';</script>";
          exit;
        }
          // projects表新增一条记录
          $sql = "insert into projects(PROJECT_ID,ADMINISTRATOR_ID,PROJECT_NAME,START_DATE,END_DATE,FRONT_END_NUMBER,BACK_END_NUMBER,TESTING_NUMBER) values ('{$_POST['Project_ID']}','{$adminInfo['ADMINISTRATOR_ID']}','{$_POST['Project_name']}','{$_POST['Start_date']}','{$_POST['End_date']}','{$row1['SALARY']}','{$row2['SALARY']}','{$row3['SALARY']}')";
          $res = $mysqli->query($sql);

          // jobs表新增三条记录
          $sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$_POST['Front End']}','{$_POST['Project_ID']}')";
          $res = $mysqli->query($sql1);

          $sql2 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$_POST['Back End']}','{$_POST['Project_ID']}')";
          $res = $mysqli->query($sql2);

          $sql3 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$_POST['Testing']}','{$_POST['Project_ID']}')";
          $res = $mysqli->query($sql3);
          // managers表新增一条记录

          $sql = "insert into managers(MANAGER_ID,PROJECT_ID) values ('{$_POST['Manager_ID']}','{$_POST['Project_ID']}')";
          $res = $mysqli->query($sql);
            echo "<script>javascript:alert('添加成功!');location.href='UI3.php';</script>";
            exit;
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
            <p>number of employees:<?php echo $staff['count']; ?></p>
            <p>number of projects:<?php echo $projects['count']; ?></p>
    </div>

    <!-- 主内容区 -->
    <div class="main">
       <table style="width: 100%;height:100%;" >
         <form method="post" action="UI3.php"  enctype="multipart/form-data">
            <h2>项目设立</h2>
            <h3>Add Project:</h3>
            <tr>
              <td>Project_ID:
                <input type="text" name='Project_ID' id='Project_ID' required />
              </td>
            </tr>
            <tr>
              <td>Project_name:
                <input type="text" name='Project_name' id='Project_name' required />
              </td>
            </tr>
            <tr>
              <td>Start_date:
                <input type="date" name='Start_date' id='Start_date' required / >
              </td>
            </tr>
            <tr>
              <td>End_date:
                <input type="date" name='End_date' id='End_date' required />
              </td>
            </tr>
            <tr>
              <td>Manager_ID:
                <input type="text" name='Manager_ID' id='Manager_ID' required />
              </td>
            </tr>
            <tr>
<!--               <td>Front End_end_staff:
                <select id="Front End_end_worker" name="Front End worker" required />
                  <option value="None"> </option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </td> -->

              <td>
                Front_end_staff:
                <select id="Front End" name="Front End" required />
                   <?php
                      foreach($staffList as $staff){
                        if ($staff['POSITION'] == 'Front End' && $staff['MANAGE_PROJECT_ID'] == NULL) {
                          echo "<option value='{$staff['EMPLOYEE_ID']}'>{$staff['EMPLOYEE_NAME']}</option>";
                        }
                      }
                   ?>
                  </select>
                </td>
            </tr>
            <tr>
              <td>Back_end_staff:
                <select id="Back End" name="Back End" required />
                   <?php
                      foreach($staffList as $staff){
                        if ($staff['POSITION'] == 'Back End' && $staff['MANAGE_PROJECT_ID'] == NULL) {
                          echo "<option value='{$staff['EMPLOYEE_ID']}'>{$staff['EMPLOYEE_NAME']}</option>";
                        }
                      }
                   ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Testing_staff:
                <select id="Testing" name="Testing" required />
                   <?php
                      foreach($staffList as $staff){
                        if ($staff['POSITION'] == 'Testing' && $staff['MANAGE_PROJECT_ID'] == NULL) {
                          echo "<option value='{$staff['EMPLOYEE_ID']}'>{$staff['EMPLOYEE_NAME']}</option>";
                        }
                      }
                   ?>
                </select>
              </td>
            </tr>

            <tr>
              <td colspan="2">
                  <input type="submit" name="submit" value="Add" />
            </tr>
          </form>
       </table>
    </div>

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
