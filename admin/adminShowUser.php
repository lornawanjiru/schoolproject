<?php
$studentID = null;
$status = null;
?>
<?php
session_start();
$_SESSION['selectedAppID'] = 0;
$_SESSION['appList'] = null; //check validity of the user
$currentUserName = $_SESSION['currentUserName'];
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
    "select A.firstName, A.middleName, A.lastName from admin A where A.adminID = '" .
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
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">
      <link href="../css/admin.css" rel="stylesheet">

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
              <a class = "current" href = "tempAdmin.php">Home</a>
             
                <a class="dropdown-btn">Applications</a>
                <div class="dropdown-container">
                  <a href = "tempPendingApp.php">Pending Students</a>
                  <a href = "tempAcceptedApp.php">Accepted Students</a>
                  <a href = "tempRejectedApp.php">Rejected Students</a>
                </div>
                <a class="dropdown-btn">Scholarships</a>
                <div class="dropdown-container">
                  <a href = "tempScholarship.php?scholarship=Pending">Pending Scholarships</a></li>
                  <a href = "tempScholarship.php?scholarship=Approved">Accepted Scholarships</a></li>
                  <a href = "tempScholarship.php?scholarship=Rejected">Rejected Scholarships</a></li>
                </div>
             
                
                <a class="dropdown-btn">Users</a>
                <div class="dropdown-container">
                   
                  <a href = "tempSignatoryShow.php">Signatory</a></li>
                  <a href = "tempStudentShow.php">Students</a></li>
                </div>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>
          </div>
				

							<!-- Content -->
								<div class="content admin">
									<section>
                      <?php try {
                          $conn = new mysqli('localhost', 'scholar', '', 'sms');
                          if ($conn->connect_error) {
                              die('Connection failed: ' . $conn->connect_error);
                          }
                          /* Student */ if (
                              isset($_POST['showUser']) and
                              $_POST['showUser'] == 'showStudent'
                          ) { ?><h1 style="text-align:center; font-size:25px">Student Details</h1><?php
$studentID = $_POST['ID'];
$sql = "SELECT * FROM student WHERE studentID='$studentID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
                        <table class="table">
                              <tr>
                                  <th style="width:50%"><b>Student ID</b></th>
                                  <td><?php echo $row['studentID']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Email ID</b></th>
                                  <td><?php echo $row['upMail']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Name</b></th>
                                    <td><?php echo $row['firstName'] .
                                        ' ' .
                                        $row['middleName'] .
                                        ' ' .
                                        $row['lastName']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Current Location</b></th>
                                  <td><?php echo $row[
                                      'currentlocation'
                                  ]; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Gender</b></th>
                                  <td><?php echo $row['gender']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Phone Number</b></th>
                                  <td><?php echo $row['phonenumber']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>specialization</b></th>
                                  <td><?php echo $row['specialization']; ?></td>
                              </tr>
                              
                              
                              <tr>
                                  <th style="width:50%"><b>Highest achieved educational Level </b></th>
                                  <td><?php echo $row['level']; ?></td>
                              </tr>
                             
                              <tr>
                                  <th style="width:50%"><b>Status</b></th>
                                  <td><?php
                                  echo $row['status'];
                                  $status = $row['status'];
                                  ?></td>
                              </tr>
                              <tr>
                                <th><b>Applications : </b></th>
                                <td>
                                  <button id="showapp" value="showapp" onclick="viewapp()">Show</button>
                                  <button id="hideapp" value="hideapp" onclick="hideapp()" style="display: none;">Hide</button>
                                </td>
                              </tr>
                        </table>
                        <section id="application" style="display: none;">
                          	<table class="table table-bordered default login">
                            	<thead>
                                	<tr>
                                  		<th style="width:10%">Application ID</th>
                                  		<th style="width:30%">Scholarship</th>
                                      <th style="width:10%">Scholarship ID</th>
                                  		<th style="width:10%">Signatory Approval</th>
                                      <th style="width:10%">Application Date</th>
                                  		<th style="width:10%">App Status</th>
                                	</tr>
                            	</thead>
                            	<tbody>
                                	<?php
                                 $queryScholarship = "SELECT A.applicationID, S.schname, A.scholarshipID, A.verifiedBySignatory, A.appDate, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $studentID";
                                 $qSchoResult = mysqli_query(
                                     $conn,
                                     $queryScholarship
                                 );
                                 while (
                                     $rows = mysqli_fetch_row($qSchoResult)
                                 ) {
                                     foreach ($rows as $key => $value) {
                                         if (
                                             $key == 0
                                         ) { ?> <tr><td> <?php echo $value;}
                                         if (
                                             $key == 1 ||
                                             $key == 2 ||
                                             $key == 3 ||
                                             $key == 4 ||
                                             $key == 5
                                         ) { ?> </td><td> <?php echo $value;}
                                         if (
                                             $key == 6
                                         ) { ?></td><td><?php echo $value; ?></td></tr><?php }
                                     }
                                 }
                                 ?>
                            	</tbody>
                          	</table>

            						</section><br>
                        <section style="text-align:center">
                          <form name="blockform" method="post" onsubmit="confirmblock(this,'This will Block Student as well as All his Applications.\n Are your Sure?')" action="../backend/adminBlockUser.php">
                            <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                            <input type="submit"  name="blockUser" id="blockUserbtn" value="blockStudent" <?php if (
                                $status === 'inactive'
                            ) {
                                echo " style = 'color:#fff;display:none'";
                            } ?>>
                          </form><br>

                          <form name="unblockform" action="../backend/adminUnblockUser.php" onsubmit="confirmunblock(this,'This will unblock Student as well as All his Applications.\n Are your Sure?')"  method="post">
                            <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                            <input type="submit" name="unblockUser" id="unblockUserbtn" value="unblockStudent" <?php if (
                                $status === 'active'
                            ) {
                                echo " style = 'color:#fff;display:none;'";
                            } ?>>
                          </form>
                        </section>
                        <?php }
}
/* Signatory */
} elseif (
                              isset($_POST['showUser']) and
                              $_POST['showUser'] == 'showSig'
                          ) { ?><h1 style="text-align:center; font-size:25px">Signatory Details</h1><?php
$sigID = $_POST['ID'];
$sql = "SELECT * FROM signatory WHERE sigID='$sigID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
                        <table class="table">
                              <tr>
                                  <th style="width:50%"><b>Signatory ID</b></th>
                                  <td><?php echo $row['sigID']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Email ID</b></th>
                                  <td><?php echo $row['upMail']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Name</b></th>
                                    <td><?php echo $row['firstName'] .
                                        ' ' .
                                        $row['middleName'] .
                                        ' ' .
                                        $row['lastName']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Organization/University</b></th>
                                  <td><?php echo $row['organization']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Position</b></th>
                                  <td><?php echo $row['position']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Contact </b></th>
                                  <td><?php echo $row['phonenumber']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Status</b></th>
                                  <td><?php
                                  echo $row['status'];
                                  $status = $row['status'];
                                  ?></td>
                              </tr>
                              <tr>
                                <th><b>Scholarships : </b></th>
                                <td>
                                  <button id="showsch" value="showsch" onclick="viewsch()">Show</button>
                                  <button id="hidesch" value="hidesch" onclick="hidesch()" style="display: none;">Hide</button>
                                </td>
                              </tr>
                        </table>
                        <section id="scholarship" style="display: none;">
                                	<?php
                                 $queryScholarship = "SELECT * FROM scholarship WHERE sigID = $sigID";
                                 $result = $conn->query($queryScholarship);
                                 if ($result->num_rows > 0) { ?>
                                                <table class = "table table-bordered default login">
            				                              <thead>
            				                                <tr>
            				                                  <th class = "col-md-1" style="width: 5%"><strong>SchID</strong></th>
            				                                  <th class = "col-md-1" style="width: 5%"><strong>SigID</strong></th>
            				                                  <th class = "col-md-1" style="width: 20%"><strong>Name</strong></th>
            				                                  <th class = "col-md-1" style="width: 3%"><strong>Application DeadLine</strong></th>
            				                                  <th class = "col-md-1" style="width: 5%;text-align:center;font-size:26px" colspan="5"><strong>Action</strong> </th>
                                                      <!-- <th class = "col-md-1"></th>
            				                               		<th class = "col-md-1"></th>
            				                               		<th class = "col-md-1"></th>
            				                                  <th class = "col-md-1"></th> -->

            				                                </tr>
            				                              </thead>
            				                              <tbody>
          				                                	<?php while (
                                                   $row = $result->fetch_assoc()
                                               ) { ?>
                                                    <tr>
                                                      <td><?php
                                                      $schID =
                                                          $row['scholarshipID'];
                                                      echo $row[
                                                          'scholarshipID'
                                                      ];
                                                      ?></td>
                                                      <td><?php
                                                      $sigID = $row['sigID'];
                                                      echo $row['sigID'];
                                                      ?></td>
                                                        <td><a href="#" data-toggle="modal" data-target="#scholarshipDescription"><?php
                                                        $schname =
                                                            $row['schname'];
                                                        echo $row['schname'];
                                                        ?></a></td>
                                                        <td><?php echo $row[
                                                            'appDeadline'
                                                        ]; ?></td>
                                                        <td>
                                                          <form action="tempSchView.php" method="post">
                                                              <input type="hidden" name="schname" value="<?php echo $schname; ?>">
                                                              <input type="hidden" name="sigID" value="<?php echo $sigID; ?>">
                                                              <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                              <button name="view" value="View">View</button>
                                                          </form>
                                                        </td>
                                                        <td>
                                                          <form action="../backend/adminAcceptReject.php" method="post">
                                                            <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                            <button name="accrej" value="Accept" <?php if (
                                                                $row[
                                                                    'adminapproval'
                                                                ] === 'Approved'
                                                            ) {
                                                                echo 'disabled';
                                                                echo " style = 'color:#fff'";
                                                            } ?>>Approve</button>
                                                          </form>
                                                        </td>
                                                        <td>
                                                           <form action="../backend/adminAcceptReject.php" method="post">
                                                              <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                              <button name="accrej" value="Reject" <?php if (
                                                                  $row[
                                                                      'adminapproval'
                                                                  ] ===
                                                                  'Rejected'
                                                              ) {
                                                                  echo 'disabled';
                                                                  echo " style = 'color:#fff'";
                                                              } ?>>Reject</button>
                                                           </form>
                                                        </td>
                                                        <td>
                                                           <form action="../backend/adminBlockUnblockSch.php" method="post">
                                                              <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                              <button name="blk_unblk" value="blockScholarship" <?php if (
                                                                  $row[
                                                                      'schstatus'
                                                                  ] ===
                                                                  'inactive'
                                                              ) {
                                                                  echo 'disabled';
                                                                  echo " style = 'color:#fff'";
                                                              } ?>>Block</button>
                                                           </form>
                                                        </td>
                                                        <td>
                                                           <form action="../backend/adminBlockUnblockSch.php" method="post">
                                                              <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                              <button name="blk_unblk" value="unblockScholarship" <?php if (
                                                                  $row[
                                                                      'schstatus'
                                                                  ] === 'active'
                                                              ) {
                                                                  echo 'disabled';
                                                                  echo " style = 'color:#fff'";
                                                              } ?>>Unblock</button>
                                                           </form>
                                                        </td>
                                                    </tr>
          				                              </tbody>
          				                              <?php } ?>
          				                            </table>
          				                            <?php }
                                 ?>
            						</section><br>
                        <section style="text-align:center">
                          <form name="blockform" method="post" onsubmit="confirmblock(this,'This will Block Signatory, the Scholarships corresponding to them as well as All Applications.\n Are your Sure?')" action="../backend/adminBlockUser.php">
                            <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                            <input type="submit"  name="blockUser" id="blockUserbtn" value="blockSig" <?php if (
                                $status === 'inactive'
                            ) {
                                echo " style = 'color:#fff;display:none'";
                            } ?>>
                          </form><br>

                          <form name="unblockform" action="../backend/adminUnblockUser.php" onsubmit="confirmunblock(this,'This will Unblock Signatory, the Scholarships corresponding to them as well as All Applications.\n Are your Sure?')"  method="post">
                            <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                            <input type="submit" name="unblockUser" id="unblockUserbtn" value="unblockSig" <?php if (
                                $status === 'active'
                            ) {
                                echo " style = 'color:#fff;display:none;'";
                            } ?>>
                          </form>
                        </section>
                        <?php }
} /* ADMIN  */
} elseif (isset($_POST['showUser']) and $_POST['showUser'] == 'showAdmin') {
                              echo 'Admin';
                          }
                      } catch (Exception $e) {
                      } ?>
									</section>
                  <div class="footer">
                <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
                <p>copyright &copy;2022</p>
         </div>
								</div>
                
      </div>

		

		<!-- Scripts -->
    <script type="text/javascript">
      //Student
      function viewapp(){
        var showapp=document.getElementById("showapp");
        var hideapp=document.getElementById("hideapp");
  			var schview=document.getElementById("application");
        schview.style.display = 'block';
        hideapp.style.display = 'inline';
        showapp.style.display = 'none';
  		}

      function hideapp(){
        var showapp=document.getElementById("showapp");
        var hideapp=document.getElementById("hideapp");
        var schview=document.getElementById("application");
        schview.style.display = 'none';
        hideapp.style.display = 'none';
        showapp.style.display = 'inline';
  		}

      function confirmblock(form,str){
        if(confirm(str)){
          document.blockform.submit();
        } else{
          event.preventDefault();
        }
      }

      function confirmunblock(form,str){
        if(confirm(str)){
          document.unblockform.submit();
        } else{
          event.preventDefault();
        }
      }



      //Signatory
      function viewsch(){
        var showapp=document.getElementById("showsch");
        var hideapp=document.getElementById("hidesch");
  			var schview=document.getElementById("scholarship");
        schview.style.display = 'block';
        hideapp.style.display = 'inline';
        showapp.style.display = 'none';
  		}

      function hidesch(){
        var showapp=document.getElementById("showsch");
        var hideapp=document.getElementById("hidesch");
        var schview=document.getElementById("scholarship");
        schview.style.display = 'none';
        hideapp.style.display = 'none';
        showapp.style.display = 'inline';
  		}

  	</script>
      
      <script src="../js/script.js"></script>
	</body>
</html>
