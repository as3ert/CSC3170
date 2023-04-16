
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
      <section id="project-establishment">
        <h2>项目设立</h2>
        <h3>Add Project:</h3>
        <div>
          <label for="Project_ID" >Project_ID:</label>
          <input type="text" name='Project_ID' id='Project_ID' >
        </div>
        <div>
          <label for="Project_name" >Project_name:</label>
          <input type="text" name='Project_name' id='Project_name' >
        </div>
        <div>
          <label for="Start_date" >Start_date:</label>
          <input type="text" name='Start_date' id='Start_date' >
        </div>
        <div>
          <label for="End_date" >End_date:</label>
          <input type="text" name='End_date' id='End_date'>
        </div>
        <div>
          <label for="Manager_ID" >Manager_ID:</label>
          <input type="text" name='Manager_ID' id='Manager_ID'>
        </div>
        <div>
          <label for="Front_end_worker">Front_end_staff:</label>
          <select id="Front_end_worker" name="Front_end_worker">
            <option value="None"> </option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div>
          <label for="Back_end_worker">Back_end_staff:</label>
          <select id="Back_end_worker" name="Back_end_worker">
            <option value="None"> </option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div>
          <label for="Testing_worker">Testing_staff:</label>
          <select id="Testing_worker" name="Testing_worker">
            <option value="None"> </option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
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
