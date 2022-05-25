<?php

session_start();

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
              var allowedExtensions = /(\.pdf)$/i;
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


			
		<div class="content">
			
				<header>
					<h2 style="padding-left: 36%;"><strong><u>Add your Scholarship</u></strong></h2>
				</header>

				<form method = "post" class = "login"name = "scholarshiplist" id = "scholarshiplist" action = "../backend/adminAddDelSch.php" enctype="multipart/form-data">

					<label><strong>Scholarship Name</strong></label><br>
					<label style="font-size: 15px;">This will be displayed and used for searching your scholarship</label>
					<br><input type = "text" name = "schname" placeholder="Eg:Joint Japan/World Bank Graduate Scholarship Program 2019" >
					<br><br>

					<label><strong>Locations</strong></label><br>
					<label style="font-size: 15px;">In which states or regions do the students need to study to be able to receive the scholarship?</label>
					<br><input type = "text" name = "schlocation" placeholder="Select one or multiple">
					<br><br>

					<!-- <label><strong>Locations From</strong></label><br>
					<label style="font-size: 15px;">Is this scholarship specific for students from a specific state or region?</label>
					<br><input type = "text" name = "schlocationfrom" placeholder="Select one or multiple">
					<br><br> -->

					<label><strong>Degrees</strong></label><br>
					<label style="font-size: 15px;">This is a scholarship to study a ... (check all that apply)</label><br>
					<select name="educationlevel" style="padding-top: 10px;padding-bottom: 10px; padding-left: 5%">
						<option value="select" selected>Select</option>
						  <option value="highschool">High school</option>
                          <option value="diploma">Diploma</option>
                          <option value="bachelors">Bachelors</option>
                          <option value="masters">Masters</option>
                          <option value="phd">PhD</option>
					</select>
					<br><br><br>

					<label><strong>Gender</strong></label><br>
					<label style="font-size: 15px;">This is a scholarship for a particular gender ...</label><br>
					<select name="gender" style="padding-top: 10px;padding-bottom: 10px; padding-left: 5%">
						<option value="select" selected>Select</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="non-binary">Non-binary</option>
						<option value="transgender">Transgender</option>
						<option value="any">Any</option>
					</select>
					<br><br><br>

					<label><strong>Ethnic </strong></label><br>
					<label style="font-size: 15px;">This is a scholarship for a particular ethnic ...</label><br>
					<input type="checkbox" name="ethnic[]" value="americanindian">American Indian<br>
					<input type="checkbox" name="ethnic[]" value="asian">Asian<br>
					<input type="checkbox" name="ethnic[]" value="black">Black/African American<br>
					<input type="checkbox" name="ethnic[]" value="latino">Latino/ Hispanics<br>
					<input type="checkbox" name="ethnic[]" value="white">White<br>
					<input type="checkbox" name="ethnic[]" value="hawaiian">Native Hawaiian/Pacific Islander<br>
					<br><br>

					<label><strong>Scholarship type</strong></label><br>
					<label style="font-size: 15px;">Selct any Type of Scholarship from Below ...</label><br>
					<select name="scholarship" style="padding-top: 10px;padding-bottom: 10px; padding-left: 10%">
						<option value="select" selected>Select</option>
						<option value="merit">Athletic Based</option>
                          <option value="neddy">Needy based</option>
                          <option value="creative">Creative Development</option>
                          <option value="cultural">Community services</option>
						</select>
					<br><br><br>
					<label><strong>Career field</strong></label><br>
					<label style="font-size: 15px;">Selct any Type of career field from Below ...</label><br>
					<select name="careerfield" style="padding-top: 10px;padding-bottom: 10px; padding-left: 10%">
						<option value="select" selected>Select</option>
						<option value="agriculture">Agriculture</option>
                          <option value="arts">Arts</option>
                          <option value="biologicalsciences">Biological Sciences</option>
                          <option value="administration">Administration</option>
                          <option value="dentistry">Dentistry</option>
                          <option value="education">Education</option>
                          <option value="engineering">Engineering</option>
                          <option value="environmentscience">Environement Science</option>
                          <option value="law">Law</option>
                          <option value="medicalscience">Medical Science</option>
                          <option value="veterinary">Veterinary</option>
                          <option value="socialscience">Social Science</option>
						</select>
					<br><br><br>
					<label><strong>Application Deadline:(yyyy/mm/dd)</strong></label><br>
					<label style="font-size: 15px;">What is the deadline of application?</label>
					<br><input type = "text" name = "appdeadline">
					<br><br>

					<label><strong>Number of Applications maximum allowed</strong></label><br>
					<label style="font-size: 15px;">You can limit the number of applicants[This wont be displayed]</label>
					<br><input type = "text" name = "granteesNum">
					<br><br>

					<label><strong>Funding</strong></label><br>
					<label style="font-size: 15px;">Short description about funding. e.g. "$5000,-" or "100% tuition fee"</label>
					<br><input type = "text" name = "funding">
					<br><br>

					<label><strong>Description</strong></label><br>
					<label style="font-size: 15px;">Give a general description of the scholarship. This is the first text that users will read.</label>
					<br><textarea name = "description" rows="5"></textarea>
					<br><br>

					<label><strong>Eligibility</strong></label><br>
					<label style="font-size: 15px;">What students are eligible? Are there any requirements?</label>
					<br><textarea name = "eligibility" rows="5"></textarea>
					<br><br>

					<label><strong>Benefits</strong></label><br>
					<label style="font-size: 15px;">When a student gets the scholarship, what are their benefits?</label>
					<br><textarea name = "benefits" rows="5"></textarea>
					<br><br>

					<label><strong>How can you apply ?</strong></label><br>
					<label style="font-size: 15px;">How should a student apply? What are the requirements for application?</label>
					<br><textarea name = "apply" rows="5"></textarea>
					<br><br>

					<label><strong>Important Links</strong></label><br>
					<label style="font-size: 15px;">Provide links for your organization and scholarship if any.</label>
					<br><textarea name = "links" rows="5"></textarea>
					<br><br>

					<label><strong>Contact Details</strong></label><br>
					<label style="font-size: 15px;">Email, website, contact info ...</label>
					<br><textarea name = "contact" rows="5"></textarea>
					<br><br>

						<label><strong>Upload Document</strong></label>&nbsp;&nbsp;<label style="font-size: 15px;color: red; ">* This is compulsory.</label><br>
					<label style="font-size: 15px;">Provide a soft copy of your scholarship so as to validate your scholarship.</label>
					<br>
					<input type="file" name="validate" id="validate" onchange=" return fileValidation('validate')" required><br>

					<br><br>
                    <input type="hidden" name="previous_adminapproval" value="Pending">
					<input type="hidden" name="adminapproval" value="Pending">

					<div class = "text-center">
						<input type = "submit" name = "deladd" value = "Submit Scholarship >">
					</div>
				</form>

				<br>
				<div class = "text-center">
					<form action = "tempSigScholarship.php">
						<input type = "submit" value = "Back">
					</form>
				</div>
			</div>
			
		
		</div>
       
					

	
    <script src="../js/script.js"></script>


    <script type="text/javascript">
    function selectAll(){
      sel = document.getElementById("selSigList");
      for (var i = 0; i < sel.options.length; i++){
        sel.options[i].selected = true;
      }
    }

    </script>
  </body>
</html>
