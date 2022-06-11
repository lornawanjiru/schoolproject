<?php
/*Start a session*/
  session_start();

  $conn = new mysqli("localhost","scholar", "","sms");

  // Checks Connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['scholarship'])){
    	$scholarship = $_GET['scholarship'];
    }else{
    	$scholarship = "All";
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
                   <a href = "tempAdminShow.php">Admin</a>
                  <a href = "tempSignatoryShow.php">Signatory</a>
                  <a href = "tempStudentShow.php">Students</a>
                </div>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>
          </div>


			
					<div class="content edit-back">

									<?php if($scholarship == "All") {   /*For all scholarships*/?>
									<section>
										
											<h1><?php echo $scholarship; ?> Scholarships  </h1><br>
										
              				<?php
				                  $sql = "SELECT scholarshipID, sigID, schname, appDeadline, description, adminapproval, schstatus FROM scholarship ORDER BY `appDeadline` ASC "; //need to be ordered according to uploaded date.
													$result = $conn->query($sql);
													if ($result->num_rows > 0) {
				                                ?>
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
				                                	<?php
				                              			while($row = $result->fetch_assoc()) {
				                              		?>
				                                    <tr>
				                                    	<td><?php
				                                    		$schID=$row['scholarshipID'];
				                                    		echo $row['scholarshipID']; ?></td>
				                                    	<td><?php
				                                    		$sigID=$row['sigID'];
				                                    		echo $row['sigID']; ?></td>
				                                      	<td><a href="#" data-toggle="modal" data-target="#scholarshipDescription"><?php
				                                      		$schname=$row['schname'];
				                                      		echo $row['schname']; ?></a></td>
				                                      	<td><?php echo $row['appDeadline']; ?></td>
                                                <td>
                    															<form action="tempSchView.php" method="post">
                    					                        <input type="hidden" name="schname" value="<?php echo $schname; ?>">
                    					                        <input type="hidden" name="sigID" value="<?php echo $sigID; ?>">
                                                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    					                        <button name="view" style="width: 100%;" value="View">View</button>
                    					                    </form>
                    														</td>
				                                      	<td>
				                                      		<form action="../backend/adminAcceptReject.php" method="post">
					                                          <input type="hidden" name="schID" value="<?php echo $schID; ?>">
					                                          <button name="accrej" style="width: 100%;" value="Accept" <?php if($row['adminapproval'] === "Approved"){
                                                      echo "disabled";
                                                      echo " style = 'color:#fff'";
                                                    } ?>>Approve</button>
					                                        </form>
                    														</td>
                    														<td>
                    															 <form action="../backend/adminAcceptReject.php" method="post">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="accrej" style="width: 100%;" value="Reject" <?php if($row['adminapproval'] === "Rejected"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Reject</button>
                    						                   </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmblock(this,'This will Block the Scholarship and corresponding Applications.\n This wont Block the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" style="width: 100%;" value="blockScholarship" <?php if($row['schstatus'] === "inactive"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Block</button>
                    						                   </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmunblock(this,'This will Unblock the Scholarships and corresponding Applications.\n This wont Unblock the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" style="width: 100%;"  value="unblockScholarship" <?php if($row['schstatus'] === "active"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Unblock</button>
                    						                   </form>
                    														</td>
				                                    </tr>
				                              </tbody>
				                              <?php } ?>
				                            </table>
				                            <?php } ?>
									</section>
                <?php } else if($scholarship == "Pending" || $scholarship == "Approved" || $scholarship == "Rejected"){   /*For specified scholarships*/?>
									<section>
										<header>
											<h3 style="padding-left: 30%;font-size:30px"><?php echo $scholarship; ?> Scholarships</h3><br>
										</header>
              				<?php
				                  $sql = "SELECT scholarshipID, sigID, schname, appDeadline, description, adminapproval, schstatus FROM scholarship WHERE adminapproval='$scholarship' ORDER BY `appDeadline` ASC"; //need to be ordered according to uploaded date.
													$result = $conn->query($sql);
													if ($result->num_rows > 0) {
				                                ?>
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
				                                	<?php
				                              			while($row = $result->fetch_assoc()) {
				                              		?>
				                                    <tr>
				                                    	<td><?php
				                                    		$schID=$row['scholarshipID'];
				                                    		echo $row['scholarshipID']; ?></td>
				                                    	<td><?php
				                                    		$sigID=$row['sigID'];
				                                    		echo $row['sigID']; ?></td>
				                                      	<td><a href="#" data-toggle="modal" data-target="#scholarshipDescription"><?php
				                                      		$schname=$row['schname'];
				                                      		echo $row['schname']; ?></a></td>
				                                      	<td><?php echo $row['appDeadline']; ?></td>
                                                <td>
                                                  <form action="tempSchView.php" method="post">
                                                     <input type="hidden" name="schname" value="<?php echo $schname; ?>">
                                                    <input type="hidden" name="sigID" value="<?php echo $sigID; ?>">
                                                    <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                    <button name="view" style="width: 100%;" value="View">View</button>
                                                  </form>
                                                </td>
				                                      	<td>
				                                      		<form action="../backend/adminAcceptReject.php" method="post">
					                                          <input type="hidden" name="schID" value="<?php echo $schID; ?>">
					                                          <button name="accrej" style="width: 100%;" value="Accept" <?php if($row['adminapproval'] === "Approved"){
                                                      echo "disabled";
                                                      echo " style = 'color:#fff'";
                                                    } ?>>Approve</button>
					                                        </form>
                    														</td>
                    														<td>
                    															 <form action="../backend/adminAcceptReject.php" method="post">
						                                          <input type="hidden" name="schID" value="<?php echo $schID; ?>">
						                                          <button name="accrej" style="width: 100%;" value="Reject" <?php if($row['adminapproval'] === "Rejected"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Reject</button>
						                                        </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmblock(this,'This will Block the Scholarship and corresponding Applications.\n This wont Block the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" style="width: 100%;" value="blockScholarship" <?php if($row['schstatus'] === "inactive"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Block</button>
                    						                   </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmunblock(this,'This will Unblock the Scholarships and corresponding Applications.\n This wont Unblock the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" style="width: 100%;" value="unblockScholarship" <?php if($row['schstatus'] === "active"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Unblock</button>
                    						                   </form>
                    														</td>
				                                    </tr>
				                              </tbody>
				                              <?php } ?>
				                            </table>
				                            <?php } ?>
									</section>
                <?php } else {
                  echo "Invalid Request";
                } ?>
					<!-- Footer -->
			<div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2022</p>
         </div>	
								</div>

			
				

		</div>

		<!-- Scripts -->
      <script type="text/javascript">
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
      </script>

    
    <script src="../js/script.js"></script>
	</body>
</html>
