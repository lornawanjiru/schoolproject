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
        isset($_POST['blk_unblk']) and
        $_POST['blk_unblk'] == 'blockScholarship'
    ) {
        $schID = $_POST['schID'];
        //A JOIN clause is used to combine rows from two or more tables, based on a related column between them.
        // (INNER) JOIN: Returns records that have matching values in both tables
        // LEFT (OUTER) JOIN: Returns all records from the left table, and the matched records from the right table
        // RIGHT (OUTER) JOIN: Returns all records from the right table, and the matched records from the left table
        // FULL (OUTER) JOIN: Returns all records when there is a match in either left or right table
        //AS is used to assign a new name temporarily to a table column or even table.
        //WHERE is used to compare the given value with the field value available in table.
        $sch_sql = "UPDATE scholarship SET previous_adminapproval = adminapproval, adminapproval = 'currently blocked', schstatus = 'inactive' WHERE scholarshipID = '$schID'";
        if ($conn->query($sch_sql) === true) {
            $app_sql = "UPDATE application SET previous_appstatus=appstatus, appstatus = 'inactive',previous_verifiedBySignatory=verifiedBySignatory, verifiedBySignatory = 'currently blocked' WHERE scholarshipID = '$schID'";
            if ($conn->query($app_sql) === true) { ?>
                <script type="text/javascript">
                  alert('Successfully Blocked Scholarships and corresponding Applications');
                  location.replace('../admin/tempScholarship.php');
                </script>
              <?php } else { ?>
                  <script type="text/javascript">
                    alert( "Unable to Block Applications");
                    location.replace('../admin/tempScholarship.php');
                  </script>
                <?php }
        } else {
             ?>
              <script type="text/javascript">
                alert( "Unable to Block Scholarships And Applications");
                location.replace('../admin/tempScholarship.php');
              </script>
            <?php
        }
    } elseif (
        isset($_POST['blk_unblk']) and
        $_POST['blk_unblk'] == 'unblockScholarship'
    ) {
        $schID = $_POST['schID'];
        $sch_sql = "UPDATE scholarship SET  adminapproval = previous_adminapproval, schstatus = 'active' WHERE scholarshipID = '$schID'";
        if ($conn->query($sch_sql) === true) {
            $app_sql = "UPDATE application SET appstatus = previous_appstatus, verifiedBySignatory = previous_verifiedBySignatory WHERE scholarshipID = '$schID'";
            if ($conn->query($app_sql) === true) { ?>
                <script type="text/javascript">
                  alert('Successfully UnBlocked Scholarships and corresponding Applications');
                  location.replace('../admin/tempScholarship.php');
                </script>
              <?php } else { ?>
                  <script type="text/javascript">
                    alert( "Unable to UnBlock Applications");
                    location.replace('../admin/tempScholarship.php');
                  </script>
                <?php }
        } else {
             ?>
              <script type="text/javascript">
                alert( "Unable to UnBlock Scholarships And Applications");
                //The replace() method replaces the current document with a new one. 
              //The difference with the assign() method is that assign() method loads a new document
                location.replace('../admin/tempScholarship.php');
              </script>
            <?php
        }
    } else {
         ?>
            <script type="text/javascript">
              alert('Invalid Request');
              location.replace('../admin/tempAdmin.php');
            </script>
          <?php
    }
    ?>

  </body>
</html>
