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
?>
<!DOCTYPE HTML>
<html>
  	<head></head>
 	<body>
 	<?php // A function using an excption should be in a "try" block.
  // If the exception does not trigger, the code will continue as normal.
  try {
      // Connect to database
      $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

      // Checks Connection
      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error);
      }
      function test_input($data)
      {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }
      /*If the add button was clicked*/
      if ($_POST['deladd'] == 'Submit Scholarship >') {
          $flag = 0;
          $name = test_input($_POST['schname']);
          $schlocation = test_input($_POST['schlocation']);
          $educationlevel = test_input($_POST['educationlevel']);
          $gender = test_input($_POST['gender']);
          //   $ethnic = test_input($_POST['ethnic'];
          $scholarshipp = test_input($_POST['scholarship']);
          $careerfield = test_input($_POST['careerfield']);
          $appdeadline = test_input($_POST['appdeadline']);
          $granteesNum = test_input($_POST['granteesNum']);
          $funding = test_input($_POST['funding']);
          $description = test_input($_POST['description']);
          $eligibility = test_input($_POST['eligibility']);
          $benefits = test_input($_POST['benefits']);
          $apply = test_input($_POST['apply']);
          $links = test_input($_POST['links']);
          $contact = test_input($_POST['contact']);
          $adminapproval = test_input($_POST['adminapproval']);

          //fetching input of array ethnic[]
          $ethnic = count($_POST['ethnic']) ? $_POST['ethnic'] : [];
          //Join array elements with a string.
          $ethnicn = implode(',', $ethnic);

          $sql = "INSERT INTO scholarship (sigID,schname, schlocation,educationlevel, gender, ethnic, sch,careerfield, appDeadline, granteesNum, funding, description, eligibility, benefits, apply, links, contact, adminapproval) VALUES ('$currentUserID','$name','$schlocation','$educationlevel','$gender','$ethnicn','$scholarshipp','$careerfield','$appdeadline','$granteesNum','$funding','$description','$eligibility','$benefits','$apply','$links','$contact','$adminapproval')";

          if ($conn->query($sql) === true) {
              $query =
                  "SELECT * FROM scholarship WHERE sigID = '" .
                  $currentUserID .
                  "' AND schname = '" .
                  $name .
                  "' AND description = '" .
                  $description .
                  "'";
              $result = $conn->query($query);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $schID = $row['scholarshipID'];
                  }
              }
              //is an inbuilt function in PHP which is used to return information from a website.
              $xml = new DOMDocument('1.0', 'UTF-8');
              //load() inbuilt function in PHP which is used to load an xml document from a file.
              $xml->load('scholarship_data.xml');
              //getElementsByTagName Gets all elements with the tag name "scholarships"
              //item() inbuilt function in PHP which is used to retrieve a node specified by index
              $rootTag = $xml->getElementsByTagName('scholarships')->item(0);
              //createelement() method creates an element node.
              $dataTag = $xml->createElement('scholarship');

              $sigidtag = $xml->createElement('sigID', $currentUserID);
              $schnametag = $xml->createElement('schname', $name);
              $schlocationtag = $xml->createElement(
                  'schlocation',
                  $schlocation
              );

              $educationleveltag = $xml->createElement(
                  'educationlevel',
                  $educationlevel
              );
              $gendertag = $xml->createElement('gender', $gender);
              $ethnictag = $xml->createElement('ethnic', $ethnicn);
              $careerfieldtag = $xml->createElement(
                  'careerfield',
                  $careerfield
              );
              $schtag = $xml->createElement('sch', $scholarshipp);
              $appDeadlinetag = $xml->createElement(
                  'appDeadline',
                  $appdeadline
              );
              $granteesNumtag = $xml->createElement(
                  'granteesNum',
                  $granteesNum
              );
              $fundingtag = $xml->createElement('funding', $funding);
              $descriptiontag = $xml->createElement(
                  'description',
                  $description
              );
              $eligibilitytag = $xml->createElement(
                  'eligibility',
                  $eligibility
              );
              $benefitstag = $xml->createElement('benefits', $benefits);
              $applytag = $xml->createElement('apply', $apply);
              $linkstag = $xml->createElement('links', $links);
              $contacttag = $xml->createElement('contact', $contact);
              //appendChild() method is used to insert a new node/reposition an existing node as the last child of a particular parent node.
              $dataTag->appendChild($sigidtag);
              $dataTag->appendChild($schnametag);
              $dataTag->appendChild($schlocationtag);

              $dataTag->appendChild($educationleveltag);
              $dataTag->appendChild($gendertag);
              $dataTag->appendChild($ethnictag);
              $dataTag->appendChild($careerfieldtag);
              $dataTag->appendChild($schtag);
              $dataTag->appendChild($appDeadlinetag);
              $dataTag->appendChild($granteesNumtag);
              $dataTag->appendChild($fundingtag);
              $dataTag->appendChild($descriptiontag);
              $dataTag->appendChild($eligibilitytag);
              $dataTag->appendChild($benefitstag);
              $dataTag->appendChild($applytag);
              $dataTag->appendChild($linkstag);
              $dataTag->appendChild($contacttag);
              //setAttribute method sets a new value to an attribute.
              $dataTag->setAttribute('scholarshipID', $schID);

              $rootTag->appendChild($dataTag);
              $xml->save('scholarship_data.xml');

              $flag = 1;
          } else {
              $flag = 0;
              echo 'Error: ' . $sql . '<br>' . $conn->error;
          }
          if ($flag == 1) {
              $folder = $schID;
              mkdir("../scholarship/$folder/");
              if (is_uploaded_file($_FILES['validate']['tmp_name'])) {
                  //move_uploaded_file
                  copy(
                      $_FILES['validate']['tmp_name'],
                      "../scholarship/$folder/" . $_FILES['validate']['name']
                  );
                  $fileupload = '1';
              }
              if ($fileupload == '1') { ?>
  				    <script type="text/javascript">
                			alert("Scholarship is added and will be further processed by Admin to validate!");
                			location.replace("../signatory/tempSigScholarship.php")
              		</script>
  			  	<?php }
          }
      } elseif ($_POST['deladd'] == 'EDIT Scholarship >') {
          //Update Query [Same as insert]

          $flag = 0;
          $schID = test_input($_POST['scholarshipID']);
          $name = test_input($_POST['schname']);
          $schlocation = test_input($_POST['schlocation']);

          $educationlevel = test_input($_POST['educationlevel']);
          $gender = test_input($_POST['gender']);
          $careerfield = test_input($_POST['careerfield']);
          $scholarshipp = test_input($_POST['scholarship']);
          $appdeadline = test_input($_POST['appdeadline']);
          $granteesNum = test_input($_POST['granteesNum']);
          $funding = test_input($_POST['funding']);
          $description = test_input($_POST['description']);
          $eligibility = test_input($_POST['eligibility']);
          $benefits = test_input($_POST['benefits']);
          $apply = test_input($_POST['apply']);
          $links = test_input($_POST['links']);
          $contact = test_input($_POST['contact']);
          $adminapproval = test_input($_POST['adminapproval']);

          //fetching input of array ethnic[]
          $ethnic = count($_POST['ethnic']) ? $_POST['ethnic'] : [];
          $ethnicn = implode(',', $ethnic);
          //A JOIN clause is used to combine rows from two or more tables, based on a related column between them.
          // (INNER) JOIN: Returns records that have matching values in both tables
          // LEFT (OUTER) JOIN: Returns all records from the left table, and the matched records from the right table
          // RIGHT (OUTER) JOIN: Returns all records from the right table, and the matched records from the left table
          // FULL (OUTER) JOIN: Returns all records when there is a match in either left or right table
          //AS is used to assign a new name temporarily to a table column or even table.
          //WHERE is used to compare the given value with the field value available in table.
          $sql = "UPDATE scholarship SET schlocation = '$schlocation',
              educationlevel = '$educationlevel',gender = '$gender', careerfield = '$careerfield', ethnic = '$ethnicn' , sch = '$scholarshipp', appDeadline = '$appdeadline',
              granteesNum = '$granteesNum', funding = '$funding', description = '$description', eligibility = '$eligibility',
              benefits = '$benefits', apply = '$apply', links = '$links', contact = '$contact', adminapproval = '$adminapproval'
              WHERE scholarshipID = '$schID' ";
          if ($conn->query($sql) === true) {
              ($xml = simplexml_load_file('scholarship_data.xml')) or
                  die('Error: Cannot create object');
              foreach ($xml->children() as $scholarship) {
                  if ($scholarship['scholarshipID'] == $schID) {
                      $scholarship->{'schlocation'} = $schlocation;

                      $scholarship->{'educationlevel'} = $educationlevel;
                      $scholarship->{'gender'} = $gender;
                      $scholarship->{'ethnic'} = $ethnicn;
                      $scholarship->{'careerfield'} = $careerfield;
                      $scholarship->{'sch'} = $scholarshipp;
                      $scholarship->{'appDeadline'} = $appdeadline;
                      $scholarship->{'granteesNum'} = $granteesNum;
                      $scholarship->{'funding'} = $funding;
                      $scholarship->{'description'} = $description;
                      $scholarship->{'eligibility'} = $eligibility;
                      $scholarship->{'benefits'} = $benefits;
                      $scholarship->{'apply'} = $apply;
                      $scholarship->{'links'} = $links;
                      $scholarship->{'contact'} = $contact;
                  }
              }
              //asXml() function returns a well-formed XML string from a simple XML object.
              $xml->asXml('scholarship_data.xml');

              $flag = 1;
          } else {
              $flag = 0;
              echo 'Error: ' . $sql . '<br>' . $conn->error;
          }

          if ($flag == 1) {
              $folder = $schID;
              echo $folder;
              $dir = "../scholarship/$folder/";
              if (is_dir($dir)) {
                  //returns an array of filenames or directories matching the specified pattern.
                  $files = glob($dir . '/*');
                  foreach ($files as $file) {
                      //inbuilt function which is used to check whether the specified file is a regular file or not.
                      if (is_file($file)) {
                          //used to competely delete the files.
                          unlink($file);
                      }
                  }

                  if (is_uploaded_file($_FILES['validate']['tmp_name'])) {
                      //move_uploaded_file
                      copy(
                          $_FILES['validate']['tmp_name'],
                          "../scholarship/$folder/" .
                              $_FILES['validate']['name']
                      );
                      $fileupload = '1';
                  } else {
                      echo '';
                  }
                  if ($fileupload == '1') { ?>
  				    <script type="text/javascript">
                			alert("Scholarship is Updated and will be further processed by Admin to validate!");
                            //The replace() method replaces the current document with a new one. 
                            //The difference with the assign() method is that assign() method loads a new document
                			location.replace("../signatory/tempSigScholarship.php")
              		</script>
  			  	<?php } else {echo 'Please Update the validation form also.';}
              } else {
                  echo 'dir not found';
              }
          }
          $conn->close();
      }
  } catch (Exception $e) {
      echo $e->getMessage();
  } ?>
	</body>
</html>
