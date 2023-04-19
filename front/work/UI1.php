
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
        // echo "<script>location.href='login.php';</script>";
        exit;
     }
      $sql = "SELECT * FROM administrators LEFT JOIN subcompanies ON administrators.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
      $result = $mysqli->query($sql);
      $administrator_Info = $result->fetch_assoc();

      $sql = "SELECT * FROM subcompanies LEFT JOIN administrators ON subcompanies.SUBCOMPANY_ID = administrators.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
      $result = $mysqli->query($sql);
      $company_Info = $result->fetch_assoc();

      // check the number of employees
      $sql = "SELECT count(*) as count from employees WHERE LOCATION = '{$company_Info['LOCATION']}'";
      // var_dump($sql);exit();
      $result = $mysqli->query($sql);
      $staff = $result->fetch_assoc();

      // check the number of projects
      $sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$administrator_Info['ADMINISTRATOR_ID']}";
      $result = $mysqli->query($sql);
      $projects = $result->fetch_assoc();

      // check all the projects created by the certain boss
      $sql =  "SELECT projects.*,managers.MANAGER_ID,employees.* FROM (projects left join managers ON projects.PROJECT_ID = managers.PROJECT_ID) left join employees ON managers.MANAGER_ID = employees.EMPLOYEE_ID  WHERE ADMINISTRATOR_ID = {$administrator_Info['ADMINISTRATOR_ID']}";
      $projectrs= $mysqli->query($sql);
      $projectList = [];
      foreach($projectrs as $k => $item){
          array_push($projectList,$item);
      }


  ?>
  <body>
    <!-- 左边框 -->
    <div class="sidebar">
        <h2>menu</h2>
            <ul>
                <li><a href="UI1.php" href="#basic-info" id="info-link">Baisc Information</a></li>
                <li><a href="UI2.php" href="#employee-appointments" id="employee-link">Staff Arrangement</a></li>
                <li><a href="UI3.php" href="#project-establishment" id="prj-link">Creat Project</a></li>
            </ul>
            <h3>company information</h3>
            <p>Company ID:<?php echo $administrator_Info['SUBCOMPANY_ID']; ?></p>
            <p>location:<?php echo $administrator_Info['LOCATION']; ?></p>
            <p>capital:<?php echo $administrator_Info['BUDGET']; ?></p>
            <p>number of employees:<?php echo $staff['count']; ?></p>
            <p>number of projects:<?php echo $projects['count']; ?></p>
    </div>

    <!-- 主内容区 -->
    <div class="main">
      <h1>csc3170</h1>
      <section id="basic-info">
        <h2>Personal Information</h2>
        <div>
          <label for="name" >Name: <?php echo $administrator_Info['ADMINISTRATOR_NAME']; ?></label>
        </div>
        <div>
          <label for="ID" >ID: <?php echo $administrator_Info['ADMINISTRATOR_ID']; ?></label>
        </div>
        <h2>Project Information</h2>

         <?php
            foreach($projectList as $k => $project){
              $num = ++ $k;
              echo "<h3>Project {$num}</h3>";
              echo "<h3>Project ID:{$project['PROJECT_ID']}</h3>";
              echo "<h3>Start-date:{$project['START_DATE']}</h3>";
              echo "<h3>End-date:{$project['END_DATE']}</h3>";
              echo "<h3>Budget:{$project['BUDGET']}</h3>";
              echo "<h3>Manager name:{$project['EMPLOYEE_NAME']}</h3>";
              echo "<h3>Manager ID:{$project['EMPLOYEE_ID']}</h3>";
            }
         ?>
      </section>
    

      <section id="project-establishment" style="display: none;">
      </section>
    </div>

  </body>
</html>