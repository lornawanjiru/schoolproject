<!DOCTYPE HTML>
<html>
  <head>
   </head>
   <body>
   	<?php
    session_start();
    $_SESSION['selectedAppID'] = 0;

    $_SESSION['appList'] = null;

    //check validity of the user
    $currentUserID = $_SESSION['currentUserID'];
    $schid = $_SESSION['schid'];
    $sigID = $_SESSION['sigID'];
    if ($currentUserID == null) {
        header('Location:../index.php');
    }
    if ($schid == null || $sigID == null) {
        header('Location:../student/tempUserApply.php');
    }
    if ($_POST['apply'] == 'Apply >>') {
        //inserting into database if applying button is clicked
        $flag = 0;
        $date1 = date('Y-m-d H:i:s');
        $totalresults = 0;
        $gpa = $_POST['gpa'];
        $languageresults = $_POST['languageresults'];
        $totalresults = $gpa + $languageresults;
        $financialsupport = $_POST['financialsupport'];
        $ethnic = $_POST['ethnic'];
        $appstatus = 'Processing';
        // Connect to database
        $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

        // Checks Connection
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        //Finacial, Gender and results automation
        $finance = "SELECT sch,gender FROM scholarship WHERE scholarshipID = '$schid'";
        $gender = "SELECT gender FROM student WHERE studentID = '$currentUserID'";

        $result = $conn->query($finance);
        if ($result->num_rows > 0) {
            $row1 = $result->fetch_assoc();
        }
        $result2 = $conn->query($gender);
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
        }

        if ($financialsupport != 'Yes' && $row1['sch'] == 'needy') {
            $appstatus = 'Finance Rejected';
        }
        if ($totalresults < 52) {
            $appstatus = 'Result Rejected';
        }
        if (
            strtoupper($row2['gender']) !== strtoupper($row1['gender']) ||
            $row1['gender'] !== 'any'
        ) {
            $appstatus = 'Gender Rejected';
        }
        $sql = "INSERT INTO application(studentID,sigID,scholarshipID,appDate,appstatus,gpa,languageresults,financialsupport,ethnic,totalresults) VALUES ('$currentUserID','$sigID','$schid','$date1','$appstatus','$gpa','$languageresults','$financialsupport','$ethnic','$totalresults')";

        if (mysqli_query($conn, $sql)) {
            $flag = 1;
        } else {
            echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
            $flag = 0;
        }
        //tmp_name is the temporary name of the uploaded file which is generated automatically by php,
        //and stored on the temporary folder on the server. name is the original name of the file which is store on the local machine.

        //uploading docs
        if ($flag == 1) {
            $fileupload = null;
            // The global predefined variable $_FILES is an associative array containing items uploaded via HTTP POST method.
            // Uploading a file requires HTTP POST method form with enctype attribute set to multipart/form-data.
            $total = count($_FILES['file']['name']);
            $folder = $currentUserID . '_' . $schid;
            mkdir("../applications/$folder/");
            for ($i = 0; $i < $total; $i++) {
                //The is_uploaded_file() function checks whether the specified file is uploaded via HTTP POST.
                if (is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
                    //move_uploaded_file
                    copy(
                        $_FILES['file']['tmp_name'][$i],
                        "../applications/$folder/" . $_FILES['file']['name'][$i]
                    );
                    $fileupload .= '1';
                }
            }
            if ($fileupload == '11111') { ?>
				    <script type="text/javascript">
				   		alert("Your Application is Submitted Successfully!");
				   		location.replace("../student/tempUserHome.php")
				   	</script>
			  	<?php }
        } else {
             ?>
			<script>
				alert("Error! File upload Failed.");
				location.replace("../student/applyprocess.php");
			</script>
		<?php
        }
    }
    ?>
</body>
</html>
