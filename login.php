<?php isset($_SESSION) || session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Login</title>
    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">
    
  </head>

  <body id = "home">

    

    <div class = "intro-header">
      <div class = "text-center">
        <div class="text">
          <h1 class = "">SMS</h1>
          <h3 class = "">Scholarship Management System </h3>
          <h3 class ="">Log in to your Scholarship Portal</h3>
        </div>
        <div class="login">
          <form action="backend/login.php" method="POST" name="login" onsubmit="return validateControls()">
            <div class="row">
                      <div class="col-10">
                          <label for="email">Email *</label>
                      </div>
                      <div class="col-90">
                          <input type="text" id="email" name="email" placeholder="Enter your email address">
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
            <input type = "submit" value="Login" class = "btn">
            <h5 class = "">Don't have an Account<a style="color:black" href="signup.php">: Click Here</a></h5>
            <h5 class = ""><a style="color:black" href="forgotpassword.php"><u>Forgot Password</u></a></h5>
          </form>
          <?php if (!empty($_SESSION['errMsg'])) { ?>
              <div class = "">
                <div class="" style="margin-top:20px;">
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
