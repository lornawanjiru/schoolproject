
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
              <a class = "current" href = "#">Home</a>
             
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
                  <li><a href = "tempAdminShow.php">Admin</a></li>
                  <li><a href = "tempSignatoryShow.php">Signatory</a></li>
                  <li><a href = "tempStudentShow.php">Students</a></li>
                </div>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>
          </div>

				

							<!-- Content -->
								<div class="content edit-back">
									<section>

									
											<h1>Applications of Pending Students</h1>
										
                    <?php
                    /* Connect to database */
                    $conn = new mysqli('localhost', 'scholar', '', 'sms');
                    /* Checks Connection */
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    $to_query = "SELECT A.applicationID,A.studentID,A.scholarshipID,S.schname,A.appDate,
                        A.appstatus,A.verifiedBySignatory from application AS A join scholarship AS S ON A.scholarshipID=S.scholarshipID WHERE A.verifiedBySignatory='Pending'";
                    $sql_result = mysqli_query($conn, $to_query);
                    if (mysqli_num_rows($sql_result) > 0) { ?>
                          <table class="table table-bordered default login">
                            <thead>
                              <tr>

                                <th class = "col-md-1"><strong>Application Number[ID]</strong></th>
                                <th class = "col-md-1"><strong>Applicant ID</strong></th>
                                <th class = "col-md-1"><strong>Scholarship ID</strong></th>
                                <th class = "col-md-1" style="width: 25%"><strong>Scholarship Name</strong></th>
                                <th class = "col-md-1" ><strong>Application Date</strong></th>
                                <th class = "col-md-1 text-center"><strong>AppStatus</strong></th>
                                <th class = "col-md-1"><strong>Signatory Approval</strong></th>

                              </tr>
                            </thead>
                            <tbody>
                            <?php while (
                                $rows = mysqli_fetch_row($sql_result)
                            ) {
                                $appID = 0;
                                foreach ($rows as $key => $value) {
                                    if ($key == 0) {
                                        $appID = $value; ?><tr><td><?php echo $appID; ?></td><?php
                                    }
                                    if (
                                        $key == 1
                                    ) { ?><td><?php echo $value; ?></td><?php }
                                    if (
                                        $key == 2
                                    ) { ?><td><?php echo $value; ?></td><?php }
                                    if (
                                        $key == 3
                                    ) { ?><td><?php echo $value; ?></td><?php }
                                    if (
                                        $key == 4
                                    ) { ?><td><?php echo $value; ?></td><?php }
                                    if (
                                        $key == 5
                                    ) { ?><td><?php echo $value; ?></td><?php }
                                    if ($key == 6) { ?>
                                        <td><?php echo $value; ?></td>
                                <?php }
                                }
                            }} else {echo 'No Pending Applications';}
                    mysqli_close($conn);
                    ?>
                        </tbody>
                    </table>
									</section>
                  <div class="footer">
                    <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
                    <p>copyright &copy;2022</p>
                </div>
								</div>
               
						
		</div>

	
      <script src="../js/script.js"></script>
	</body>
</html>
