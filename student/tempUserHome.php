<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;

  $_SESSION['appList'] = NULL;

  //check validity of the user
  $currentUserName = $_SESSION['currentUserName'];
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
  }

  // Connect to database
  $conn = new mysqli("localhost","scholar", "","sms");

  // Checks Connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

  $getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";

  $nameResult = mysqli_query($conn,$getName);

  // Get every row of the table formed from the query
    while($rows9=mysqli_fetch_row($nameResult)){
      foreach ($rows9 as $key => $value){
	 	    if($key == 0){
          $_SESSION['currentUserName'] = $value;
		    }
    		if($key == 1){
    			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
    		}
        if($key == 2){
          $_SESSION['currentUserName'] = $_SESSION['currentUserName'] . ". " . $value;
  		  }
	    }
    }
?>

<!DOCTYPE html>

<html>

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Custom CSS -->
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">
      <title>Home</title>
  </head>

  <body class= "user">
      <!-- Header -->
        <div class = "nav">
            <div class="topnav" id="myTopnav">
              <div><a>Scholarship Application System</a> </div>
              <div class="banner desktop-view">
                  <div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample3.jpg" alt="profile-sample3" class="profile" />
                  </div>
                  <div>
                    <h2> Hello, Lorna Wanjiru Muchangi. </h2>
                  </div>
              </div>
              
              <div class="">
                     <a href = "../backend/logout.php" class = "button special">Logout</a>
                      <!-- <a href = "#"><?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?></a></div> -->
                      <a href = "tempUserProfile.php">Profile</a>
                      <a href = "tempUserApply.php">Apply</a>
                      <a href = "tempUserView.php">Status</a>
                      <a class = "current" href="tempUserHome.php">Home</a>
                    
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>
          <div class="banner desktop-hide">
              <div>
                 <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample3.jpg" alt="profile-sample3" class="profile" />
              </div>
              <div>
                <h2> Hello, Lorna Wanjiru Muchangi. </h2>
                <h3> Manage Your Scholarship in one application </h3>
              </div>
          </div>
          <div class="content">
            <h1>Your Personal Dashboard</h1>
          <div class="available">
          <div class="hero">
            <div class="hero-image">
                <img src="../images/hero.jpg" alt="" />
            </div>
            <div class="hero-content">
                <h1>SCHOLARSHIPS AND GRANTS</h1>
                <p>College can be expensive — which is why we offer generous scholarships to high-achieving students. Scholarships are based on academic merit and do not need to be repaid. The application is proud to award more than $400,000 in scholarships to our students each year through private funding.
                   Students seeking financial assistance to pay for their education may also qualify for grants. Grants are need-based money that does not have to be repaid and are funded by Federal, state, or institutional resources. </p>
                <a href="tempUserApply.php"> <input type = "submit" value="Apply Now" class = "btn"> </a>
            </div>
           </div>

        </div>
          <div class="scholarship-option"> 
            <div class="major">
              <h1>Find the best-fit scholarship</h1>
              <h4 class="text">Choosing the right scholarship is a daunting task. Apply for a relevant scholarships and wait for us to do the rest.</h4>
             </div>

            <div class="pad">
              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/merit-based-scholarship.jpg" alt="" /></a>
                  <div>
                    <h3>Scholarships for merit students</h3>
                  </div>
                  <p>Aspirants whose score is high in the academic, artistic, atheletic and in other activities will be provided with scholarship wither by the private organization or by student intended institutes. Purely , this king is based on thee mmerit score of the aspirants</p>
                </div>

              </div>

              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/PHYSICALLY-CHALLENGED-SCHOLARSHIPS.jpg" alt="" /></a>
                  <div>
                    <h3>Need based scholarships</h3>
                  </div>
                  <p>Aspirant who has financial economic problem to continue studies are given need based scholarship. Basically this scholarship is for aspirants who are ecnomically backward. The aspirants need to apply for this scholarship by filling the <b title="Free Application For Federal Students Aid">FAFSA</b></p>
                </div>

              </div>
            </div>

            <div class="pad">
              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/MINORITIES-SCHOLARSHIPS.jpg" alt="" /></a>
                  <div>
                    <h3>Student specific scholarship</h3>
                  </div>
                  <p>The specific scholarships are provided to specify category of the students with respected to race, sex, religion, family, medical history and many other factors. The most common category in this category is Minority scholarship.</p>
                  </div>

              </div>

              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/STUDY-BASED-SCHOLARSHIPS.jpg" alt="" /></a>
                  <div>
                    <h3>Career specific Scholarship</h3>
                  </div>
                  <p>The career specific scholarships mainly focuses on aspirants who wants to go for a specific field of study. Career specific scholarship will be provided by the college/university.</p>
                </div>

              </div>
            </div>
          </div>
          <!-- Footer -->
         <div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2021</p>
         </div>

       </div>
         
      

  

    <!-- Scripts -->
      <script src="../js/script.js"></script>

  </body>
</html>
