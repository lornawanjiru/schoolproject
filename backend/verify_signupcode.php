<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Student Signup</title>
    <!-- Custom CSS-->
    <link href="../css/general.css" rel="stylesheet">
  </head>
 <body>

<?php
isset($_SESSION) || session_start();

try {
    if (isset($_POST['submit'])) {
        $num = $_POST['sixdn'];
        $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM verify_signup WHERE upMail = '" . $email . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['num'] == $num) {
                    $update =
                        "UPDATE verify_signup SET action = 1 WHERE upMail = '" .
                        $email .
                        "'";
                    if (mysqli_query($conn, $update)) { ?>
          <script type="text/javascript">
            alert("Email Verified ! Please login");
            location.replace("../index.php");
          </script>
        <?php }
                } else {
                     ?>
            <script type="text/javascript">
              alert("Incorrect credentials");
              location.replace("verify_signupcode.php");
            </script>
          <?php
                }
            }
        }
    } ?>
  
  <div class="login">
  <form action = "<?php $_SERVER[
      'PHP_SELF'
  ]; ?>" method="post" class="verify-signup">
      <div class="row">
          <div class="col-10">
              <label for="firstname">Enter Six Digit Code :  *</label>
          </div>
          <div class="col-90">
              <input type = "text" name = "sixdn">
          </div>
      </div>   
      <input type="submit" value="Submit" name="submit">
  </form>
  </div>
  <?php
} catch (Exception $e) {
}
?>
</body>
</html>
