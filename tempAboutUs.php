<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;

  $_SESSION['appList'] = NULL;

  //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
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
?>

<!DOCTYPE HTML>
<html>
  <head>


      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">


      

      <!-- Custom CSS -->
      <link href="css/main.css" rel="stylesheet">
      
  </head>

  <body class = "no-sidebar">
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header">
          <h1 id = "logo"><a href = "tempUserHome.php">Scholarships <span>that matter</span></a></h1>
          <nav id = "nav">
            <ul>
              <li><a href = "tempUserHome.php">Home</a></li>
              <li><a href = "tempUserProfile.php">User Profile</a></li>
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li><a href = "tempUserView.php">View Scholarship Status</a></li>
              <li><?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?></li>
              <li><a href = "backend/logout.php" class = "button special">Logout</a></li>
            </ul>
          </nav>
        </header>

    <!--image-->

     
        <script src="js/main.js"></script>
  </body>
</html>
