<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
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

    //Getting Name
    $getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";
    $nameResult = mysqli_query($conn,$getName);
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


  $upMail=$firstName=$lastName=$currentlocation=$gender=$phonenumber=$specialization=$level=$results= NULL;
  //Get User Details
  $sql = "SELECT * FROM student WHERE studentID = '".$_SESSION['currentUserID']."'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    $upMail = $row["upMail"];
    $firstName = $row["firstName"];
    $middleName = $row["middleName"];
    $lastName = $row["lastName"]; 
    $currentlocation = $row["currentlocation"];
    $gender = $row["gender"];
    $phonenumber = $row["phonenumber"];
    $specialization = $row["specialization"];
    $level = $row["level"];
    $results = $row["results"];
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


              <!-- Content -->
                <div class="content">
                    <h1>User Profile</h1>
                            <!-- Compare user details -->
                      <div id="display" class="login">
                          <form method="post" action="../backend/userdata.php" class="form-horizontal" role="form">

                            <?php if($upMail==NULL || $upMail==""){} else{ ?>
                              <div class="row">
                                <div class="col-10" for="upMail">Email:</div>
                                <div class="col-90">
                                  <input type="text"  class="form-control" value="<?php echo $upMail;?>" disabled>
                                </div>
                              </div>
                            <?php } ?>

                           

                            <?php if($firstName ==NULL || $firstName ==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="firstName">First Name:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $firstName?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($middleName ==NULL || $middleName==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="middleName">Middle Name:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $middleName?>" disabled>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if($lastName==NULL || $lastName==""){} else{ ?>
                              <div class="row">
                                <label class="col-10" for="lastName">Last Name:</label>
                                <div class="col-90">
                                  <input type="text"  class="form-control" value="<?php echo $lastName;?>" disabled>
                                </div>
                              </div>
                            <?php } ?>
                            <?php if($currentlocation==NULL || $currentlocation==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="currentlocation">Current Location:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $currentlocation?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($gender==NULL || $gender==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="gender">Gender:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $gender?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($phonenumber==NULL || $phonenumber==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="phonenumber">Phonenumber</label>:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $phonenumber?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($specialization==NULL || $specialization==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="specialization">Specialization:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $specialization?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($level==NULL || $level==""){} else{ ?>
                            <div class="form-group">
                              <label class="col-10" for="level">Level:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $level?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($results==NULL || $results==""){} else{ ?>
                            <div class="row">
                              <label class="col-10" for="results">Results:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $results?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                          </form>
                          <button id="showDivButton" type="button" class="btn btn-primary">Edit User Profile</button>
                      </div>

                      <div id="editDiv" class="login" style="display:none">
                          <form method="POST" action="../backend/userdata.php" class="form-horizontal" role="form">
                             <div class="row">
                                <div class="col-10" for="upMail">Email:</div>
                                <div class="col-90">
                                  <input type="text"  class="form-control" value="<?php echo $upMail;?>" disabled>
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
                                <input type="text" name="middleName" class="form-control" value="<?php echo $middleName?>">
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="currentlocation">Current Location:</label>
                              <div class="col-90">
                                <input type="text" name="currentlocation" class="form-control" value="<?php echo $currentlocation?>" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-10" for="gender">Gender:</label>
                              <div class="col-sm-10">
                                <input type="text" name="gender" class="form-control" name="gender" value="<?php echo $gender?>">
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="phonenumber">Phonenumber</label>:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $phonenumber?>">
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="specialization">Specialization:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $specialization?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-10" for="level">Level:</label>
                              <div class="col-90">
                                <input type="text"  class="form-control" value="<?php echo $level?>">
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-10" for="results">Results:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $results?>">
                              </div>
                            </div>
                          

                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" style="margin:2% 0% 3% 42%;">Submit</button>
                              </div>
                            </div>
                          </form>

                      </div>
                
                  <!-- Footer -->
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
