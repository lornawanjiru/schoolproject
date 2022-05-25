<?php
/* Start a session so that other files can access these variables */
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
       </div> 


			<!-- Main -->
			<div class="content">
				<!-- One -->
			

					<!-- Content -->
					<div class="scholarship-content">
                            <div class="form-group">
                            <?php
                            $sql = "SELECT * FROM application AS A JOIN scholarship AS S on A.scholarshipID=S.scholarshipID where studentID=$currentUserID";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) { ?>
                              <label style="margin-left: 30%"><h2><b>Select Your Application</b></h2></label>
                              <div class="col-sm-10">
                                
                                  <form action="<?php echo htmlspecialchars(
                                      $_SERVER['PHP_SELF']
                                  ); ?>" method="POST" name="login" >
                                    <div style="float:inherit" name="class" id="class" style="padding-top:2%;padding-bottom:2%;padding-left:2%;display:block;">
                                    <option value="select" selected>Select</option>
                            	<?php while ($row = $result->fetch_assoc()) {

                                 $tempschid = $row['scholarshipID'];
                                 $tempschname = $row['schname'];
                                 ?>
                                    	<option value="<?php echo $tempschid; ?>"><?php echo $tempschname; ?></option>
                                <?php
                             }} else { ?>
                                  <h1>You Have Not Applied To Any Scholarship</h1>
                                  <form name="gotoapply" action="tempUserApply.php">
                                    <input type="submit" value="Search For Scholarship" />
                                  </form>
                                <?php }
                            ?>
                                </div>
                             <form>
                                <input type="submit" id="apply" name="apply" value="Select Scholarship >>" style="margin-top:2%;float:inherit">
                                <input type="submit" id="showall" name="showall" value="<Show all>" style="margin-left:2%;margin-top:2%;float:inherit">
                              </form>
                            
                              </div>
                    
                            <br><br><br><br><br>
                            <?php if (
                                strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'
                            ) {
                                //DISPLAYING ALL APPS
                                if (
                                    isset($_POST['showall']) and
                                    $_POST['showall'] == '<Show all>'
                                ) { ?>

                                <div id="application">
                                  <h1><strong>Your Scholarship</strong></h1>
                                  	<table class="table table-bordered">
                                    	<thead>
                                        	<tr>
                                          		<th style="width:10%">Application ID</th>
                                          		<th style="width:40%">Scholarship</th>
                                          		<th style="width:10%">Signatory Approval</th>
                                          		<th style="width:10%">App Status</th>
                                        	</tr>
                                    	</thead>
                                    	<tbody>
                                        <?php
                                        $queryScholarship = "SELECT A.applicationID, S.schname, A.verifiedBySignatory, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $currentUserID";
                                        $qSchoResult = mysqli_query(
                                            $conn,
                                            $queryScholarship
                                        );

                                        while (
                                            $rows = mysqli_fetch_row(
                                                $qSchoResult
                                            )
                                        ) {
                                            foreach ($rows as $key => $value) {
                                                if (
                                                    $key == 0
                                                ) { ?> <tr ><td> <?php
 echo $value;
 $_SESSION['appID'] = $value;
 }
                                                if (
                                                    $key == 1
                                                ) { ?> </td><td> <?php echo $value;}
                                                if (
                                                    $key == 2
                                                ) { ?> </td><td> <?php echo $value;}
                                                if ($key == 3) { ?>
                                              </td><td><?php echo $value; ?></td></tr><?php }
                                            }
                                        }
                                        ?>
                                  	</tbody>
                                	</table>
								</div> 
                                <?php } else {
                                    // Scholarship Based Apps
                                    ?>
                            <div id="application">
                            	<?php if ($_POST['class'] != 'select') {
                                 $id = $_POST['class']; ?>
                                <h1><strong>Your Scholarship</strong></h1>
                                	<table class="table table-bordered">
                                  	<thead>
                                      	<tr>
                                        		<th style="width:10%">Application ID</th>
                                        		<th style="width:40%">Scholarship</th>
                                        		<th style="width:10%">Signatory Approval</th>
                                        		<th style="width:10%">App Status</th>
                                      	</tr>
                                  	</thead>
                                  	<tbody>
                                      	<?php
                                       $queryScholarship = "SELECT A.applicationID, S.schname, A.verifiedBySignatory, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $currentUserID AND A.scholarshipID=$id";
                                       $qSchoResult = mysqli_query(
                                           $conn,
                                           $queryScholarship
                                       );

                                       while (
                                           $rows = mysqli_fetch_row(
                                               $qSchoResult
                                           )
                                       ) {
                                           foreach ($rows as $key => $value) {
                                               if (
                                                   $key == 0
                                               ) { ?> <tr ><td> <?php
 echo $value;
 $_SESSION['appID'] = $value;
 }
                                               if (
                                                   $key == 1
                                               ) { ?> </td><td> <?php echo $value;}
                                               if (
                                                   $key == 2
                                               ) { ?> </td><td> <?php echo $value;}
                                               if ($key == 3) { ?>
                                              </td><td><?php echo $value; ?></td></tr><?php }
                                           }
                                       }
                                       ?>
                                  	</tbody>
                                	</table>

                          <?php
                             } else {
                                  ?>
                            <script type="text/javascript">
                              alert('Please Select A Scholarship');
                              history.back();
                            </script>
                          <?php
                             } ?>
						  </div>
                       <?php }
                            } ?>
					
			<div class="footer">
				<h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
				<p>copyright &copy;2021</p>
             </div>
			 </div>
            </div>
			</div>
		</div>

		<!-- Scripts -->
      
      <script src="js/script.js"></script>


	</body>
</html>
