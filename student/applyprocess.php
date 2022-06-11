<?php
session_start();
$_SESSION['selectedAppID'] = 0;

$_SESSION['appList'] = null;

//check validity of the user
$currentUserID = $_SESSION['currentUserID'];
if ($currentUserID == null) {
    header('Location:../index.php');
}

// Connect to database
$conn = new mysqli('localhost', 'scholar', '', 'sms');

// Checks Connection
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
      <!-- Main -->
        <div class="content edit-back">

        <h1><b>SUPPORTING DOCUMENTS</b></h1>         
              <form action="../backend/userdocupload.php" method="post" class = "login" enctype="multipart/form-data">
                  
              <h2>Please Submit all the Documents as mentioned below.</h2>
              <h2><b>NOTE : </b>The documents must be of the format- <u><b>PDF</b></u></h2><br>
                  <label><b>1. <u>Certificates of your previous education( transcript of records, diploma) : </u></b></label>
                  <label>This must contain certified copies of your transcript. Collate into one pdf and upload it HERE(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="transcript" onchange=" return fileValidation('transcript')" ><br>                  
                 <br/>
                  <hr/>
                 <br/><br/>
                  <label><b>2. <u> Letters of recommendation : </u></b></label>
                  <label>This must contain letters of recommendation(Collate into one pdf if you have more than one document) and upload it HERE(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="recommendation" onchange=" return fileValidation('recommendation')" ><br>
                  <br/>
                  <hr/>
                 <br/><br/>
                  <label><b>3. <u> Language certificates (E.g: TOEFL,IELTS) : </u></b></label>
                  <label>This must contain the language certificate. (MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="language" onchange="return fileValidation('language')"><br><br>
                  <br/>
                  <hr/>
                  <br/><br/>
                  <label><b>4. <u> Motivation Letter: </u></b></label>
                  <label>This must contain the language certificate.(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="motivation" onchange="return fileValidation('motivation')"><br><br>
                  <br/>
                  <hr/>
                  <br/><br/>
                  
                  <label><b>5. <u> Resume/Curriculum Vitae : </u></b></label>
                  <label>This must contain the updated Resume.(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="resume" onchange="return fileValidation('resume')"><br><br>
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