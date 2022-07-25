<!-- The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL.
This function returns true if the variable exists and is not NULL, otherwise it returns false.
Note: If multiple variables are supplied, then this function will return true only if all of the variables are set.
Tip: A variable can be unset with the unset() function. -->
<!-- Session variables stores user information to be used across multiple pages (e.g. username etc).
 By default, session variables last until the user closes the browser. 
It holds information about one user
A session is started with the session_start() function.
Session variables are set with the PHP global variable: $_SESSION.-->
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//include or require statements takes all the text/code that exists in the specified field and copies it into the file.
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      
      <title>Student Signup</title>
  
    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">
  </head>

  <body id = "home" >

    <?php
    $email = null;
    $flag = 1;
    // A function using an excption should be in a "try" block.
    // If the exception does not trigger, the code will continue as normal.
    try {
        // $_SERVER is a PHP super global array variable which holds information about headers, paths, and script locations.
        //POST is used to send data to a server to create/update a resource.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$_POST is an super global array of variables passed to the current script via the HTTP POST method.
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $cpass = $_POST['confirm_password'];
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $lastname = $_POST['lastname'];
                $currentlocation = $_POST['currentlocation'];
                $gender = $_POST['gender'];
                $phonenumber = $_POST['phonenumber'];
                $specialization = $_POST['specialization'];
                $level = $_POST['level'];
                $results = $_POST['results'];
                $images = $_POST['images'];

                $conn = new mysqli('localhost', 'scholar', 'Github56#', 'sms');

                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }
                // CHecking if the email has being used. To avoid users with the same emails. That needed during verification
                // The SQL UNION operator combines the result of two or more SELECT statements.
                // Each SELECT statement within the UNION must have the same number of columns.
                // The columns must also have similar data types.
                $sql =
                    'SELECT upMail FROM student UNION SELECT upMail FROM signatory';
                //The query() / mysqli_query() function performs a query against a database.
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    //The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
                    //Associative arrays are arrays that use named keys that you assign to them.
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
                    // PASSWORD DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to
                    // change over time as new and stronger algorithms are added to PHP . For that reason, the length of the result from
                    // using this identifier can change over time. Therefore, it is recommended to store the result in a database that can
                    // expand beyond 60 characters (255 characters would be a good choice).
                    // PASSWORD_BCRYPT - Use the CRYPT_BLOWFISH algorithm to create the hash. This will produce a standard crypt ()
                    // compatible hash using the "$ 2y $" identifier. The result will always be a 60 character string, or FALSE on failure.
                    //password_hash () uses a strong hash, generates strong salt, and applies proper rounds automatically.
                    $phash = password_hash($pass, PASSWORD_DEFAULT);

                    // Write insert query
                    $sql = "INSERT INTO student(upMail,password,firstname,middlename,lastname,currentlocation,gender,phonenumber,specialization,level,results) VALUES ('$email','$phash','$firstname','$middlename','$lastname','$currentlocation','$gender','$phonenumber','$specialization','$level','$results')";
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
                            // $mail->SMTPDebug = 3; //For debugging
                            $mail->SMTPAuth = true; // Enable SMTP authentication
                            $mail->Username = $emailfrom; // SMTP username
                            $mail->Password = $passfrom; // SMTP password
                            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587; // TCP port to connect to

                            $mail->setFrom($emailfrom, 'SMS');
                            $mail->addReplyTo($emailfrom, 'SMS');
                            $mail->addAddress($email); // Add a recipient
                            // $mail->addCC('cc@example.com');
                            //$mail->addBCC('lornawanjirumuchangi@gmail.com');
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
        //a catch block retrieves an exception and creates an object containing that exception information.
    } catch (Exception $e) {
        //getMessage()method returns a description of the error or behavior that caused the exception to be thrown
        echo $e->getMessage();
    }
    ?>

    <div class = "intro-header back">
      
      <div class = "text-center ">
        <div class="login ">
        <!-- The $_SERVER["PHP_SELF"] is a super global variable that returns the filename of the currently executing script.
        So, the $_SERVER["PHP_SELF"] sends the submitted form data to the page itself, instead of jumping to a different page. 
        This way, the user will get error messages on the same page as the form. -->
        <!-- The htmlspecialchars() function converts special characters to HTML entities. This means that it will replace HTML characters like
         < and > with &lt; and &gt;. 
        This prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in forms. -->
          <form action="<?php echo htmlspecialchars(
              $_SERVER['PHP_SELF']
          ); ?>" onsubmit="return validateControls()"  method="POST" name="login" >
          <div class="form-container">
            <div class="card-info">
                <div class="landingimg">
                    <img src="./images/grad.png"/>
                </div>   
                <div class="page-title">
                    <h1>Welcome</h1>
                    <p>There are so many opportunities Waiting for you. Aim the sky champ </p>
                </div>
            </div>      
            <div class ="form"> 
                <h1>Register</h1>
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
                                  <label for="nationality">Current Country Location *</label>
                              </div>
                              <div class="col-90">
                                  <input type="text" id="currentlocation" name="currentlocation" placeholder="Enter your the Country You are applying from">
                              </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <label for="gender" required>Gender *</label>
                        </div>
                        <div class="col-90">
                        <input type="text" id="gender" name="gender" placeholder="Enter your gender">
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
                    <div class="row">
                      <div class="col-10">
                          <label for="specialization">Specialization *</label>
                      </div>
                      <div class="col-90">
                        <input type="text" id="specialization" name="specialization" placeholder="Please enter your the course you want to specialize">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-10">
                          <label for="level">Academic level<br/>(Highschool,Diploma,BScs,Masters,PHD) *</label>
                      </div>
                      <div class="col-90">
                        <input type="text" id="level" name="level" placeholder="Please enter your academic level">
                      </div>
                </div>
               
            <input type = "submit" id="submit" class = "btn">

            <h5 class = "">Already have an Account<a style="color:black" href="index.php">: Click Here</a></h5>

            <h5 class = "">Signup as a<a style="color:black" href="signup_sig.php">: Signatory</a></h5>
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
