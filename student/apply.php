
<?php
session_start();
$_SESSION['selectedAppID'] = 0;

$_SESSION['appList'] = null;
//check validity of the user
$currentUserID = $_SESSION['currentUserID'];
if ($currentUserID == null) {
    header('Location:../index.php');
} // Connect to database
$conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms'); // Checks Connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$getName =
    "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '" .
    $_SESSION['currentUserID'] .
    "'";
$nameResult = mysqli_query($conn, $getName); // Get every row of the table formed from the query
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
$conn->close();
?>
<!DOCTYPE HTML>
<html>
  <head>
      <title>Home</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">


      <!-- Custom CSS -->
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">
  </head>

  <body class = "user">

      <!-- Header -->
      <div class = "nav">
            <div class="topnav" id="myTopnav">
              <div><a>Scholarship Application System</a> </div>
              <div><a>Student Dashboard</a> </div>
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
 	<!-- Main -->
   <div class="content">
          <?php
          $conn = new mysqli('localhost', 'scholar', '', 'sms');
          $schid = $_SESSION['schid'];
          $sigID = $_POST['sigID'];
          $_SESSION['sigID'] = $sigID;
          $sql = "SELECT * FROM application where scholarshipID=$schid AND studentID=$currentUserID AND sigID = $sigID";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) { ?>
             <script type="text/javascript">
              alert("You Have Already Applied for this scholarship!");
              location.replace("tempUserView.php")
            </script>

           <?php }
          } else {
               ?>
                <h1>Dear&nbsp;&nbsp;<b><?php echo $_SESSION[
                    'currentUserName'
                ]; ?></b>,</h1>
                <h1>Make sure you have your Profile Completed.<br>Your Profile details will be submitted in this application.<br></h1>
                <form style="padding-left: 20%; display: inline;" method="post">
                  <input type="submit" id="apply" name="apply" value="Check Your Profile Here >>" title="User Profile" formaction="tempUserProfile.php">
                    &nbsp;&nbsp;&nbsp;
                    <input type="submit" id="apply" name="apply" value="Continue Otherwise >>" title="Click here only if your Profile is Completed!!" formaction="applyprocess.php">

                   </form>
           

            <div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2022</p>
         </div>
         <?php
          }
          $conn->close();
          ?>
        </div>
        <!-- Footer -->
       
      <script src="../js/script.js"></script>

  </body>
</html>
