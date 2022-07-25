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
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">

  </head>

  <body class = "user">
  	<script type="text/javascript">
  		function viewcontent(){
  			var selectone=document.getElementById("class").value;
  			var schview=document.getElementById("application");
  			if(selectone!="select"){
  				document.getElementById("schid").innerHTML = selectone;
  				schview.style.display = 'block';
  			}
  			else{
  				schview.style.display = 'none';
  			}
  		}
  	</script>
   

      <!-- Header -->
      <div class = "nav">
            <div class="topnav" id="myTopnav">
              <div class="header"><a>Scholarship Application System</a> </div>
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
              <a class="dropdown-btn"> Status
              </a>
              <div class="dropdown-container">
                <a href = "tempSigApplication.php?app=Pending">Pending applications</a>
                <a href = "tempSigApplication.php?app=Approved">Accepted Applicaitons</a>
                <a href = "tempSigApplication.php?app=Rejected">Rejected Applicaitons</a> 
              </div> 
              <a class = "current" href="tempSigHome.php">Home</a>
              <a href="" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>

			<!-- Main -->
				<div class="content">

					
    	<?php try {
         /*If the view button was clicked*/
         if (isset($_POST['view']) and $_POST['view'] == 'View') { ?>
          <h1 style="text-align:center; font-size:25px">Application Details</h1>
        <?php
        $appID = $_POST['appID'];
        $sql = "SELECT * FROM application WHERE applicationID='$appID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
        <table class="table">
            <tr>
                <th style="width:50%"><b>Application ID</b></th>
                <td><?php echo $row['applicationID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>Student ID</b></th>
                <td><?php echo $row['studentID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>Signatory ID</b></th>
                  <td><?php echo $row['sigID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>Scholarship ID</b></th>
                <td><?php echo $row['scholarshipID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>App Date</b></th>
                <td><?php echo $row['appDate']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>App Status</b></th>
                <td><?php echo $row['appstatus']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>verifiedBySignatory</b></th>
                <td><?php echo $row['verifiedBySignatory']; ?></td>
            </tr>
            <tr>
              <th><b>Uploaded Files : </b></th>
              <td>
                <button id="showapp" value="showapp" onclick="viewapp()">Show</button>
                <button id="hideapp" value="hideapp" onclick="hideapp()" style="display: none;">Hide</button>
              </td>
            </tr>
          </table>
          <section id="files" style="display: none;">
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:3%">File Name </th>
                        <th style="width:3%"></th>
                    </tr>
                </thead>
                <tbody>
            <?php
            $schID = $_POST['schID'];
            $studentID = $_POST['studentID'];
            $folder = $studentID . '_' . $schID;
            $dir = "../applications/$folder/";

            // Open a directory, and read its contents
            //is_dir Check whether the specified filename is a directory:
            if (is_dir($dir)) {

                $i = 0;
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($i > 1) { ?>
      						<tr><td><?php echo $file; ?></td><td>
      								<form action="<?php echo $dir .
                  '' .
                  $file; ?>" method="post" target="_blank">
                          <button name="view" value="view">View</button>
      			          </form>
      			      </td>
            <?php }
                        $i += 1;
                    }
                    closedir($dh);
                }
                ?>
      	    <?php
            } else {
                 ?>
          			<script>
          				alert("Error! File View Failed!");
          				location.replace("tempSigApplication.php");
          			</script>
      		  <?php
            }
            ?>
          </tbody></table>
          </section><br>
          <section style="text-align:center">
            <form name="blockform" method="post" action="../backend/sigBlockUnblockApp.php" onsubmit="confirmblock(this,'This will Block corresponding Application.\n Are your Sure?')" >
              <input type="hidden" name="appID" value="<?php echo $appID; ?>">
              <input type="submit"  name="blk_unblk_app" id="blockapp" value="blockapp" <?php if (
                  $row['appstatus'] === 'inactive'
              ) {
                  echo " style = 'color:#fff;display:none'";
              } ?>>
            </form><br>

            <form name="unblockform" action="../backend/sigBlockUnblockApp.php" onsubmit="confirmunblock(this,'This will Unblock corresponding Application.\n Are your Sure?')"  method="post">
              <input type="hidden" name="appID" value="<?php echo $appID; ?>">
              <input type="submit" name="blk_unblk_app" id="unblockapp" value="unblockapp" <?php if (
                  $row['appstatus'] !== 'inactive'
              ) {
                  echo " style = 'color:#fff;display:none;'";
              } ?>>
            </form>
            </section>
            <?php }
        }
        }
     } catch (PDOException $e) {
         echo $e->getMessage();
     } ?>
				<div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2022</p>
         </div>
    </div>
		

		<!-- Scripts -->
    <script type="text/javascript">
    function viewapp(){
      var showapp=document.getElementById("showapp");
      var hideapp=document.getElementById("hideapp");
      var schview=document.getElementById("files");
      schview.style.display = 'block';
      hideapp.style.display = 'inline';
      showapp.style.display = 'none';
    }

    function hideapp(){
      var showapp=document.getElementById("showapp");
      var hideapp=document.getElementById("hideapp");
      var schview=document.getElementById("files");
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

    </script>
      
      <script src="../js/script.js"></script>
	</body>
</html>
