 <?php
 session_start();
 $_SESSION['selectedAppID'] = 0;
 $_SESSION['currentUserName'] = null;
 $_SESSION['appList'] = null;
 $currentUserID = $_SESSION['currentUserID'];
 if ($currentUserID == null) {
     header('Location:../index.php');
 }
 /* Connect to database */
 $conn = new mysqli('localhost', 'scholar', '', 'sms');
 /* Checks Connection */
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
<!-- One -->
        <div class="application">
                <h1 ><strong>Apply for Scholarship</strong></h1>
                <h1>Select Filters</h1>
                <table>
                  <thead>
                     <tr>
                       <th>Education Level</th>
                       <th style="padding-left: 4%;">Gender</th>
                       <th style="padding-left: 4%">Ethnic</th>
                       <th style="padding-left: 4%">Scholarship</th>
                       <th style="padding-left: 4%">Career Field</th>
                      </tr>
                  </thead>
                  <tbody>
                 <form action="<?php echo htmlspecialchars(
                     $_SERVER['PHP_SELF']
                 ); ?>" method="POST" name="login" >
                      <tr>
                        <td >
                        <select name="educationlevel" style="display: inline; ">
                          <option value="select" selected>Select</option>
                          <option value="highschool">High school</option>
                          <option value="diploma">Diploma</option>
                          <option value="bachelors">Bachelors</option>
                          <option value="masters">Masters</option>
                          <option value="phd">PhD</option>
                        </select>
                       </td>
                       <td style="padding-left: 4%;">
                        <select name="gender" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="nonbinary">Non-binary</option>
                          <option value="transgender">Transgender</option>
                        </select>
                       </td>
                       <td style="padding-left: 4%">
                        <select name="ethnic" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="americanindian">American Indian</option>
                          <option value="asian">Asian</option>
                          <option value="black">Black/African American</option>
                          <option value="latino">Latino/ Hispanics</option>
                          <option value="white">White</option>
                          <option value="hawaiian">Native Hawaiian/Pacific Islander</option>
                        </select>
                      </td>
                      <td style="padding-left: 4%">
                        <select name="scholarship" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="merit">Athletic Based</option>
                          <option value="mean">Needy based</option>
                          <option value="mean">Creative Development</option>
                          <option value="cultural">Community services</option>
                        </select>
                      </td>
                      <td style="padding-left: 4%">
                        <select name="careerfield" style="display: inline;">
                          <option value="select" selected>Select</option>
                          <option value="agriculture">Agriculture</option>
                          <option value="arts">Arts</option>
                          <option value="biologicalsciences">Biological Sciences</option>
                          <option value="administration">Administration</option>
                          <option value="dentistry">Dentistry</option>
                          <option value="education">Education</option>
                          <option value="engineering">Engineering</option>
                          <option value="environmentscience">Environement Science</option>
                          <option value="law">Law</option>
                          <option value="medicalscience">Medical Science</option>
                          <option value="veterinary">Veterinary</option>
                          <option value="socialscience">Social Science</option>
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
          $date1 = date('Y-m-d');
          $educationlevel = $gender = $ethnic = $scholarship = $careerfield =
              '';
          $educationlevelflag = $genderflag = $ethnicflag = $scholarshipflag = $careerfieldflag = 0;
          $text = 'All Scholarships';
          //strtoupper converts letters to uppercase so if the POST method was 'post' then it will be converted and will return True.
          if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
              if ($_POST['educationlevel'] != 'select') {
                  $educationlevel = $_POST['educationlevel'];
                  $educationallevelflag = 1;
              }
              if ($_POST['gender'] != 'select') {
                  $gender = $_POST['gender'];
                  $genderflag = 1;
              }
              if ($_POST['ethnic'] != 'select') {
                  $ethnic = $_POST['ethnic'];
                  $ethnicflag = 1;
              }
              if ($_POST['scholarship'] != 'select') {
                  $scholarship = $_POST['scholarship'];
                  $scholarshipflag = 1;
              }
              if ($_POST['careerfield'] != 'select') {
                  $careerfield = $_POST['careerfield'];
                  $careerfieldflag = 1;
              }
              if (
                  $educationlevelflag == 1 ||
                  $ethnicflag == 1 ||
                  $genderflag == 1 ||
                  $scholarshipflag == 1 ||
                  $careerfieldflag == 1
              ) {
                  $text = 'Filter Based Scholarships';
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
                            if ($educationlevelflag == 1) {
                                /* start5 */
                                if ($genderflag == 1) {
                                    /* start4 */
                                    if ($ethnicflag == 1) {
                                        /* start3 */
                                        if ($scholarshipflag == 1) {
                                            /* start2 */
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND sch LIKE '$scholarship' AND careerfield LIKE '$careerfieldfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } /* end1 */
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } /* end2 */
                                    } else {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND careerfield LIKE '$careerfield' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } /* end1 */
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND gender LIKE '$gender' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    } /* end3 */
                                } else {
                                    if ($ethnicflag == 1) {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND ethnic LIKE '$ethnic' AND sch LIKE '$scholarship' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND ethnic LIKE '$ethnic' AND sch LIKE '$scholarship'' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND ethnic LIKE '$ethnic'  AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND ethnic LIKE '$ethnic' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    } else {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND sch LIKE '$scholarship' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel'  AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$educationlevel' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    }
                                }
                            } /* end4 */ else {
                                if ($genderflag == 1) {
                                    if ($ethnicflag == 1) {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND sch LIKE '$scholarship' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND sch LIKE '$scholarship'' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND ethnic LIKE '$ethnic'  AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND ethnic LIKE '$ethnic' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    } else {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND sch LIKE '$scholarship' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender'  AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    }
                                } else {
                                    if ($ethnicflag == 1) {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE  ethnic LIKE '$ethnic' AND sch LIKE '$scholarship' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE  ethnic LIKE '$ethnic' AND sch LIKE '$scholarship'' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE  ethnic LIKE '$ethnic'  AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE  ethnic LIKE '$ethnic' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    } else {
                                        if ($scholarshipflag == 1) {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE  sch LIKE '$scholarship' AND careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE  sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        } else {
                                            if ($careerfieldflag == 1) {
                                                $to_query = "SELECT * FROM scholarship WHERE  careerfield LIKE '$careerfield' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            } else {
                                                $to_query = "SELECT * FROM scholarship WHERE  adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                            }
                                        }
                                    }
                                }
                            }
                            // end 5
                            $sql_result = mysqli_query($conn, $to_query);
                            while ($row = mysqli_fetch_row($sql_result)) { ?>
                                <tr>
                                  <td><a href="tempschdesc.php?sch=<?php echo $row[0]; ?>" title="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></td>
                                  <td><?php echo $row[12]; ?></td>
                                </tr>
                                <?php }
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
