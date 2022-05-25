<?php

session_start();

// Connect to database
$conn = new mysqli('localhost', 'scholar', '', 'sms');

// Checks Connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
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


			<!-- Main -->
      <div class="content">
              <span style="text-align:center">
                <br><h1 style="font-size : 28px"><strong><?php echo $_POST[
                    'schname'
                ]; ?> </strong></h1>
                <hr style=" height: 1px;color: red;background-color: grey;border: none;">
                <h1><strong> Scholarship ID :  <?php echo $_POST[
                    'schID'
                ]; ?> </strong></h1>
  							<h1><strong>Signatory ID :  <?php echo $_POST[
             'sigID'
         ]; ?> </strong></h1></span><hr style=" height: 1px;color: red;background-color: grey;border: none;">
            <?php try {
                $adminapproval = null;
                $status = null;
                /*If the view button was clicked*/
                if ($_POST['view'] == 'View') {

                    $schid = $_POST['schID'];
                    $sql = "SELECT adminapproval,schstatus FROM scholarship WHERE scholarshipID = $schid";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $adminapproval = $row['adminapproval'];
                            $status = $row['schstatus'];
                        }
                    }
                    ($xml = simplexml_load_file(
                        '../backend/scholarship_data.xml'
                    )) or die('Error: Cannot create object');
                    foreach ($xml->children() as $sch) {
                        if ($sch['scholarshipID'] == $schid) {

                            $schID = $sch->sigID;
                            $schname = $sch->schname;
                            $schlocation = $sch->schlocation;
                            
                            $degree = $sch->degree;
                            $gender = $sch->gender;
                            $religion = $sch->religion;
                            $scholarshipp = $sch->sch;
                            $appDeadline = $sch->appDeadline;
                            $granteesNum = $sch->granteesNum;
                            $funding = $sch->funding;
                            $description = $sch->description;
                            $eligibility = $sch->eligibility;
                            $benefits = $sch->benefits;
                            $apply = $sch->apply;
                            $links = $sch->links;
                            $contact = $sch->contact;
                            ?>

                       
                          <section style="text-align: justify;">
                            <h1><b>What is <?php echo $schname; ?> ?</b></h1>
                            <p><?php echo $description; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Who is offering the scholarship?</b></h1>
                            <p><?php
                            //university or organization name
                            ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Documents required?</b></h1>
                            <p><?php
                            //university or organization name
                            ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Who can apply for the scholarship?</b></h1>
                            <p><?php echo $eligibility; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>What are the benifits?</b></h1>
                            <p><?php echo $benefits; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>How can you apply?</b></h1>
                            <p><?php echo $apply; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Applicants must be Located at? </b></h1>
                            <p><?php echo $schlocation; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Applicants HomeTown must be ?</b></h1>
                            <p><?php echo $schlocationfrom; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Important Links</b></h1>
                            <p><?php echo $links; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Contact Details</b></h1>
                            <p><?php echo $contact; ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                          <section>
                            <h1><b>Admin Approval</b></h1>
                            <p><?php echo $adminapproval;
                        }
                    }
                    $conn->close();
                    ?></p>
                          </section>
                          <br><hr><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
                       

              <?php
              $sigID = $_POST['sigID'];
              $schname = $_POST['schname'];
              $folder = $schid;
              $dir = "../scholarship/$folder/";
              ?>
              <br><h1><b>Files : </b></h1>
							<table class="table table-bordered">
                  <thead>
                  	<tr>
                      <th style="width:3%">File Name </th>
                      <th style="width:3%"></th>
                    </tr>
                  </thead>
                  <tbody>
  	<?php // Open a directory, and read its contents
   if (is_dir($dir)) {

       $i = 0;
       if ($dh = opendir($dir)) {
           while (($file = readdir($dh)) !== false) {
               if ($i > 1) { ?>
						<tr>
							<td>
								<?php echo $file; ?>
							</td>
							<td>
								<form action="<?php echo $dir . '' . $file; ?>" method="post" target="_blank">
                    <button name="view" value="view">View</button>
			          </form>
			         </td>
    <?php }
               $i += 1;
           }
           closedir($dh);
       }
       ?>
					</tbody>
        </table>
	<?php
   } else {
        ?>
			<script>
				alert("Error! File View Failed!");
				location.replace("tempScholarship.php");
			</script>
		<?php
   } ?>
    <br><br><hr style=" height: 1px;color: red;background-color: grey;border: none;">
    <div class="wrapper">
      <form method="post" style="display:inline;">
        <input type="hidden" name="schID" value="<?php echo $schid; ?>">
        <input type="submit" name="accrej" value="Accept" formaction="../backend/adminAcceptReject.php" style="margin-left:12%">
        <input type="submit" name="accrej" value="Reject" formaction="../backend/adminAcceptReject.php" style="margin-left:10%">
      </form>
      <br><br><br>
      <form name="blockform"  action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmblock(this,'This will Block the Scholarship and corresponding Applications.\n This wont Block the corresponding Signatory.\n Are your Sure?')">
        <input type="hidden" name="schID" value="<?php echo $schid; ?>">
        <input type="submit"  name="blk_unblk" id="blockSchbtn" value="blockScholarship" <?php if (
            $status === 'inactive'
        ) {
            echo " style = 'color:#fff;display:none'";
        } else {
            echo "style = 'margin-left:32%;'";
        } ?>>
      </form>
      <form name="unblockform" action="../backend/adminBlockUnblockSch.php" onsubmit="confirmunblock(this,'This will Unblock the Scholarships and corresponding Applications.\n This wont Unblock the corresponding Signatory.\n Are your Sure?')"  method="post">
        <input type="hidden" name="schID" value="<?php echo $schid; ?>">
        <input type="submit" name="blk_unblk" id="unblockSchbtn" value="unblockScholarship" <?php if (
            $status === 'active'
        ) {
            echo " style = 'color:#fff;display:none;'";
        } else {
            echo "style = 'margin-left:32%;'";
        } ?>>
      </form>
      <form action="tempScholarship.php" method="post">
         <br><input type="submit" style="margin-left:32%"  value="<< Go Back">
      </form>
      <div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2022</p>
         </div>
  </div>
    <?php
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } ?>
		

		</div>

		<!-- Scripts -->
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
