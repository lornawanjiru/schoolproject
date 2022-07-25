<?php isset($_SESSION) || session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- The <meta> tag defines metadata about an HTML document. Metadata is data (information) about data.
   <meta> tags always go inside the <head> element, and are typically used to specify character set, page description,
     keywords, author of the document, and viewport settings. -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Home</title>  
    

    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">
    
  </head>

  <body id = "home">
     <div class = "nav">
        <div class="topnav" id="myTopnav">
        <div class="header"><a>Scholarship Application System</a> </div>
            <div>
                <a href="login.php">Login</a>
                <a href="signup_sig.php">Signatory</a>
                <a href="signup_student.php">Students</a>
                <a href="#">Home</a>
                <a href="" class="icon" onclick="myFunction()">
                <img src="images/menu.png" alt="" />
                </a>
            </div>
        </div>
     </div>
     <div class="container">
         <div class="hero">
            <div class="hero-image">
                <img src="images/hero.jpg" alt="" />
            </div>
            <div class="hero-content">
                <h1>Your Are Only one Step Away from fulfilling your goals</h1>
                <a href="login.php"> <input type = "submit" value="Register Now" class = "btn"> </a>
            </div>
         </div>
         <div class="users">  
            
           <h1>WHY US ?</h1>      
           <div class="scholars">
             <h2>STUDENTS</h2>
             <hr/>
             <div class="flex">
              <div class="text">
                <h3>JOIN YOUR <span class = "colour"> DREAM SCHOOL </span> BY THE HELP OF ONE APPLICATION</h3>
                <p>Applying for scholarships is overwhelming
                      But without scholarships, your ability to go to college is at risk.
                      </br> </br>
                      Students should be able to focus on their education rather than worrying about how to pay for it.
                      </br> </br>
                      We know it’s not fair.
                      <br/>
                      And because of that we are pleased to inform you that this application comes with so many benefits:- 
                </p>
              </div>
                <div class="pad students-card">
                  <div class="scholar-cards">
                    <h3>Personalized vetted scholarship matches</h3>
                    <p>Get matched to scholarships that are most relevant to you. View scholarship credibility scores to know where to focus your time and energy.</p>
                  </div>
                  <div class="scholar-cards">
                    <h3>Apply without leaving the platform</h3>
                    <p>The entire search, match and application process happens all in one place. You can even write, edit and proof your essays right in the platform!</p>
                  </div>
                  <div class="scholar-cards">
                    <h3>Easy UI hence making it fun to use.</h3>
                    <p>Scholarship searches can be messy, but not with Scholars. Sort and filter your matches. Favorite the scholarships you like best, and hide the ones you don’t.</p>
                  </div>
            
                </div>
             </div>
            
              <a href="signup_sig.php"> <input type = "submit" value="Student" class = "btn"> </a>
           </div>
           <div class="institution">
              <h2>INSTITUTES</h2> 
              <hr/>
              <div class="text">
              <h3>YOUR DONT KNOW HOW TO MANAGE YOUR ON COMING <span class = "colour"> APPLICATIONS? </span> BY THE HELP OF THIS APPLICATION YOU CAN GET TO KNOW YOUR APPLICATES EASILY.</h3>
              <p>So more applications shouldnt be a bother to your institution. 
                     </br> </br>
                     With our help you will be able to manage your applications and respond to your applicants in the shortest time possible.
                     </br> </br>
                   You will manage to inform your applicants of any changes in time and directly without a third party. 
                    <br/>
                    
              </p>
              </div>
              <a href="signup_sig.php"> <input type = "submit" value="Instituation" class = "btn"> </a>
           </div>
         </div>
         <div class="testimonies">
           <h1>OUR TESTIMONIES</h1>
           <div class="pad">
           <div class="cards">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample3.jpg" alt="profile-sample3" class="profile" />
            <div>
              <h2>Eleanor Crisp</h2>
              <h4>UX Design</h4>
              <p>Dad buried in landslide! Jubilant throngs fill streets! Stunned father inconsolable - demands recount!</p>
            </div>
          </div>
          <div class="cards">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample5.jpg" alt="profile-sample5" class="profile" />
            <div>
              <h2>Gordon Norman</h2>
              <h4>Accountant</h4>
              <p>Wormwood : Calvin, how about you? Calvin : Hard to say ma'am. I think my cerebellum has just fused. </p>
            </div>
          </div>
          <div class="cards">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample6.jpg" alt="profile-sample6" class="profile" />
            <div>
              <h2>Sue Shei</h2>
              <h4>Public Relations</h4>
              <p>The strength to change what I can, the inability to accept what I can't and the incapacity to tell the difference.</p>
            </div>
          </div>
           </div>
          
         </div>
         <div class="system">
           <div>
             <h1>SNEAK-PEAK OF THE SYSTEM</h1>
             <div class="text">
             <h2>
               All in one application. You can call it the scholarship aggregator.Earn scholarships or scholants with the only platform that truly boosts your chances. Focus your efforts, save time and get money.
             </h2>
             </div>
             <img src="images/bg3.jpg" alt="" />
           </div>   
         </div>
         <div class="footer">
            <h3>SCHOLARSHIP MANAGEMENT SYSTEM</h3>
            <p>copyright &copy;2022</p>
         </div>
     </div>
    <!-- JavaScript -->
    <script src="js/script.js"></script>
  </body>
</html>