<!DOCTYPE html>

<html>
<head>
<title>Employee_web</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
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
      $sql = "SELECT * FROM employees where EMPLOYEE_ID = {$id}";
      $result = $mysqli->query($sql);
      $adminInfo = $result->fetch_assoc();


      // 查询该员工参加的所有项目
      $sql =  "SELECT * FROM jobs LEFT JOIN projects on jobs.PROJECT_ID = projects.PROJECT_ID LEFT JOIN managers on projects.PROJECT_ID = managers.PROJECT_ID WHERE EMPLOYEE_ID = {$id}";
      $rs= $mysqli->query($sql);
      $projectList = [];
      foreach($rs as $k => $item){

        // 查询其他组员
        // $sql = "SELECT * FROM jobs LEFT JOIN employees on jobs.EMPLOYEE_ID = employees.EMPLOYEE_ID WHERE jobs.PROJECT_ID = {$item['PROJECT_ID']}";
        // $res= $mysqli->query($sql);
        // $staffList = [];
        // foreach($res as $k => $resItem){
        //   if ($resItem['EMPLOYEE_ID'] != $adminInfo['EMPLOYEE_ID']) {
        //     $staffList[] = [
        //       'id' => $resItem['EMPLOYEE_ID'],
        //       'name' => $resItem['EMPLOYEE_NAME'],
        //       'POSITION' => $resItem['POSITION'],
        //     ];
        //   }
        // }
        // $item['staff'] = $staffList;

        array_push($projectList,$item);

      }

      // echo json_encode($projectList);exit;

?>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="https://i04piccdn.sogoucdn.com/3f6e4e9d7ae44689" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2><?php echo $adminInfo['EMPLOYEE_NAME']; ?></h2>
          </div>
        </div>
        <div class="w3-container">
          <div style="display: none"><script>  GetArgsFromHref('http://127.0.0.1:5500/login.html', sArgName)        </script></div>
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $adminInfo['POSITION']; ?></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $adminInfo['POSITION']; ?></p>
          <p><i class="fa fa-calendar fa-fw w3-margin-right w3-large w3-text-teal"></i>Entry date</p>
          <hr>

          <!-- <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>

          <p>Media</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
          </div>
          <br> -->

          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Subcompany</b></p>
          <p>Company 1</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
          </div>
          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
          <?php
            foreach($projectList as $k => $project){
                echo "<div class='w3-container w3-card w3-white w3-margin-bottom'>";
                echo "<h2 class='w3-text-grey w3-padding-16'><i class='fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Project 1 (name):</h2>";
                echo "<div class='w3-container'>";
                echo "<h5 class='w3-opacity'><b></b></h5>";
                echo "<h6 class='w3-text-teal'><i class='fa fa-align-right fa-fw w3-margin-right'></i><span class='w3-tag w3-teal w3-round'>{$project['PROJECT_ID']}</span></h6>";
                echo "<hr>";
              echo "</div>";
              echo "<div class='w3-container'>";
                echo "<h5 class='w3-opacity'><b>Manager ID</b></h5>";
                echo "<h6 class='w3-text-teal'><i class='fa fa-star fa-fw w3-margin-right'></i>{$project['MANAGER_ID']}</h6>";
                echo "<hr>";
              echo "</div>";
              echo "<div class='w3-container'>";
                echo "<h5 class='w3-opacity'><b>Project duration</b></h5>";
                echo "<h6 class='w3-text-teal'><i class='fa fa-calendar w3-margin-right'>{$project['START_DATE']}---{$project['END_DATE']}</i></h6><br>";
              echo "</div>";
            echo "</div>";
            }
         ?>


    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Welcome to XXX company</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <!--下面放代码link-->
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">3170group X</a></p>
</footer>

</body>
</html>