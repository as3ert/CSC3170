
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

      $sql = "SELECT * FROM subcompanies LEFT JOIN administrators ON subcompanies.SUBCOMPANY_ID = administrators.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
      $result = $mysqli->query($sql);
      $comInfo = $result->fetch_assoc();

      // 查询员工数量
      $sql = "SELECT count(*) as count from employees WHERE LOCATION = '{$comInfo['LOCATION']}'";
      // var_dump($sql);exit();
      $result = $mysqli->query($sql);
      $staff = $result->fetch_assoc();

      // 查询项目数量
      $sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$adminInfo['ADMINISTRATOR_ID']}";
      $result = $mysqli->query($sql);
      $projects = $result->fetch_assoc();
      // 查询该老板下所有项目数据

      $sql =  "SELECT projects.*,managers.MANAGER_ID FROM projects left join managers on projects.PROJECT_ID = managers.PROJECT_ID WHERE ADMINISTRATOR_ID = {$adminInfo['ADMINISTRATOR_ID']}";
      $projectrs= $mysqli->query($sql);
      $projectList = [];
      foreach($projectrs as $k => $item){
          array_push($projectList,$item);
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
      <h1>csc3170</h1>
      <section id="basic-info">
        <h2>个人信息</h2>
        <div>
          <label for="name" >Name: <?php echo $adminInfo['ADMINISTRATOR_NAME']; ?></label>
        </div>
        <div>
          <label for="ID" >ID: <?php echo $adminInfo['ADMINISTRATOR_ID']; ?></label>
        </div>
        <h2>Project Information</h2>

         <?php
            foreach($projectList as $k => $project){
              $budget = $project['FRONT_END_NUMBER'] + $project['BACK_END_NUMBER'] + $project['TESTING_NUMBER'];
              $num = ++ $k;
              echo "<h3>Project {$num}</h3>";
              echo "<h3>Project ID:{$project['PROJECT_ID']}</h3>";
              echo "<h3>Start-date:{$project['START_DATE']}</h3>";
              echo "<h3>End-date:{$project['END_DATE']}</h3>";
              echo "<h3>Budget:{$budget}</h3>";
              echo "<h3>Manager ID:{$project['MANAGER_ID']}</h3>";
            }
         ?>


<!--         <h3>Project 1:</h3>
        <p>Project ID:</p>
        <p>Name:</p>
        <p>Start-date:</p>
        <p>End-date:</p>
        <p>Budget:</p>
        <p>Manager ID:</p> -->



<!--         <h3>Project 2:</h3>
        <p>Project ID:</p>
        <p>Name:</p>
        <p>Start-date:</p>
        <p>End-date:</p>
        <p>Budget:</p>
        <p>Manager ID:</p>
        <h3>Project 3:</h3>
        <p>Project ID:</p>
        <p>Name:</p>
        <p>Start-date:</p>
        <p>End-date:</p>
        <p>Budget:</p>
        <p>Manager ID:</p> -->
      </section>
    

      <section id="project-establishment" style="display: none;">
      </section>
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
