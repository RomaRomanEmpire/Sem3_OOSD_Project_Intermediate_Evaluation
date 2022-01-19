<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
$user = unserialize($con->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($con);
$user->set_row_id($_SESSION['user_id']);

$u_type = $user->get_user_type();


if ($u_type === "applicant") {
    $already_applied = is_null($con->get_column_value("application_details", "applicant_id", "=", $_SESSION['user_id'], "app_id", ""));

    if (!$already_applied) {
        echo "<style>#view:hover{
            background-color: rgb(17, 0, 255);
    }</style>";

    } else {
        echo "<style>#new:hover{
            background-color: rgb(17, 0, 255);
        }</style>";
        echo "<style>#lost:hover{
            background-color: rgb(17, 0, 255);
        }</style>";
    }
    echo "<style>#notification-panel1{
            display: none;
     }</style>";
} else {
    echo "<style>#notification-panel{
            display: none;
     }</style>";
}
if(!($user instanceof R_A_P) || $u_type !== 'admin'){
    echo "<style>#notification-panel1{
            display: none;
     }</style>";
}
if($u_type!= 'db_manager'){
    echo "<style>#add-staff{
            display: none;
     }</style>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <script src="../Javascipt_File.js"></script>
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <style>
        h1{
    font-size: 50px;
    font-family: 'Times New Roman', Times, serif;
}
    </style>
</head>

<body>

<div class="hero-image">
<div class="side_menu" style="background: rgba(0,0,0,0.5);">
    <div class="barand_name">
        <h1>Dashboard</h1>
    </div>
    <div>
        <ul>

            <a href="Profile_Details.php"> <li>&nbsp;<span>  <i class="fas fa-user"></i> Profile</span></li></a>
            <a href="Applicant_notification.php"><li id="notification-panel">&nbsp;<span><i class="far fa-comment-alt"></i> Notification</span></li></a>
            <a href="Notification_dashboard.php"><li id="notification-panel1">&nbsp;<span><i class="far fa-comment-alt"></i> Notification</span></li></a>
            <a href="Add_staff_member.php" ><li id="add-staff">&nbsp;<span>
            <i class="fas fa-user-plus"></i> Add Officer </span></li></a>
        </ul>
    </div>
</div>

<div class="container" >
    <!-- <img src="Image/Q.jpg"> -->
    <div class="header" style="background: rgba(0,0,0,0.5);">

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
                <a href="logout.php" class="btn" ><i class="fas fa-sign-out-alt"></i> Log Out</a>

            </div>
        </div>
    </div>
    <div class="content" >
        <?php if ($u_type == "applicant") { ?>
            <div class="card" style="margin-left: 100px; padding-bottom: 100px; " >

            <div id="applicant-links" class="icon_case">
                <br><br><br><br>
                <a href="GNDivisionSelect.php?id=<?php echo 1 ?>">
                    <!--                    <button>Applying New Identity Card</button>-->
                    <button id="new"<?php if (!$already_applied) { ?> disabled <?php } ?>>
                    <i class="fas fa-hand-point-right"></i> Applying New Identity Card
                    </button>
                </a><br><br><br>

                <a href="GNDivisionSelect.php?id=<?php echo 2 ?>">
                    <button id="lost"<?php if (!$already_applied) { ?> disabled<?php } ?>> <i class="fas fa-hand-point-right"></i> Applying For lost Identity
                        Card
                    </button>
                </a><br><br><br>

                <a href="Filled_Application.php?application_id=<?php echo $user->getApplicationId() ?>">
                    <button id="view"<?php if ($already_applied) { ?> disabled<?php } ?>>  <i class="fas fa-hand-point-right"></i> View application details in
                        process
                    </button>
                </a>
            </div></div><?php } elseif ($u_type == "db_manager") { ?>
            <div class="card">
                <div id="db_manager-links" class="icon_case">
                    <br><br><br><br>
                    <a href="user_Details.php">
                        <button>  <i class="fas fa-hand-point-right"></i> View Database Details</button>
                    </a>
                    <br><br><br>
                    <a href="View_Applications_Details.php">
                        <button>  <i class="fas fa-hand-point-right"></i> View Application Details</button>
                    </a>
                    <br><br><br>
                    <a href="DBM_Notification.php">
                        <button>  <i class="fas fa-hand-point-right"></i>View Notification Details</button>
                    </a>
                    <br><br>
                </div>
            </div><?php } else { ?>
            <div class="card">
                <div id="rap_links" class="icon_case">
                    <br><br><br><br>
                    <a href="View_Applications_Details.php">
                        <button>  <i class="fas fa-hand-point-right"></i>View Applications Details</button>
                    </a><br><br>
                    <!-- <button>Applying For lost Identity Card </button> -->
                </div>
            </div>
        <?php } ?>
    </div>

</div>

</div>

<div>
</body>
</html>