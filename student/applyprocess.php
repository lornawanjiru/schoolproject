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
    $conn = new mysqli("localhost","scholar","","sms");

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
      <link href="../css/main.css" rel="stylesheet">
      <link href="../css/general.css" rel="stylesheet">
  </head>
  <body class = "user">
      <script type="text/javascript">
          function fileValidation(name){
              var fileInput = document.getElementById(name);
              var filePath = fileInput.value;
              var allowedExtensions = /(\.pdf)$/i;  //  /(\.jpg|\.jpeg|\.png|\.gif)$/i
              if(!allowedExtensions.exec(filePath)){
                  alert('Please upload file having extensions .pdf only.');
                  fileInput.value = '';
                  return false;
              }else if(fileInput.files[0].size > 8000000){
                alert('File size too large');
                  fileInput.value = '';
                  return false;
              }
              else{ }
          }
          </script>

      <!-- Header -->
      <div class = "nav">
            <div class="topnav" id="myTopnav">
              <div class="header"><a >Scholarship Application System</a> </div>
              <div class="banner desktop-view">
                  <div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample3.jpg" alt="profile-sample3" class="profile" />
                  </div>
                  <div>
                    <h2> Hello, <?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?>. </h2>
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
              <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="../images/menu.png" alt="" />
                </a>
              </div>  
            </div>
          </div>

      <!-- Main -->
        <div class="content">

          <div class="special container">            
            <h2>SUPPORTING DOCUMENTS</h2>
          </div>

        
              <h2>Please Submit all the Documents as mentioned below.</h2>
              <h2><b>NOTE : </b>The documents must be of the format- <u><b>PDF</b></u></h2><br>
              <form action="../backend/userdocupload.php" method="post" class = "login" enctype="multipart/form-data">

                  <label><b>1. <u>Aadhar Card : </u></b></label>
                  <label>This must contain two copies of AADHAR Card, both front and back side copy.Collate into one pdf and upload it HERE(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="aadharcard" onchange=" return fileValidation('aadharcard')" required><br>

                  <!-- <hr> not working -->
                  <label>_____________________________________________________________________________________________________________________________________</label><br><br>

                  <label><b>2. <u> Fee Receipt : </u></b></label>
                  <label>This must contain Receipt of the fees of entire year(Collate into one pdf if you have more than one document) and upload it HERE(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="feereceipt" onchange=" return fileValidation('feereceipt')" required><br>

                  <!-- <hr> not working -->
                  <label>_____________________________________________________________________________________________________________________________________</label><br><br>

                  <label><b>3. <u> First Page of Saving Account Passbook : </u></b></label>
                  <label>This must contain first page of your saving account passbook.Deatils such as your fullname, IFSC code, bank account number, branch name must be clearly visible in the document (MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="passbook" onchange="return fileValidation('passbook')" required><br><br>

                  <input type="submit" name="apply" value="Apply >>">

              </form>
            <div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2022</p>
         </div>
        </div>
        <!-- Footer -->
        
    </div>

     
      <script src="../js/script.js"></script>

  </body>
</html>