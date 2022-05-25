<?php
session_start();
$_SESSION['selectedAppID'] = 0;

$_SESSION['appList'] = null;

//check validity of the user
$currentUserName = $_SESSION['currentUserName'];
$currentUserID = $_SESSION['currentUserID'];
if ($currentUserID == null) {
    header('Location:../index.php');
}

// Connect to database
$conn = new mysqli('localhost', 'scholar', '', 'sms');

// Checks Connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$getName =
    "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '" .
    $_SESSION['currentUserID'] .
    "'";

$nameResult = mysqli_query($conn, $getName);

// Get every row of the table formed from the query
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
                    <h2> Hello, <?php echo $_SESSION['currentUserName'] .
                        ' (ID:' .
                        $_SESSION['currentUserID'] .
                        ')'; ?>. </h2>
                  </div>
              </div>
              
              <div class="">
                     <a href = "../backend/logout.php" class = "button special">Logout</a>
                      <!-- <a href = "#"><?php echo $_SESSION[
                          'currentUserName'
                      ] .
                          ' (ID:' .
                          $_SESSION['currentUserID'] .
                          ')'; ?></a></div> -->
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
                <p>College can be expensive — which is why we offer generous scholarships to high-achieving students. Scholarships are based on various merits and do not need to be repaid. The application is proud to award more than $400,000 in scholarships to our students each year through private funding.
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
                  <p>Aspirants whose score is high in the academic, artistic, atheletic and in other activities will be provided with scholarship wither by the private organization or by student intended institutes.Academic merit scholarships abound and are based on things like your GPA and standard test scores.  Most merit scholarship requirements relate only to performance, and do not consider financial need as a qualifying condition.  In some cases though, your extracurricular achievements are used to distinguish you from other applicants. Another type of merit scholarship is based on athletic performance.  Star athletes are awarded college access, as a result of exceptional athletic achievement in high-school.  Some awards are tied to an athlete’s grades too, combining both qualifications in an effort to reward responsible student-athletes.</p>
                </div>

              </div>

              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/PHYSICALLY-CHALLENGED-SCHOLARSHIPS.jpg" alt="" /></a>
                  <div>
                    <h3>Need based scholarships</h3>
                  </div>
                  <p>Aspirant who has financial economic problem to continue studies are given need based scholarship. Basically this scholarship is for aspirants who are ecnomically backward. The aspirants need to apply for this scholarship by filling the <b title="Free Application For Federal Students Aid">FAFSA</b>This standardized application for student aid is square-one for any scholarship hunt, because it gauges your need for financial assistance during college.  Student income, parental income and assets, and family size are used to compute your Expected Family Contribution (EFC). Your EFC is then used to create an individual Student Aid Report (SAR) that spells out your anticipated college financial aid needs.  The SAR is sent to colleges of your choice, where it is used to draft your unique financial aid package containing loans, scholarships and other forms of student assistance.</p>
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
                  <p>The specific scholarships are provided to specify category of the students with respected to race, sex, religion, family, medical history and many other factors.Many scholarships are limited to minority applicants.  Race-based programs are the most common example of the aid form known as student-specific scholarships. This scholarship category also includes gender-based and religion-based awards, along with any other scholarship that targets only students who share a particular characteristic.</p>
                  </div>

              </div>

              <div class="cards">

                <div>
                  <a href="#" class="image featured"><img src="../images/scholarships/STUDY-BASED-SCHOLARSHIPS.jpg" alt="" /></a>
                  <div>
                    <h3>Career specific Scholarship</h3>
                  </div>
                  <p>The career specific scholarships mainly focuses on aspirants who wants to go for a specific field of study. Targeted scholarships are also available for individuals pursuing education in specific fields.  Engineers, educators, and medical students might qualify for career-based scholarship awards that are designed to cultivate competent professionals in those areas.</p>
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
