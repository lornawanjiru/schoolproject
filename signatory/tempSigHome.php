<?php
session_start();
$_SESSION['selectedAppID'] = 0;

$_SESSION['appList'] = null;

//check validity of the user
$currentUserID = $_SESSION['currentUserID'];
if ($currentUserID == null) {
    header('Location:../index.php');
}

// Connect to database
$conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');
// Checks Connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$getName =
    "select S.firstName, S.middleName, S.lastName from signatory S where S.sigID = '" .
    $_SESSION['currentUserID'] .
    "'";

$nameResult = mysqli_query($conn, $getName);

while ($rows9 = mysqli_fetch_row($nameResult)) {
    foreach ($rows9 as $key => $value) {
        if ($key == 0) {
            $_SESSION['currentUserName'] = $value;
        }

        if ($key == 1) {
            $_SESSION['currentUserName'] =
                $_SESSION['currentUserName'] . ' ' . $value;
        }

        if ($key == 2) {
            $_SESSION['currentUserName'] =
                $_SESSION['currentUserName'] . '. ' . $value;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Home</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">
  </head>
  <body class = "user">
   
      <!-- Header -->
      <div class = "nav">
            <div class="topnav" id="myTopnav">
              <div class="header"><a>Scholarship Application System</a> </div>
              <div class="banner desktop-view">
                  <div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample3.jpg" alt="profile-sample3" class="profile" />
                  </div>
                  <div>
                    <h2> Hello, <?php echo $_SESSION['currentUserName'] .
                        ' (ID:' .
                        $_SESSION['currentUserID'] .
                        ')'; ?>. </h2>
                  </div>
              </div>
              <div class="">
              <a href = "../backend/logout.php" class = "button special">Logout</a>
              
              <a href = "tempSigProfile.php">Profile</a>
              <a class="dropdown-btn"> Scholarship
              </a>
              <div class="dropdown-container">
                <a href = "tempSigScholarship.php">My Scholarships</a>
                <a href = "tempAddScholarship.php">Add Scholarships</a> 
              </div>        
              <a class="dropdown-btn"> Status
              </a>
              <div class="dropdown-container">
                <a href = "tempSigApplication.php?app=Pending">Pending applications</a>
                <a href = "tempSigApplication.php?app=Approved">Accepted Applicaitons</a>
                <a href = "tempSigApplication.php?app=Rejected">Rejected Applicaitons</a> 
              </div> 
              <a class = "current" href="tempSigHome.php">Home</a>
              <a href="" class="icon" onclick="myFunction()">
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
                <h2> Hello,<?php echo $_SESSION['currentUserName'] .
                    ' (ID:' .
                    $_SESSION['currentUserID'] .
                    ')'; ?>. </h2>
                <h3> Manage Your Scholarship in one application </h3>
              </div>
          </div>
        <div class = "content">
        <h1>Your Personal Dashboard</h1>
          <div class="available">
          <div class="hero">
            <div class="hero-image">
                <img src="../images/hero.jpg" alt="" />
            </div>
            <div class="hero-content">
                <h1>OUR SCHOLARSHIPS</h1>
                <p>Our Organization is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education. </p>
                <a href="tempSigScholarship.php"> <input type = "submit" value="Our Scholarship" class = "btn"> </a>
            </div>
           </div>

        </div>
          <div class="scholarship-option"> 
            <div class="major">
              <h1>Types of Scholarship</h1>
              <h4 class="text">Choosing the right scholarship is a daunting task. In this application we want to make your applicants have a easy experience when it comes to applying for a scholarship.</h4>
              <p>The categories of applying are a number hence making applicants have a variety of choices and you to specify the group of applicants you need.</p>
             </div>

            <div class="pad">
              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/merit-based-scholarship.jpg" alt="" /></a>
                  <div>
                    <h3>Scholarships for merit students</h3>
                  </div>
                  <p>Aspirants whose score is high in the academic, artistic, atheletic and in other activities will be provided with scholarship wither by the private organization or by student intended institutes. </p>
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
            <p>copyright &copy;2022</p>
         </div>



    </div>

    
      <script src="../js/script.js"></script>

  </body>
</html>
