<?php
/* Start a session so that other files can access these variables */
// <!-- The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL.
// This function returns true if the variable exists and is not NULL, otherwise it returns false.
// Note: If multiple variables are supplied, then this function will return true only if all of the variables are set.
// Tip: A variable can be unset with the unset() function. -->
// <!-- Session variables stores user information to be used across multiple pages (e.g. username etc).
//  By default, session variables last until the user closes the browser. 
// It holds information about one user
// A session is started with the session_start() function.
// Session variables are set with the PHP global variable: $_SESSION.-->
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
//The fetch_row() / mysqli_fetch_row() function fetches one row from a result-set and returns it as an enumerated array.
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


          <?php // EDIT SCHOLARSHIP QUERY CHECK

          try {
              // Connect to database
              $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

              // Checks Connection
              if ($conn->connect_error) {
                  die('Connection failed: ' . $conn->connect_error);
              }
              $schname = $schlocation =  $educationlevel = $gender = $careerfield = $scholarshipp = $appdeadline = null;
              $granteesNum = $funding = $description = $eligibility = $benefits = $apply = $links = $contact = $adminapproval = null;
              if (isset($_POST['view'])) {
                  $schID = $_POST['scholarshipID'];
                            //A JOIN clause is used to combine rows from two or more tables, based on a related column between them.
                            // (INNER) JOIN: Returns records that have matching values in both tables
                            // LEFT (OUTER) JOIN: Returns all records from the left table, and the matched records from the right table
                            // RIGHT (OUTER) JOIN: Returns all records from the right table, and the matched records from the left table
                            // FULL (OUTER) JOIN: Returns all records when there is a match in either left or right table
                            //AS is used to assign a new name temporarily to a table column or even table.
                            //WHERE is used to compare the given value with the field value available in table.
                  $sql = "SELECT * FROM scholarship WHERE scholarshipID = $schID";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    //associative array are arrays that use named keys that assign to them.
                      while ($row = $result->fetch_assoc()) {
                          $schname = $row['schname'];
                          $schlocation = $row['schlocation'];
                          
                          $educationlevel = $row['educationlevel'];
                          $gender = $row['gender'];
                          
                          $scholarshipp = $row['sch'];
                          $careerfield = $row['careerfield'];
                          $appdeadline = $row['appDeadline'];
                          $granteesNum = $row['granteesNum'];
                          $funding = $row['funding'];
                          $description = $row['description'];
                          $eligibility = $row['eligibility'];
                          $benefits = $row['benefits'];
                          $apply = $row['apply'];
                          $links = $row['links'];
                          $contact = $row['contact'];
                          $adminapproval = $row['adminapproval'];
                          //explode() function breaks a string into an array.
                          $ethnic = explode(',', $row['ethnic']);
                      }
                  }
              }
          } catch (Exception $e) {
          } ?>

					
		<div class="content edit-back">
		

            <h1><b >Edit Your Scholarship</b></h1>

				<form method = "post" name = "scholarshiplist" id = "scholarshiplist" action = "../backend/adminAddDelSch.php" class="login" enctype="multipart/form-data">
			<label style="padding-left : 40%"><strong>Scholarship ID : <?php echo $schID; ?></strong></label><br><br><br>
					<label><strong>Scholarship Name</strong></label><br>
					<label style="font-size: 15px;">This will be displayed and used for searching your scholarship</label>
					<br><input type = "text" name = "schname" style="background-color : #EDF2F2" placeholder="Eg:Joint Japan/World Bank Graduate Scholarship Program 2019" value="<?php echo $schname; ?>" required disabled>
					<br><br>

					<label><strong>Locations</strong></label><br>
					<label style="font-size: 15px;">In which states or regions do the students need to study to be able to receive the scholarship?</label>
					<br><input type = "text" name = "schlocation" placeholder="Select one or multiple" value="<?php echo $schlocation; ?>">
					<br><br>


					<label><strong>educationlevels</strong></label><br>
					<label style="font-size: 15px;">This is a scholarship to study a ... (check all that apply)</label><br>
					<select name="educationlevel" style="padding-top: 10px;padding-bottom: 10px; padding-left: 3% ; padding-right: 3%">
						
						<option value="highschool" <?php if ($educationlevel === 'highschool') {
          echo 'selected';
      } ?>>Highschool</option>
						<option value="diploma" <?php if ($educationlevel === 'diploma') {
          echo 'selected';
      } ?>>Diploma</option>
						<option value="bachelors" <?php if ($educationlevel === 'bachelors') {
          echo 'selected';
      } ?>>Bachelors</option>
						<option value="masters" <?php if ($educationlevel === 'masters') {
          echo 'selected';
      } ?>>Masters</option>
						<option value="phd" <?php if ($educationlevel === 'phd') {
          echo 'selected';
      } ?>>PhD</option>
					</select>
					<br><br><br>

					<label><strong>Gender</strong></label><br>
					<label style="font-size: 15px;">This is a scholarship for a particular gender ...</label><br>
					<select name="gender" style="padding-top: 10px;padding-bottom: 10px; padding-left: 5%">
						<option value="select" <?php if ($gender === 'select') {
          echo 'selected';
      } ?>>Select</option>
						<option value="male" <?php if ($gender === 'male') {
          echo 'selected';
      } ?>>Male</option>
						<option value="female" <?php if ($gender === 'female') {
          echo 'selected';
      } ?>>Female</option>
						<option value="nonbinary" <?php if ($gender === 'nonbinary') {
          echo 'selected';
      } ?>>Non-binary</option>
						<option value="transgender" <?php if ($gender === 'transgender') {
          echo 'selected';
      } ?>>Transgender</option>
					</select>
					<br><br><br>

					<label><strong>ethnic </strong></label><br>
					<label style="font-size: 15px;">This is a scholarship for a particular ethnic group ...</label><br>
					<!-- The in_array() function searches an array for a specific value. -->
					<input type="checkbox" name="ethnic[]" value="americanindian" <?php echo in_array(
         'americanindian',
         $ethnic
     )
         ? 'checked="checked"'
         : ''; ?>>American Indian<br>
					<input type="checkbox" name="ethnic[]" value="asian" <?php echo in_array(
         'asian',
         $ethnic
     )
         ? 'checked="checked"'
         : ''; ?>>Asian<br>
					<input type="checkbox" name="ethnic[]" value="black" <?php echo in_array(
         'black',
         $ethnic
     )
         ? 'checked="checked"'
         : ''; ?>>Black/African American<br>
					<input type="checkbox" name="ethnic[]" value="latino" <?php echo in_array(
         'latino',
         $ethnic
     )
         ? 'checked="checked"'
         : ''; ?>>Latino/ Hispanics<br>
					<input type="checkbox" name="ethnic[]" value="white" <?php echo in_array(
         'white',
         $ethnic
     )
         ? 'checked="checked"'
         : ''; ?>>White<br>
					<input type="checkbox" name="ethnic[]" value="hawaiian" <?php echo in_array(
         'hawaiian',
         $ethnic
     )
         ? 'checked="checked"'
         : ''; ?>>Native Hawaiian/Pacific Islander<br>
					<br><br>

					<label><strong>Scholarship type</strong></label><br>
					<label style="font-size: 15px;">Selct any Type of Scholarship from Below ...</label><br>
					<select name="scholarship" style="padding-top: 10px;padding-bottom: 10px; padding-left: 2% ; padding-right: 2%">
						<option value="select" <?php if ($scholarshipp === 'select') {
          echo 'selected';
      } ?>>Select</option>
						<option value="merit" <?php if ($scholarshipp === 'merit') {
          echo 'selected';
      } ?>>Athletic Based</option>
						<option value="needy" <?php if ($scholarshipp === 'needy') {
          echo 'selected';
      } ?>>Needy Based</option>
						<option value="creative" <?php if ($scholarshipp === 'creative') {
          echo 'selected';
      } ?> >Creative Development</option>
						<option value="culture" <?php if ($scholarshipp === 'cultural') {
          echo 'selected';
      } ?> >Community Service</option>
						
						</select>
					<br><br><br>
                    <label><strong>Career field</strong></label><br>
					<label style="font-size: 15px;">Select any Type of career field from Below ...</label><br>
					<select name="careerfield" style="padding-top: 10px;padding-bottom: 10px; padding-left: 10%">
						<option value="select" <?php if ($careerfield === 'select') {
                            echo 'selected';
                        } ?>>Select</option>
						<option value="agriculture" <?php if ($careerfield === 'agriculture') {
                                echo 'selected';
                            } ?>>Agriculture</option>
                          <option value="arts" <?php if ($careerfield === 'arts') {
                                echo 'selected';
                            } ?>>Arts</option>
                                                <option value="biologicalsciences" <?php if ($careerfield === 'biologicalsciences') {
                                echo 'selected';
                            } ?>>Biological Sciences</option>
                                                <option value="administration" <?php if ($careerfield === 'administration') {
                                echo 'selected';
                            } ?>>Administration</option>
                                                <option value="dentistry" <?php if ($careerfield === 'dentistry') {
                                echo 'selected';
                            } ?>>Dentistry</option>
                                                <option value="education" <?php if ($careerfield === 'education') {
                                echo 'selected';
                            } ?>>Education</option>
                                                <option value="engineering" <?php if ($careerfield === 'engineering') {
                                echo 'selected';
                            } ?>>Engineering</option>
                                                <option value="environmentscience" <?php if ($careerfield === 'environmentscience') {
                                echo 'selected';
                            } ?>>Environement Science</option>
                                                <option value="law" <?php if ($careerfield === 'law') {
                                echo 'selected';
                            } ?>>Law</option>
                                                <option value="medicalscience" <?php if ($careerfield === 'medicalscience') {
                                echo 'selected';
                            } ?>>Medical Science</option>
                                                <option value="veterinary" <?php if ($careerfield === 'veterinary') {
                                echo 'selected';
                            } ?>>Veterinary</option>
                                                <option value="socialscience" <?php if ($careerfield === 'socialscience') {
                                echo 'selected';
                            } ?>>Social Science</option>
						</select>
					<br><br><br>
					<label><strong>Application Deadline</strong></label><br>
					<label style="font-size: 15px;">What is the deadline of application?</label>
					<br><input type = "text" name = "appdeadline" value="<?php echo $appdeadline; ?>">
					<br><br>

					<label><strong>Number of Applications maximum allowed</strong></label><br>
					<label style="font-size: 15px;">You can limit the number of applicants[This wont be displayed]</label>
					<br><input type = "text" name = "granteesNum" value="<?php echo $granteesNum; ?>">
					<br><br>

					<label><strong>Funding</strong></label><br>
					<label style="font-size: 15px;">Short description about funding. e.g. "$5000,-" or "100% tuition fee"</label>
					<br><input type = "text" name = "funding" value="<?php echo $funding; ?>">
					<br><br>

					<label><strong>Description</strong></label><br>
					<label style="font-size: 15px;">Give a general description of the scholarship. This is the first text that users will read.</label>
					<br><textarea name = "description" rows="5" ><?php echo $description; ?></textarea>
					<br><br>

					<label><strong>Eligibility</strong></label><br>
					<label style="font-size: 15px;">What students are eligible? Are there any requirements?</label>
					<br><textarea name = "eligibility" rows="5"><?php echo $eligibility; ?></textarea>
					<br><br>

					<label><strong>Benefits</strong></label><br>
					<label style="font-size: 15px;">When a student gets the scholarship, what are their benefits?</label>
					<br><textarea name = "benefits" rows="5"><?php echo $benefits; ?></textarea>
					<br><br>

					<label><strong>How can you apply ?</strong></label><br>
					<label style="font-size: 15px;">How should a student apply? What are the requirements for application?</label>
					<br><textarea name = "apply" rows="5"><?php echo $apply; ?></textarea>
					<br><br>

					<label><strong>Important Links</strong></label><br>
					<label style="font-size: 15px;">Provide links for your organization and scholarship if any.</label>
					<br><textarea name = "links" rows="5"><?php echo $links; ?></textarea>
					<br><br>

					<label><strong>Contact Details</strong></label><br>
					<label style="font-size: 15px;">Email, website, contact info ...</label>
					<br><textarea name = "contact" rows="5"><?php echo $contact; ?></textarea>
					<br><br>

						<label><strong>Upload Document</strong></label>&nbsp;&nbsp;<label style="font-size: 15px;color: red; ">* This is compulsory.</label><br>
					<label style="font-size: 15px;">Provide a soft copy of your scholarship so as to validate your scholarship.</label>
					<br>
					<input type="file" name="validate" id="validate" onchange=" return fileValidation('validate')" ><br>
					<br><br>

					<input type="hidden" name="scholarshipID" value="<?php echo $schID; ?>">
			<input type="hidden" name="schname" value="<?php echo $schname; ?>">
					<input type="hidden" name="adminapproval" value="Pending">

					<div class = "text-center">
					<input type = "submit" name = "deladd" value = "EDIT Scholarship >">
					</div>
				</form>

				<br>
				<div class = "text-center">
					<form action = "tempSigScholarship.php">
						<input type = "submit" value = "Back">
					</form>
				</div>
                <div class="footer">
                    <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
                    <p>copyright &copy;2022</p>
                </div>
			</div>
        
		
		</div>

					

		<!-- Scripts -->
     
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
