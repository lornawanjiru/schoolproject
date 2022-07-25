<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Instituation Signup</title>


    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">

   
  </head>

  <body id = "home">

    <?php
    $email = null;
    $flag = 1;
    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $cpass = $_POST['confirm_password'];
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $lastname = $_POST['lastname'];
                $organization = $_POST['organization'];
                $position = $_POST['position'];
                $phonenumber = $_POST['phonenumber'];

                $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }
                // CHecking if the email has being used. To avoid users with the same emails. That needed during verification
                $sql =
                    'SELECT upMail FROM student UNION SELECT upMail FROM signatory';
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['upMail'] == $email) {
                            $flag = 0;
                        }
                    }
                }
                if ($flag == 0) {
                    $_SESSION['errMsg'] = 'User Already Exists!';
                } else {
                    //Convert password into hash
                    $phash = password_hash($pass, PASSWORD_DEFAULT);

                    // Write insert query
                    $sql = "INSERT INTO signatory(upMail,password,firstname,middlename,lastname,organization,position,phonenumber) VALUES ('$email','$phash','$firstname','$middlename','$lastname','$organization','$position','$phonenumber')";
                    if (mysqli_query($conn, $sql)) {
                        $min = 100001;
                        $max = 999999;
                        $sixdigitnum = mt_rand($min, $max);
                        $verify = "INSERT INTO verify_signup(upMail,num) VALUES ('$email','$sixdigitnum')";
                        if (mysqli_query($conn, $verify)) {
                            $emailfrom = 'demo73451@gmail.com';
                            $passfrom = 'Test1234#';
                            $mail = new PHPMailer();
                            $mail->isSMTP(); // Set mailer to use SMTP
                            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true; // Enable SMTP authentication
                            $mail->Username = $emailfrom; // SMTP username
                            $mail->Password = $passfrom; // SMTP password
                            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587; // TCP port to connect to
                            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                            $mail->setFrom($emailfrom, 'SMS');
                            $mail->addReplyTo($emailfrom, 'SMS');
                            $mail->addAddress($email); // Add a recipient
                            // $mail->addCC('cc@example.com');
                            // $mail->addBCC('bcc@example.com');
                            $mail->isHTML(true); // Set email format to HTML

                            $bodyContent =
                                '

                  Thanks for signing up!
                  <h1>Your account has been created</h1>You can <strong>login</strong> with the following credentials after you have activated your account by pressing the url below.


                  Use the following code to Login To Our WebSite:<br/>' .
                                $sixdigitnum .
                                '<br/><br/>
                  Thank You For Using Our WebSite!
                  '; // Our message above including the
                            $mail->Subject = 'Signup | Verification';
                            $mail->Body = $bodyContent;

                            if (!$mail->send()) {
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            } else {
                                $_SESSION['email'] = $email; ?>
                    <script type="text/javascript">
                      alert("Your Account Has been Created, Please check your Email for verification!");
                      location.replace("backend/verify_signupcode.php")
                    </script>
                  <?php
                            }
                        }
                    } else {
                        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
                    }
                }
                $conn->close();
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    ?>

    <div class = "intro-header">
      <div class = "text-center">
         

        <div class="login">
          <form action="<?php echo htmlspecialchars(
              $_SERVER['PHP_SELF']
          ); ?>" onsubmit="return validateControls()" method="POST" name="login" >
          <div class="form-container">
            <div class="card-info">
                <div class="landingimg">
                    <img src="./images/grad.png"/>
                </div>   
                <div class="page-title">
                    <h1>Welcome</h1>
                    <p> Scholarship Management System for you </p>
                </div>
            </div>      
            <div class ="form"> 
                <h1> Signatory Registration</h1>
                  <div class="row">
                    <div class="col-10">
                        <label for="email">Email *</label>
                    </div>
                    <div class="col-90">
                        <input type="text" id="email" name="email" placeholder="Enter your email address" value="<?php echo $email; ?>">
                    </div>
          </div>

          <div class="row">
                    <div class="col-10">
                        <label for="password">Password *</label>
                    </div>
                    <div class="col-90">
                        <input type="password" id="password" name="password" placeholder="Enter your new password">
                    </div>
          </div>

          <div class="row">
                    <div class="col-10">
                        <label for="confirmpassword">Confirm password *</label>
                    </div>
                    <div class="col-90">
                        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Please confirm your password">
                    </div>
          </div>
          <div class="row">
                    <div class="col-10">
                        <label for="firstname">First Name *</label>
                    </div>
                    <div class="col-90">
                        <input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
                    </div>
          </div>
          <div class="row">
                    <div class="col-10">
                        <label for="middlename">Middle name *</label>
                    </div>
                    <div class="col-90">
                        <input type="text" id="middlename" name="middlename" placeholder="Enter your middlename">
                    </div>
          </div>
          <div class="row">
                    <div class="col-10">
                        <label for="lastname">Last name *</label>
                    </div>
                    <div class="col-90">
                        <input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
                    </div>
          </div>
          <div class="row">
                    <div class="col-10">
                        <label for="organization">Organization *</label>
                    </div>
                    <div class="col-90">
                        <input type="text" id="organization" name="organization" placeholder="Enter your Organization">
                    </div>
          </div>
          <div class="row">
              <div class="col-10">
                  <label for="position" required>Position *</label>
              </div>
              <div class="col-90">
              <input type="text" id="position" name="position" placeholder="Enter your position in the organization">
              </div>
          </div>
          <div class="row">
              <div class="col-10">
                  <label for="phonenumber">Your phone number*</label>
              </div>
              <div class="col-90">
                  <input type="text" id="phonenumber" name="phonenumber" placeholder="Please enter your number starting with your country code">
              </div>
          </div>
            <input type = "submit" id="submit" class = "btn">

            <h5 class = "">Already have an Account<a style="color:black" href="index.php">: Click Here</a></h5>

            <h5 class = "">Signup as a<a style="color:black" href="signup_student.php">: Student</a></h5>
          </form>
</div>
          <?php if (!empty($_SESSION['errMsg'])) { ?>
              <div class = "">
                <div class="text-center" style="margin-top:20px;">
                  <strong>Invalid! </strong><?php echo $_SESSION['errMsg']; ?>
                </div>
              </div>
          <?php unset($_SESSION['errMsg']);} ?>
        </div>
     </div>
    </div>


    <!-- JavaScript -->
    
    <script src="js/script.js"></script>
    
  </body>
</html>
