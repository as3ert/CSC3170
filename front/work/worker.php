<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <link rel="stylesheet"  href="worker.css" />
    <title>Staff_UI</title>
</head>

<?php 

    require './config.php';
     $id = $_COOKIE['id'];
     if (empty($id)) {
       // 未登录，跳转
        echo "<script>javascript:alert('未登录!');location.href='login.php';</script>";
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
        $sql = "SELECT * FROM jobs LEFT JOIN employees on jobs.EMPLOYEE_ID = employees.EMPLOYEE_ID WHERE jobs.PROJECT_ID = {$item['PROJECT_ID']}";
        $res= $mysqli->query($sql);
        $staffList = [];
        foreach($res as $k => $resItem){
          if ($resItem['EMPLOYEE_ID'] != $adminInfo['EMPLOYEE_ID']) {
            $staffList[] = [
              'id' => $resItem['EMPLOYEE_ID'],
              'name' => $resItem['EMPLOYEE_NAME'],
              'POSITION' => $resItem['POSITION'],
            ];
          }
        }
        $item['staff'] = $staffList;

        array_push($projectList,$item);

      }

      // echo json_encode($projectList);exit;

?>
<body>
    <!-- 主内容区 -->
    <div class="main">
        <h1>Basic Information</h1>
        <div>Staff_ID:<?php echo $adminInfo['EMPLOYEE_ID']; ?></div>
        <div>Name:<?php echo $adminInfo['EMPLOYEE_NAME']; ?></div>
        <div>age:<?php echo $adminInfo['AGE']; ?></div>
        <div>entey_date:<?php echo $adminInfo['ENTRY_DATE']; ?></div>
        <div>Location:<?php echo $adminInfo['POSITION']; ?></div>
        <div>Position:<?php echo $adminInfo['LOCATION']; ?></div>
        <h1>Involved Project</h1>



         <?php
            foreach($projectList as $k => $project){
                echo "<div style='margin-top:20px;'>Project_ID:{$project['PROJECT_ID']}</div>";
                echo "<div>Manager_ID:{$project['MANAGER_ID']}</div>";
                echo "<div class='others'>Other_participants: </div>";
                echo "<table>";
                echo "<thead>
                  <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Position</th>
                  </tr>
                </thead>";
                
                echo "<tbody>";
                foreach($project['staff'] as $staff){
                  echo "<tr>";
                  echo "<td>{$staff['name']}</td>";
                  echo "<td>{$staff['id']}</td>";
                  echo "<td>{$staff['POSITION']}</td>";
                  echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
               
            }
         ?>

<!--

其他参与者：
（表格）
（姓名）（ID）（职位） -->