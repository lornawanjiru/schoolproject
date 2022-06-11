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
		
								<div class="content admin edit-back">
									<section>
                    <h1 >Signatory Details</h1>
                    <?php
                    $conn = new mysqli('localhost', 'scholar', '', 'sms');
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }
                    $sql = 'SELECT * FROM signatory';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) { ?>
                        <table class="table table-bordered default login">
                          <thead>
                              <tr>
                                  <th style="width:10%">Signatory ID</th>
                                  <th style="width:16%">Email ID</th>
                                  <th style="width:20%">Name</th>
                                  <th style="width:20%">Organization/University</th>
                                  <th style="width:10%">Status</th>
                                  <th style="width:7%"></th>
                                  <th style="width:7%"></th>
                                  <th style="width:7%"></th>
                              </tr>
                          </thead>
                          <tbody>
                        <?php while ($row = $result->fetch_assoc()) {

                            $sigID = $row['sigID'];
                            $email = $row['upMail'];
                            $name = $row['firstName'] . ' ' . $row['lastName'];
                            if ($name == null || $name == '') {
                                $name = 'NULL';
                            }
                            $org = $row['organization'];
                            $con = $row['phonenumber'];
                            $status = $row['status'];
                            ?>
                              <tr>
                                <td><?php echo $sigID; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $org; ?></td>
                                <td><?php echo $status; ?></td>
                                <td>
                                  <form action="adminShowUser.php" method="post">
                                    <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                                    <button name="showUser" value="showSig">View</button>
                                  </form>
                                </td>
                                <td>
                                  <form name="blockform" method="post" onsubmit="confirmblock(this)" action="../backend/adminBlockUser.php">
                                    <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                                    <button  name="blockUser" id="blockUserbtn" value="blockSig" <?php if (
                                        $row['status'] === 'inactive'
                                    ) {
                                        echo 'disabled';
                                        echo " style = 'color:#fff'";
                                    } ?>>Block</button>
                                  </form>
                                </td>
                                <td>
                                  <form name="unblockform" action="../backend/adminUnblockUser.php" onsubmit="confirmunblock(this)"  method="post">
                                    <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                                    <button name="unblockUser" id="unblockUserbtn" value="unblockSig" <?php if (
                                        $row['status'] === 'active'
                                    ) {
                                        echo 'disabled';
                                        echo " style = 'color:#fff'";
                                    } ?>>UnBlock</button>
                                  </form>
                                </td>
                              </tr>
                          <?php
                        } ?>
                        </tbody>
                      </table>
                      <?php } else {echo 'No result';}
                    $conn->close();
                    ?>

									</section>
                  <!-- Footer -->
                  <div class="footer">
                    <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
                    <p>copyright &copy;2022</p>
                </div>	
								</div>
					
		</div>

		<!-- Scripts -->

    <script type="text/javascript">
      function confirmblock(form){
        if(confirm("This will Block Signatory, the Scholarships corresponding to them as well as All Applications.\n Are your Sure?")){
          document.blockform.submit();
        } else{
          event.preventDefault();
        }
      }
      function confirmunblock(form){
        if(confirm("This will Unblock Signatory, the Scholarships corresponding to them as well as All Applications.\n Are your Sure?")){
          document.unblockform.submit();
        } else{
          event.preventDefault();
        }
      }
    </script>
      
      <script src="../js/script.js"></script>
	</body>
</html>
