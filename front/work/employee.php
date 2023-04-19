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
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Project 1 (name):</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Project ID</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-align-right fa-fw w3-margin-right"></i><span class="w3-tag w3-teal w3-round">19823621</span></h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Manager ID</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-star fa-fw w3-margin-right"></i>128916</h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Project duration</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2023 - Jun 2024</h6><br>
        </div>
      </div>
<!--
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Project 1 (name):</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Project ID</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-align-right fa-fw w3-margin-right"></i><span class="w3-tag w3-teal w3-round">19823621</span></h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Manager ID</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-star fa-fw w3-margin-right"></i>128916</h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Project duration</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2023 - Jun 2024</h6><br>
        </div>
      </div>


      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Project 1 (name):</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Project ID</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-align-right fa-fw w3-margin-right"></i><span class="w3-tag w3-teal w3-round">19823621</span></h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Manager ID</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-star fa-fw w3-margin-right"></i>128916</h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Project duration</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2023 - Jun 2024</h6><br>
        </div>
      </div> -->
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
