<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    session_start();

    $selAppID = $_SESSION["selectedAppID"];

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



    	//inserting Record to the database
    	$firstName = $_POST['firstName'];
		  $middleName = $_POST['middleName'];
    	$lastName = $_POST['lastName'];
    	$currentlocation = $_POST['currentlocation'];
      $gender = $_POST["gender"];
      $phonenumber = $_POST["phonenumber"];
      $specialization = $_POST["specialization"];
      $level = $_POST["level"];
      $results = $_POST["results"];
    	
    	

    	$sql = "UPDATE student set firstName='$firstName', middleName='$middleName', lastName='$lastName',currentlocation='$currentlocation',gender='$gender',phonenumber='$phonenumber',specialization='$specialization',level='$level',results='$results' where studentID = '$currentUserID'";

    	if($conn->query($sql)){
      ?>
    	     <script type="text/javascript">
    				alert('Updated Record Successfully!');
    				location.replace('../student/tempUserProfile.php')
    			</script>
      <?php
    	}
    	else{
        ?>
      	     <script type="text/javascript">
      				alert('Error updating Record');
      				location.replace('../student/tempUserProfile.php')
      			</script>
        <?php

    	}
    	$conn->close();
    ?>

  </body>
</html>
