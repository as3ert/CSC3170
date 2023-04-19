<!DOCTYPE html>
<html>
<head>
<title>Administrator_web2</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
</head>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="administrator.html" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Home</a>
  <a href="adm_1.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
  <a href="adm_2.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
  </a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="https://www.w3schools.com/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i> ID</p>
         <p><i class="fa fa-address-book fa-fw w3-margin-right w3-text-theme"></i> Name</p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="Function1('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Projects</button>
          <div id="Demo1" class="w3-hide w3-container">
            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom w3-sepia-min" onclick="Function2('prj1')">prj1</button>
            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom w3-sepia-min" onclick="Function2('prj2')">prj2</button>
            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom w3-sepia-min" onclick="Function2('prj3')">prj3</button>
          </div>

          <!-- <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button> -->
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>      
      </div>
      <br>
      
      <!-- Company --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Company Informations</p>
          <p class="w3-small">Company ID:</p>
          <p class="w3-small">location:</p>
          <p class="w3-small">capital:</p>
          <p class="w3-small">number of employees:</p>
          <p class="w3-small">number of projects:</p>
        </div>
      </div>
      <br>
      
      <!-- Alert Box
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div> -->
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->

    <div class=" main w3-col m7">
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h4 class="w3-opacity">ADD AN NEW EMPLOYEE</h4>
              <input type="text"name="Employee_ID" placeholder="Employee_ID" required="required" id="Employee_ID">
              <input type="text"name="Name" placeholder="Name" required="required" id="Name">
              <p></p>
              <input type="text"name="Position" placeholder="Position" required="required" id="Position">
              <input type="text"name="Salary" placeholder="Salary" required="required" id="Salary">
              <p></p>
              <!-- <input type="text"name="Front_end_staff" placeholder="Front_end_staff" required="required" id="Front_end_staff">
             -->
              <!-- <p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p> -->
              <button type="button" class="w3-button w3-theme"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
            </div>
          </div>
        </div>
      </div>

      <div class="w3-row-padding  w3-margin-bottom" >
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h4 class="w3-opacity">DELETE AN EMPLOYEE</h4>
              <input type="text"name="Employee_ID" placeholder="Employee_ID" required="required" id="Employee_ID"><p></p>
              <input type="text"name="Name" placeholder="Name" required="required" id="Name"><p></p>
              <input type="text"name="Position" placeholder="Position" required="required" id="Position"><p></p>
              <!-- <p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p> -->
              <button type="button" class="w3-button w3-theme"><i class="fa fa-chevron-left"></i> CONFIRM <i class="fa fa-chevron-right"></i></button> 
            </div>
          </div>
        </div>
      </div>
 
      
    <!-- End Middle Column -->
    </div>
    

    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
<script>
// Accordion
function Function1(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

function Function2(id){
  var idSection = document.getElementById(id);
  var mainSections = document.querySelectorAll(".main section");
  for (var i = 0; i < mainSections.length; i++) {
  mainSections[i].style.display = "none";
  }
  idSection.style.display = "block";
  }

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
