<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;

  $_SESSION['appList'] = NULL;

  //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
  }

  // Connect to database
  $conn = new mysqli("localhost","scholar", "","sms");

  // Checks Connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

  $getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";

  $nameResult = mysqli_query($conn,$getName);

  // Get every row of the table formed from the query
    while($rows9=mysqli_fetch_row($nameResult)){
      foreach ($rows9 as $key => $value){
	 	    if($key == 0){
          $_SESSION['currentUserName'] = $value;
		    }
    		if($key == 1){
    			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
    		}
        if($key == 2){
          $_SESSION['currentUserName'] = $_SESSION['currentUserName'] . ". " . $value;
  		  }
	    }
    }
    $conn->close();
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
                    <h2> Hello, Lorna Wanjiru Muchangi. </h2>
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
        

          

          <!-- One -->
          <?php
            $conn = new mysqli("localhost","root","","sms");
            $schid=$_GET['sch'];
            $sigID = NULL;
            $xml=simplexml_load_file("../backend/scholarship_data.xml") or die("Error: Cannot create object");
            foreach($xml->children() as $sch){
                if($sch['scholarshipID'] == $schid){
                  $sigID = $sch->sigID;
                  $schname = $sch->schname;
                  $schlocation = $sch->schlocation;
                  $schlocationfrom = $sch->schlocationfrom;
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
           

              <!-- Content -->
                <div class="content">
                  <section style="text-align: justify;">
                    <h1><b>What is <?php echo $schname; ?> ?</b></h1>
                    <p><?php echo $description; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>Who can apply for the scholarship?</b></h1>
                    <p><?php echo $eligibility; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>What are the benifits?</b></h1>
                    <p><?php echo $benefits; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>How can you apply?</b></h1>
                    <p><?php echo $apply; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>What are the documents required?</b></h1>
                    <p><?php //echo $row["documents"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>What are the selection criteria?</b></h1>
                    <p><?php //echo $row["selection"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>Important Links</b></h1>
                    <p><?php echo $links; ?></p>
                  </section>
                  <br><hr><br>
                  <section>
                    <h1><b>Contact Details</b></h1>
                    <p><?php echo $contact;  ?></p>
                  </section>
                  <br><hr><br>
                  <form action="apply.php" method="post">
                      <?php $_SESSION['schid']=$schid; ?>
                      <input type="disabled" name="sigID" value = "<?php echo $sigID;?>">
                      <input type="submit" name="apply" value="Apply >>">
                  </form>
                  <?php } }  $conn->close(); ?>
                   <!-- Footer -->
                  <div class="footer">
                      <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
                      <p>copyright &copy;2021</p>
                  </div>
                </div>

           
       
   

     
      <script src="../js/script.js"></script>

  </body>
</html>
