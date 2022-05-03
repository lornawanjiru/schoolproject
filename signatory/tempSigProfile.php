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

$getName = "select S.firstName, S.middleName, S.lastName from signatory S where S.sigID = '".$_SESSION['currentUserID']."'";

$nameResult = mysqli_query($conn,$getName);

while($rows9=mysqli_fetch_row($nameResult))
{
foreach ($rows9 as $key => $value)
	{
	 	if($key == 0)
		{
			$_SESSION['currentUserName'] = $value;
		}
		if($key == 1)
		{
			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
		}
	    if($key == 2)
	    {
			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . ". " . $value;
		}
	}
}

  $firstName = $lastName = $middleName = $position =  $organization = $phonenumber = NULL;
  //Get User Details
  $sql = "SELECT * FROM signatory WHERE sigID = '".$currentUserID."'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    $upMail = $row["upMail"];
    $firstName = $row["firstName"];
    $lastName = $row["lastName"];
    $middleName = $row["middleName"];
    $phonenumber = $row["phonenumber"];
    $organization = $row['organization'];
    $position = $row["position"];
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


      <!-- Main -->
        
              <!-- Content -->
                <div class="content">
                 

                  <h1><b >User Profile</b></h1>
                            <!-- Compare user details -->
                        <div id="display">
                          <form method="post" action="../backend/sigdata.php" class="login" role="form">

                            <?php if($upMail==NULL || $upMail==""){} else{ ?>
                              <div class="row">
                                <label class="col-10" for="upMail">Email:</label>
                                <div class="col-90">
                                  <input type="text" class="form-control" value="<?php echo $upMail;?>" disabled>
                                </div>
                              </div>
                            <?php } ?>

                            <?php if($lastName==NULL || $lastName==""){} else{ ?>
                              <div class="row">
                                <label class="col-10" for="lastName">Last Name:</label>
                                <div class="col-90">
                                  <input type="text" class="form-control" value="<?php echo $lastName;?>" disabled>
                                </div>
                              </div>
                            <?php } ?>

                            <?php if($firstName ==NULL || $firstName ==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="firstName">First Name:</label>
                              <div class="col-90">
                                <input type="text" class="form-control" value="<?php echo $firstName?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($middleName ==NULL || $middleName==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="middleName">Middle Name:</label>
                              <div class="col-90">
                                <input type="text" class="form-control" value="<?php echo $middleName?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($position==NULL || $position==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="position">Position:</label>
                              <div class="col-90">
                                <input type="text" class="form-control" value="<?php echo $position ?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($phonenumber ==NULL || $phonenumber==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="phonenumber">Contact Number:</label>
                              <div class="col-90">
                                <input type="text" class="form-control" value="<?php echo $phonenumber?>" disabled>
                              </div>
                            </div>
                            <?php } ?>


                          </form>
                          <button id="showDivButton" style="margin:2% 0% 3% 42%;" type="button" class="btn btn-primary">Edit User Profile</button>
                      </div>

                      <div id="editDiv" style="display:none">
                          <form method="POST" action="../backend/sigdata.php" class="login" role="form">
                              <div class="row">
                                <label class="col-10" for="upMail">Email:</label>
                                <div class="col-90">
                                  <input type="text" class="form-control" value="<?php echo $upMail;?>" disabled>
                                </div>
                              </div>
                              <div class="row">
                                <label class="col-10" for="lastName">Last Name:</label>
                                <div class="col-90">
                                  <input type="text" name="lastName" class="form-control" value="<?php echo $lastName;?>">
                                </div>
                              </div>
                              <div class="row">
                              <label class="col-10" for="firstName">First Name:</label>
                              <div class="col-90">
                                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName?>" >
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="middleName">Middle Name:</label>
                              <div class="col-90">
                                <input type="text" name="middlename" class="form-control" value="<?php echo $middleName?>">
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="position">Position:</label>
                              <div class="col-90">
                                <input type="text" name="position" class="form-control" value="<?php echo $position ?>">
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="contactNo">Contact Number:</label>
                              <div class="col-90">
                                <input type="text" name="phonenumber" class="form-control" value="<?php echo $phonenumber?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" style="margin:2% 0% 3% 42%;">Submit</button>
                              </div>
                            </div>
                          </form>

                      </div>
                      <div class="footer">
                        <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
                        <p>copyright &copy;2021</p>
                    </div>
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
  	</script>
    
    <script src="../js/script.js"></script>
 


<!-- Display Div Script -->
    <script type="text/javascript">
      var button = document.getElementById('showDivButton'); // Assumes element with id='button'
      button.onclick = function() {
          var div = document.getElementById('editDiv');
          var disp = document.getElementById('display');
          if (div.style.display !== 'none') {
              div.style.display = 'none';
          }
          else {
              div.style.display = 'block';
              disp.style.display = 'none';
          }
      };
    </script>

  </body>
</html>