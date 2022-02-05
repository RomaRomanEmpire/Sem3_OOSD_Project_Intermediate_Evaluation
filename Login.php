<?php
// Initialize the session
session_start();
include 'autoloader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = DB_OP::get_connection();
    $con->login_attempt($_POST["username"],$_POST["password"]);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* body{
            background: rgba(240, 80, 214, 1.0);
            background: -webkit-linear-gradient(top left, rgba(240, 80, 214, 1.0), rgba(24, 35, 143, 1.0));
            background: -moz-linear-gradient(top left, rgba(240, 80, 214, 1.0), rgba(24, 35, 143, 1.0));
            background: linear-gradient(to bottom right, rgba(240, 80, 214, 1.0), rgba(24, 35, 143, 1.0));
        } */
        ::placeholder {
            color: whitesmoke;
            opacity: 1;
            font-size: 15px;
            
        }
        .hero-image {
            background-image: url("Image/nikita-kachanovsky-OVbeSXRk_9E-unsplash.jpg");
            background-color: #cccccc;
            height: 750px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            
      
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
<div class="hero-image ">
    <h1 style="font-size: 70px;padding-top:14px;font-family:'Times New Roman', Times, serif;color:#38ACEC;">Online ID Card Requesting System
</h1>
<div class="loginbox" style="margin-top:50px ;" >
    <!-- <img src="Image/icon.png" class="Idimage" > -->
    <h1></h1>
    <br>
    <h1 >Sign-in</h1>
    <br>
    <form id="signin-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <p>Username or Email address</p>
        <input type="text" name="username" value="<?php echo $_POST['username']??NULL?>" placeholder="Enter username or email">
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter Password">
        <br><br>
        <input type="submit" value="Login">

        <br>
<!--        <a href="a">Forget password</a><br>-->
        <a href="Create_Account.php">If you don't have an applicant account!!!</a>
    </form>
</div>
</div>
</body>
</html>