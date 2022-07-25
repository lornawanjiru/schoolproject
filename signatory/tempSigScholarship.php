	<?php
 session_start();

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
<!DOCTYPE HTML>
<html>
  <head>
      <title>Home</title>

      

      <!-- Custom CSS -->
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">
  </head>

  <body class = "user">
  
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
              
              <a href = "tempSigProfile.php">Profile</a>
              <a class="dropdown-btn"> Scholarship
              </a>
              <div class="dropdown-container">
                <a href = "tempSigScholarship.php">My Scholarships</a>
                <a href = "tempAddScholarship.php">Add Scholarships</a> 
              </div>        
              <a class="dropdown-btn"> Scholarship Status
              </a>
              <div class="dropdown-container">
                <a href = "tempSigApplication.php?app=Pending">Pending applications</a>
                <a href = "tempSigApplication.php?app=Approved">Accepted Applicaitons</a>
                <a href = "tempSigApplication.php?app=Rejected">Rejected Applicaitons</a> 
              </div> 
              <a class = "current" href="tempSigHome.php">Home</a>
              <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>



				
		<div class="content">
		<div class="contain">	

				<div>
					<h3 style="padding-left: 36%;"><strong>Your Scholarships</strong></h3><br>
				</div>

						<?php
      $sql =
          "SELECT * FROM scholarship WHERE sigID='" .
          $_SESSION['currentUserID'] .
          "'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) { ?>
					<table class = "table table-hover table-condensed">
						<thead>
						<tr>
							<th class = "col-md-1"><strong>Scholarship</strong></th>
							<th class = "col-md-2"><strong>Application Deadline</strong></th>
							<th class = "col-md-1"><strong>Applications Limit</strong></th>
							<th class = "col-md-1"><strong>Total Applicants</strong></th>
							<th class = "col-md-1"><strong>Admin Approval</strong></th>
							<th class = "col-md-1"><strong>Scholarship Status</strong></th>
							<th class = "col-md-1"><strong>Scholarship Details</strong></th>

						</tr>
						</thead>
						<tbody>
							<?php while ($row = $result->fetch_assoc()) { ?>
							<tr>

								<td style="text-transform : uppercase;"><strong><?php echo $row[
            'schname'
        ]; ?></strong></td>
								<td style="padding :1%">
								<?php
        //The time() function returns the current time in the number of seconds since the Unix Epoch (January 1 1970 00:00:00 GMT).
        $now = time();
        $date = $row['appDeadline'];
        //The strtotime() function parses an English textual datetime into a Unix timestamp (the number of seconds since January 1 1970 00:00:00 GMT).
        if (strtotime($date) > $now) {
            echo 'Ongoing', '(', $date, ')';
        } else {
            echo 'Finished';
        }
        ?>
								</td>
								<td><?php echo $row['granteesNum']; ?></td>
																	<td>20</td>
								<td><?php echo $row['adminapproval']; ?></td>
																	<td><strong><u>active</u></strong></td>

								<td>
								<form method = "post" name = "editScholarshipForm" action = "tempEditScholarship.php">
									<input type = "hidden" name = "scholarshipID" value = "<?php echo $row[
             'scholarshipID'
         ]; ?>">
									<button type = "submit" name="view" class = "btn btn-info">View</button>
								</form>
								</td>
							</tr>
						<?php } ?>
						</tbody>
						<?php } else { ?>
							<h3 align="text-center">You Have Not Submitted Any Scholarship</h3>
						<?php }
      ?>
					</table>


					<form action = "tempAddScholarship.php" class = "text-center">
						<input type = "submit" value = "Add Scholarship">
					</form>

</div>
					<div class="footer">
						<h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
						<p>copyright &copy;2022</p>
					</div>
		</div>

						

	
      <script src="../js/script.js"></script>
  
	</body>
</html>
