 <?php
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
  $_SESSION['appList'] = NULL;
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
  }
  /* Connect to database */
  $conn = new mysqli("localhost","scholar", "","sms");
  /* Checks Connection */
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
$getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";
$nameResult = mysqli_query($conn,$getName);
// Get every row of the table formed from the query
while($rows9=mysqli_fetch_row($nameResult))
{
foreach ($rows9 as $key => $value)
  {
    if($key == 0)
    {
      $_SESSION['currentUserName'] = $value;
    }

    if($key == 1)
    {
      $_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
    }

      if($key == 2)
      {
      $_SESSION['currentUserName'] = $_SESSION['currentUserName'] . ". " . $value;
    }
  }
}
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
              <div class="banner desktop-view">
                  <div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample3.jpg" alt="profile-sample3" class="profile" />
                  </div>
                  <div>
                    <h2> Hello, <?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?>. </h2>
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
         

      <!-- Main -->
      <div class="content">     
<!-- One -->
        <div class="application">
                <h1 ><strong>Apply for Scholarship</strong></h1>
                <h1>Select Filters</h1>
                <table>
                  <thead>
                     <tr>
                       <th>Class</th>
                       <th style="padding-left: 4%">Gender</th>
                       <th style="padding-left: 4%">Religion</th>
                       <th style="padding-left: 4%">Scholarship</th>
                      </tr>
                  </thead>
                  <tbody>
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="login" >
                      <tr>
                        <td >
                        <select name="class" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="class1">Class 1</option>
                          <option value="class2">Class 2</option>
                          <option value="class3">Class 3</option>
                          <option value="class4">Class 4</option>
                          <option value="class5">Class 5</option>
                          <option value="class6">Class 6</option>
                          <option value="class7">Class 7</option>
                          <option value="class8">Class 8</option>
                          <option value="class9">Class 9</option>
                          <option value="class10">Class 10</option>
                          <option value="class11">Class 11</option>
                          <option value="class12passed">Class 12 Passed</option>
                          <option value="diploma">Diploma</option>
                          <option value="graduation">Graduation</option>
                          <option value="postgraduation">Post-Graduation</option>
                          <option value="phd">PhD</option>
                        </select>
                       </td>
                       <td style="padding-left: 4%">
                        <select name="gender" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="both">Both</option>
                          <option value="transgender">Transgender</option>
                        </select>
                       </td>
                       <td style="padding-left: 4%">
                        <select name="religion" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="buddhism">Buddhism</option>
                          <option value="christian">Christian</option>
                          <option value="hindu">Hindu</option>
                          <option value="jain">Jain</option>
                          <option value="muslim">Muslim</option>
                          <option value="parsi">Parsi</option>
                          <option value="sikh">Sikh</option>
                        </select>
                      </td>
                      <td style="padding-left: 4%">
                        <select name="scholarship" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="merit">Merit Based</option>
                          <option value="mean">Means Based</option>
                          <option value="cultural">Cultural Talent</option>
                          <option value="visual">Visual Art</option>
                          <option value="sport">Sports Talent</option>
                          <option value="science">Science, Maths Based</option>
                          <option value="tech">Technology Based</option>
                        </select>
                      </td>
                      
                    </tr>
                    <td>
                        <input type = "submit" id="submit" class = "btn">
                    </td>
              </form>
            </tbody>
          </table>
        </div>

<!-- Two -->
    <div class="">
      <div class="scholarship-content">
        <div> 
          <?php
              $date1 =date("Y-m-d");
              $class=$gender=$religion=$scholarship="";
              $classflag=$genderflag=$religionflag=$scholarshipflag=0;
              $text="All Scholarships";
              if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
                  if($_POST['class']!='select'){
                    $class=$_POST['class'];
                    $classflag=1;
                  }
                  if($_POST['gender']!='select'){
                    $gender=$_POST['religion'];
                    $genderflag=1;
                  }
                  if($_POST['religion']!='select'){
                    $religion=$_POST['religion'];
                    $religionflag=1;
                  }
                  if($_POST['scholarship']!='select'){
                    $scholarship=$_POST['scholarship'];
                    $scholarshipflag=1;
                  }
                  if($classflag==1 || $religionflag==1 || $genderflag==1 || $scholarshipflag==1){
                      $text="Filter Based Scholarships";
                  }
              }
          ?>
          <h1><?php echo $text; ?></h1>
                      <table class="table">
                          <thead>
                            <tr>
                              <th style="width: 30%">Scholarship Name</th>
                              <th>Description</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if($classflag==1){   /* start4 */

                                if($genderflag==1){   /* start3 */

                                  if($religionflag==1){ /* start2 */

                                    if($scholarshipflag==1) {/* start1 */
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } /* end1 */
                                  } else{
                                    if($scholarshipflag==1){
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    }
                                  } /* end2 */
                                } else{
                                  if($religionflag==1){

                                    if($scholarshipflag==1) {
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } /* end1 */
                                  } else{
                                    if($scholarshipflag==1){
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    }
                                  }
                                }  /* end3 */
                              } else{
                                 if($genderflag==1){

                                  if($religionflag==1){

                                    if($scholarshipflag==1) {
                                      $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    }
                                  } else{
                                    if($scholarshipflag==1){
                                      $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    }
                                  }
                                } else{
                                  if($religionflag==1){

                                    if($scholarshipflag==1) {
                                      $to_query = "SELECT * FROM scholarship WHERE religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    }
                                  } else{
                                    if($scholarshipflag==1){
                                      $to_query = "SELECT * FROM scholarship WHERE sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    } else{
                                      $to_query = "SELECT * FROM scholarship WHERE adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                    }
                                  }
                                }
                              } /* end4 */
                              $sql_result = mysqli_query($conn, $to_query);
                              while($row=mysqli_fetch_row($sql_result)){
                                ?>
                                <tr>
                                  <td><a href="tempschdesc.php?sch=<?php echo $row[0]?>" title="<?php echo $row[2]?>"><?php echo $row[2]; ?></td>
                                  <td><?php echo $row[12]; ?></td>
                                </tr>
                                <?php
                              }
                              ?>
                          </tbody>
                      </table>
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
