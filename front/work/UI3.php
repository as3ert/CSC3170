
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
        echo "<script>location.href='login.php';</script>";
        exit;
     }
    $sql = "SELECT * FROM administrators LEFT JOIN subcompanies ON administrators.SUBCOMPANY_ID = subcompanies.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
    $result = $mysqli->query($sql);
    $adminInfo = $result->fetch_assoc();

    $sql = "SELECT * FROM subcompanies LEFT JOIN administrators ON subcompanies.SUBCOMPANY_ID = administrators.SUBCOMPANY_ID WHERE administrators.ADMINISTRATOR_ID = {$id}";
    $result = $mysqli->query($sql);
    $comInfo = $result->fetch_assoc();

    // check the number of workers
    $sql = "SELECT count(*) as count from employees WHERE LOCATION = '{$comInfo['LOCATION']}'";
    // var_dump($sql);exit();
    $result = $mysqli->query($sql);
    $staff = $result->fetch_assoc();

    // check the number of projects
    $sql = "SELECT count(*) as count from projects WHERE ADMINISTRATOR_ID = {$adminInfo['ADMINISTRATOR_ID']}";
    $result = $mysqli->query($sql);
    $projects = $result->fetch_assoc();

    $staffSql =  "SELECT * FROM employees WHERE LOCATION = '{$comInfo['LOCATION']}'";
    $staffrs= $mysqli->query($staffSql);
    $staffList = [];
    foreach($staffrs as $k => $item){
        array_push($staffList,$item);
    }
    // echo json_encode($staffList);exit();
    if(isset($_POST["submit"])){
        // whether project_ID has already existed
        $sql = "select * from projects where (PROJECT_ID='{$_POST['Project_ID']}')";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if($row){
          echo "<script>javascript:alert('Project_ID has already been existed！');location.href='UI3.php';</script>";
          exit;
        }
        
        // mark the manager in 'employees'
        $sql = " UPDATE employees SET MANAGE_PROJECT_ID = '{$_POST['Project_ID']}' WHERE EMPLOYEE_ID = '{$_POST['Manager_ID']}'";
        $res = $mysqli->query($sql);

        // check employees' total salary
        $frontIds = [];
        $backIds = [];
        $testIds = [];

        foreach ($_POST as $key => $value) {
          if (strstr($key, '^')) {
            $arr = explode('^', $key);
            if ($arr[0] == 'Front End') {
              $frontIds[] = $arr[1];
            }elseif ($arr[0] == 'Back End') {
              $backIds[] = $arr[1];
            }else{
              $testIds[] = $arr[1];
            }
          }
        }

        $frontCount = count($frontIds);
        $backCount = count($backIds);
        $testCount = count($testIds);

        if (empty($frontIds) && empty($backIds) && empty($testIds)) {
          echo "<script>javascript:alert('Please at least chose one employee！');location.href='UI3.php';</script>";
          exit;
        }

        $total = 0;

        if (!empty($frontIds)) {
          foreach($frontIds as $id){
            $sql1 = "select * from employees where EMPLOYEE_ID='{$id}'";
            $result1 = $mysqli->query($sql1);
            $row1 = $result1->fetch_assoc();
            $total += $row1['SALARY'];
          }
        }

        if (!empty($backIds)) {
          foreach($backIds as $id){
            $sql1 = "select * from employees where EMPLOYEE_ID='{$id}'";
            $result1 = $mysqli->query($sql1);
            $row1 = $result1->fetch_assoc();
            $total += $row1['SALARY'];
          }
        }

        if (!empty($testIds)) {
          foreach($testIds as $id){
            $sql1 = "select * from employees where EMPLOYEE_ID='{$id}'";
            $result1 = $mysqli->query($sql1);
            $row1 = $result1->fetch_assoc();
            $total += $row1['SALARY'];
          }
        }
        
        // check the budget
        $sql = "select * from subcompanies where SUBCOMPANY_ID ='{$adminInfo['SUBCOMPANY_ID']}'";
        // var_dump($sql);exit();
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        // compare with budget
        if ($total > $row['BUDGET']) {
          echo "<script>javascript:alert('over budget！');location.href='UI3.php';</script>";
          exit;
        }
        else {
          // change the company's budget
          $budget_update = $row['BUDGET'] - $total;
          $sql = " UPDATE subcompanies SET BUDGET = '{$budget_update}' WHERE SUBCOMPANY_ID = '{$adminInfo['SUBCOMPANY_ID']}'";
          $res = $mysqli->query($sql);
        }
          // projects add a new record
          $sql = "insert into projects(PROJECT_ID,ADMINISTRATOR_ID,PROJECT_NAME,START_DATE,END_DATE,FRONT_END_NUMBER,BACK_END_NUMBER,TESTING_NUMBER) values ('{$_POST['Project_ID']}','{$adminInfo['ADMINISTRATOR_ID']}','{$_POST['Project_name']}','{$_POST['Start_date']}','{$_POST['End_date']}','{$_POST['front_end_number']}','{$_POST['back_end_number']}','{$_POST['testing_number']}')";
          $res = $mysqli->query($sql);

          // jobs add new records
          if (!empty($frontIds)) {
            foreach($frontIds as $id){
              $sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$id}','{$_POST['Project_ID']}')";
              $res = $mysqli->query($sql1);
            }
          }
          if (!empty($backIds)) {
            foreach($backIds as $id){
              $sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$id}','{$_POST['Project_ID']}')";
              $res = $mysqli->query($sql1);
            }
          } 
          if (!empty($testIds)) {
            foreach($testIds as $id){
              $sql1 = "insert into jobs(EMPLOYEE_ID,PROJECT_ID) values ('{$id}','{$_POST['Project_ID']}')";
              $res = $mysqli->query($sql1);
            }
          }
          // managers add a new record
          $sql = "insert into managers(MANAGER_ID,PROJECT_ID) values ('{$_POST['Manager_ID']}','{$_POST['Project_ID']}')";
          $res = $mysqli->query($sql);
            echo "<script>javascript:alert('Add success!');location.href='UI3.php';</script>";
            exit;
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

    <div class="main">
       <table style="width: 100%;height:100%;" >
         <form method="post" action="UI3.php"  enctype="multipart/form-data">
            <h2>Creat Project</h2>
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
                <input type="date" name='Start_date' id='Start_date' required />
              </td>
            </tr>
            <tr>
              <td>End_date:
                <input type="date" name='End_date' id='End_date' required />
              </td>
            </tr>
            <tr>
              <td>front_end_number:
                <input type="text" name='front_end_number' id='front_end_number' required />
              </td>
            </tr>
            <tr>
              <td>back_end_number:
                <input type="text" name='back_end_number' id='back_end_number' required />
              </td>
            </tr>
            <tr>
              <td>testing_number:
                <input type="text" name='testing_number' id='testing_number' required />
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
                Manager_ID:
                <select name='Manager_ID' id='Manager_ID' required/>
                  <?php
                        foreach($staffList as $staff){
                          if ($staff['MANAGE_PROJECT_ID'] == NULL) {
                            echo "<option value='{$staff['EMPLOYEE_ID']}'>{$staff['EMPLOYEE_NAME']}</option>";
                          }
                        }
                    ?>
                  </select>
              </td>
            </tr>
              <td>
                Front_end_staff:
                  <?php
                      foreach($staffList as $staff){
                        if ($staff['POSITION'] == 'Front End') {
                          echo "<input type='checkbox' name='Front End^{$staff['EMPLOYEE_ID']}' value='{$staff['EMPLOYEE_ID']}'>";
                          echo "<label>{$staff['EMPLOYEE_NAME']}</label>";
                        }
                      }
                    ?>
                  </select>
                </td>
            </tr>
            <tr>
              <td>
                Back_end_staff:
                  <?php
                      foreach($staffList as $staff){
                        if ($staff['POSITION'] == 'Back End') {
                          echo "<input type='checkbox' name='Back End^{$staff['EMPLOYEE_ID']}' value='{$staff['EMPLOYEE_ID']}'>";
                          echo "<label>{$staff['EMPLOYEE_NAME']}</label>";
                        }
                      }
                    ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Testing_staff:
                <?php
                      foreach($staffList as $staff){
                        if ($staff['POSITION'] == 'Testing') {
                          echo "<input type='checkbox' name='Testing^{$staff['EMPLOYEE_ID']}' value='{$staff['EMPLOYEE_ID']}'>";
                          echo "<label>{$staff['EMPLOYEE_NAME']}</label>";
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
