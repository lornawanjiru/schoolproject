<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
      $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error);
      }

      if (
          isset($_POST['unblockUser']) and
          $_POST['unblockUser'] == 'unblockStudent'
      ) {
          $studentID = $_POST['ID'];
          $student_sql = "UPDATE student SET status = 'active' WHERE studentID = '$studentID'";
          if ($conn->query($student_sql) === true) {
              $app_sql = "UPDATE application SET appstatus = previous_appstatus, verifiedBySignatory = previous_verifiedBySignatory WHERE studentID = '$studentID'";
              if ($conn->query($app_sql) === true) { ?>
                <script type="text/javascript">
                  alert('Successfully Unblocked the Student and corresponding Applicaitons');
                  location.replace('../admin/tempStudentShow.php');
                </script>
              <?php } else { ?>
                  <script type="text/javascript">
                    alert( "Unable to Unblock Applications");
                    location.replace('../admin/tempStudentShow.php');
                  </script>
                <?php }
          } else {
               ?>
              <script type="text/javascript">
                alert( "Unable to Unblock Student");
                location.replace('../admin/tempStudentShow.php');
              </script>
            <?php
          }
      } elseif (
          isset($_POST['unblockUser']) and
          $_POST['unblockUser'] == 'unblockSig'
      ) {
          $sigID = $_POST['ID'];
          $sig_sql = "UPDATE signatory SET status = 'active' WHERE sigID = '$sigID'";
          if ($conn->query($sig_sql) === true) {
              $sch_sql = "UPDATE scholarship SET  adminapproval = previous_adminapproval, schstatus = 'active' WHERE sigID = '$sigID'";
              if ($conn->query($sch_sql) === true) {
                  $app_sql = "UPDATE application SET appstatus = previous_appstatus, verifiedBySignatory = previous_verifiedBySignatory WHERE sigID = '$sigID'";
                  if ($conn->query($app_sql) === true) { ?>
                  <script type="text/javascript">
                    alert('Successfully UnBlocked the Signatory, corresponding Scholarships and Applications');
                    location.replace('../admin/tempSignatoryShow.php');
                  </script>
                <?php } else { ?>
                    <script type="text/javascript">
                      alert( "Unable to UnBlock Applications");
                      location.replace('../admin/tempSignatoryShow.php');
                    </script>
                  <?php }
              } else {
                   ?>
                <script type="text/javascript">
                  alert( "Unable to UnBlock Scholarships And Applications");
                  location.replace('../admin/tempSignatoryShow.php');
                </script>
              <?php
              }
          } else {
               ?>
            <script type="text/javascript">
              alert( "Unable to UnBlock Signatory");
              //The replace() method replaces the current document with a new one. 
              //The difference with the assign() method is that assign() method loads a new document
              location.replace('../admin/tempSignatoryShow.php');
            </script>
          <?php
          }
      } elseif (
          isset($_POST['blockUser']) and
          $_POST['blockUser'] == 'blockAdmin'
      ) {
          echo 'Admin';
      } else {
           ?>
            <script type="text/javascript">
              alert('Invalid Page');
              location.replace("../admin/tempAdmin.php");
            </script>
          <?php
      }
      $conn->close();
      ?>
  </body>
</html>
