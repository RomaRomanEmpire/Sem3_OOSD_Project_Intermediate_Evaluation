<?php
// Initialize the session
session_start();
include 'autoloader.php';
$username_email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username_email = $_POST['username'];
      $con = DB_OP::get_connection();
      $stat = $con->login_attempt($_POST["username"],$_POST["password"]);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <link rel="stylesheet" type="text/css" href="style.css">
      <style>
            body{
                  background: rgba(240, 80, 214, 1.0);
background: -webkit-linear-gradient(top left, rgba(240, 80, 214, 1.0), rgba(24, 35, 143, 1.0));
background: -moz-linear-gradient(top left, rgba(240, 80, 214, 1.0), rgba(24, 35, 143, 1.0));
background: linear-gradient(to bottom right, rgba(240, 80, 214, 1.0), rgba(24, 35, 143, 1.0));
            }
      </style>
</head>
<body>
      <!-- <div class="background_image">
            <div class="Back_img">
                  <div>
                        <img src="Image/C.jpg" >
                  </div>
            </div>
      </div> -->

      <div class="loginbox" >
            <img src="Image/icon.png" class="Idimage" >
            <br>
            <h1 >Login Here</h1>
            <br>
            <form id="signin-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                  <p>Username or Email address</p>
                  <input type="text" name="username" value="<?php echo($username_email)?>" placeholder="enter username or email">
                  <p>Password</p>
                  <input type="password" name="password" placeholder="Enter Password">
                  <br><br>
                  <input type="submit" value="Login">

                  <br>
                  <a href="a">Forget password</a><br>
                  <a href="Create_Account.php">If you don't have account!!!</a>
            </form> 
      </div>
</body>
</html>