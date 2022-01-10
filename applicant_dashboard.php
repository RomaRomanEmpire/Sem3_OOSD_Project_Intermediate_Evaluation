<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
$applicant = unserialize($con->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$applicant->set_db($con);
$applicant->set_row_id($_SESSION['user_id']);
$already_applied = is_null($con->get_column_value("application_details", "applicant_id", "=", $_SESSION['user_id'], "app_id", ""));

if (!$already_applied) {
    ?>
    <style>#view:hover{
            background-color: rgb(17, 0, 255);
    }</style>
    <?php
}else{
    ?>
    <style>#new:hover{
            background-color: rgb(17, 0, 255);
        }</style>
    <style>#lost:hover{
            background-color: rgb(17, 0, 255);
        }</style>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
</head>

<body>


<div class="side_menu">
    <div class="barand_name">
        <h1>Dashboard</h1>
    </div>
    <div>
        <ul>

            <li><img src="Image/student.jpg" alt="">&nbsp;<span> <a href="Profile_Details.php">Profile</a></span></li>
            <li><img src="Image/notification.jpg" alt="">&nbsp;<span><a href="Applicant_notification.php">Notification</a></span></li>
            <!--   <li><img src="Image/school.png" alt="">&nbsp;<span> School</span></li> -->
            <!-- <li><img src="Image/help.png" alt="">&nbsp;<span> Help</span></li>
            <li><img src="Image/setting.png" alt="">&nbsp;<span>Setting</span></li> -->
        </ul>
    </div>
</div>

<div class="container">
    <img src="Image/A.jpg">
    <div class="header">

        <div class="nav">
            <!-- <div class="search">
                 <button type="submit"  ><img src="Image/search.png" alt=""></button>
                 <input type="text" name="" id="" placeholder="Search....">

           </div> -->
            <div class="user">


                <div class="img-case">

                </div>
                <!-- <a href=""  class="btn" >Notification</a>
                <a href=""  class="btn"> Profile</a>   -->
                <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>

            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="icon_case">
                <br><br><br><br>
                <a href="GNDivisionSelect.php?id=<?php echo 1 ?>">
<!--                    <button>Applying New Identity Card</button>-->
                    <button id="new"<?php if (!$already_applied){ ?> disabled <?php } ?>>
                        Applying New Identity Card</button>
                </a><br><br>

                <a href="GNDivisionSelect.php?id=<?php echo 2 ?>">
                    <button id="lost"<?php if (!$already_applied){ ?> disabled<?php } ?>>Applying For lost Identity Card</button>
                </a><br><br>

                <a href="Filled_Application.php?application_id=<?php echo $applicant->getApplicationId() ?>">
                    <button id="view"<?php if ($already_applied){ ?> disabled<?php } ?>>View application details in process</button>
                </a>
            </div>
        </div>

    </div>

</div>


</body>
</html>