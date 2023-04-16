
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
      $sql = "SELECT * FROM administers LEFT JOIN subcompanies ON administers.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administers.ADMINISTER_ID = {$id}";
      $result = $mysqli->query($sql);
      $adminInfo = $result->fetch_assoc();
    $act = !empty($_GET['act']) ? trim($_GET['act']) : '';

    if ($act == 'addStaff') {
      $Worker_ID = $_POST['Worker_ID'];
      $name = $_POST['name'];
      $Position = $_POST['Position'];
      $Salary = $_POST['Salary'];

      var_dump($Worker_ID);
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
      <h1>csc3170</h1>
      <section id="basic-info">
        <h2>个人信息</h2>
        <div>
          <label for="name" >Name: <?php echo $adminInfo['ADMINISTER_NAME']; ?></label>
        </div>
        <div>
          <label for="ID" >ID: <?php echo $adminInfo['ADMINISTER_ID']; ?></label>
        </div>
        <h2>Project Information</h2>
        <h3>Project 1:</h3>
        <p>Project ID:</p>
        <p>Name:</p>
        <p>Start-date:</p>
        <p>End-date:</p>
        <p>Budget:</p>
        <p>Manager ID:</p>
        <h3>Project 2:</h3>
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
        <p>Manager ID:</p>
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
