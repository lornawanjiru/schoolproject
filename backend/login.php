<!DOCTYPE html>
<html>
<body>
<?php
isset($_SESSION) || session_start();

try {
    $flag = 1;
    // PDO Is an abstraction layer language that supports 12 databases
    $DBH = new PDO('mysql:host=localhost;dbname=sms', 'scholar', 'Github56#');

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $data = ['email' => $email];
    //Prepared statements are very useful against SQL injections.
    //explanation of this code:
    //This is a subquery of to match the upmail to the email posted when login in. This query equally states the roleId
    //hence defines the role the role of user login in.
    $STH = $DBH->prepare(
        'SELECT * FROM (SELECT studentID AS ID, upMail, password, status, 1 AS roleID FROM student UNION SELECT adminID AS ID, upMail, password, status, 2 AS roleID FROM admin UNION SELECT sigID AS ID, upMail, password, status, 3 AS roleID FROM signatory) t WHERE upMail = :email'
    );
    //Execute a prepared statement by passing an array of insert values
    $STH->execute($data);
    // The method PDO::fetchAll() will return an array with the entities found by your statement,
    // so if you use the PDO::FETCH_OBJ you will access your entites like:
    $users = $STH->fetchAll(PDO::FETCH_OBJ);
    // $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    // $result[0]->field;

    // If i wanted a property of the array i would have used PDO::FETCH_ASSOC
    // If you use the PDO::FETCH_ASSOC fetch style, you will access your entity using:

    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $result[0]['property'];
    if (
        isset($users[0]) and
        password_verify($_POST['password'], $users[0]->password)
    ) {
        // The password_verify() function can verify that given hash matches the given password.
        // Note that the password_hash() function can return the algorithm, cost, and salt as part of a returned hash.
        // Therefore, all information that needs to verify a hash that includes in it. This can allow the
        // password_verify() function to verify a hash without need separate storage for the salt or algorithm information.
        // The password_verify() function can return true, if the password and hash match, or false otherwise
        if ($users[0]->status == 'active') {
            $_SESSION['email'] = $users[0]->upMail;
            //User type -- 1 (student), 2(admin), 3(sig)
            $_SESSION['currentUserTYPE'] = $users[0]->roleID;
            $_SESSION['currentUserID'] = $users[0]->ID;
            $_SESSION['isLoggedIn'] = true;

            $sql = $DBH->prepare(
                'SELECT * FROM verify_signup WHERE upMail = :email'
            );
            $sql->execute($data);
            $user_verify = $sql->fetchAll(PDO::FETCH_OBJ);
            if (isset($user_verify[0]) and $user_verify[0]->action == 0) {
                $flag = 0; ?>
                 <script type="text/javascript">
                    alert("YOU NEED TO VERIFY EMAIL ADDRESS TO ACTIVATE YOUR ACCOUNT!");
                    location.replace("verify_signupcode.php");
                </script>
              <?php
            }
        } else {
            $flag = 0;
            $_SESSION['errMsg'] = 'Your Account is currently in INACTIVE Mode!';
            header('Location: ../index.php');
        }
    }
    $DBH = null;
    if ($flag != 0) {
        if ($_SESSION['currentUserTYPE'] == 1) {
            header('Location: ../student/tempUserHome.php');
        } elseif ($_SESSION['currentUserTYPE'] == 2) {
            header('Location: ../admin/tempAdmin.php');
        } elseif ($_SESSION['currentUserTYPE'] == 3) {
            header('Location: ../signatory/tempSigHome.php');
        } else {
            $_SESSION['errMsg'] = 'UserName or Password Incorrect!';
            header('Location: ../index.php');
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
</body>
</html>
