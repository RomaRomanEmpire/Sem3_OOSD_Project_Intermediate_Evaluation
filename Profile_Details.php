<?php
session_start();
include 'autoloader.php';
$id = $_SESSION['user_id'];
$conn = DB_OP::get_connection();
$user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($conn);
$user->set_row_id($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "functions.php";
    if (isset($_POST['pwd_checkbox'])) {
        if (!password_verify($_POST['prev_pwd'], $user->get_user_pwd())) {
            echo "<script type='text/javascript'>alert('previous password is not matched!'); window.location.href = 'Profile_Details.php';</script>";
        }
    }
    $user->update_fields($_POST,checkFileValidity("profile_photo")??NULL);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Profile</title>
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="Javascipt_File.js"></script>
    <style>
        /* .profile-pic-div{
            height: 200px;
            width: 200px;
            position: absolute;
            top : 50%;
            left : 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid grey;

        }

        #photo{
            height : 100%;
            width: 100%;
        } */

        #file {
            display: none;
        }

        #uploadBtn {
            height: 40px;
            width: 60%;
            position: relative;
            bottom: 0;
            top: 55%;
            /*left: 30%;*/
            border: 1px solid;
            /* transform: translateX(-50%); */
            /* text-align: center; */
        }
    </style>
</head>
<body style=" background: rgba(32, 26, 122, 0.486);">
<div class="side_menu2">
    <br> <br>

    <div style="color: whitesmoke; font-size: larger;   padding-left: 80px;margin-top:50px;">
        <h1 class="display-3" style="font-family: 'Times New Roman', Times, serif; text-align: left;">Profile</h1>

        <div class="profile-pic-div">
            <img id="photo" src="<?php echo $user->getPfPhoto() != null ?$user->getPfPhoto():'Image/Profile.jpg';?>"
                 style="width: 80px;height: 80px;border-radius: 50%;   margin-left: 40px; margin-right: 20px;">
        </div>
        <form id="add-staff-form" onsubmit="return (required() && PasswordValidity())"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div style="margin-top: 50px;">
                <div class="mb-3 form-check">
                    <input name="pf_checkbox" type="checkbox" value="checked" class="form-check-input" id="EditProfile"
                           onchange="Edit_Profile()">
                    <!-- This function use to edit the profile details of the user -->
                    <label class="form-check-label" for="EditProfile">Update Account Deatils</label>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="pwd_checkbox" value="checked" class="form-check-input"
                           id="ChangePassword"
                           onclick="Change_Password()">
                    <label class="form-check-label" for="ChangePassword">Change Password</label>
                </div>
            </div>
    </div>
    <br>
</div>
<div class="container">
    <div class="header1" style="z-index: 4;background-color:#03031b;">
        <div>
            <a href="dashboard.php">
            <button type="button" class="btn btn-outline-light fas fa-arrow-left" id="Back" >Back</button>
            </a>
        </div>
    </div>
    <div style="padding: 100px; " class="Profile_box">

        <h1 class="display-3" style="font-family: 'Times New Roman', Times, serif; text-align: left;">About</h1>
        <br>

        <fieldset id="Profile" disabled>
            <div class="mb-3">
                <label for="InputFName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="InputFName" name="fname" aria-describedby="InputFName"
                       value="<?php echo $user->get_full_name() ?>"
                       style=" background: transparent; border: 1px solid rgb(252, 251, 251);">
            </div>
            <div class="mb-3">
                <label for="InputUName" class="form-label">UserName</label>
                <input type="text" class="form-control" id="InputUName" name="uname" aria-describedby="InputUName"
                       value="<?php echo $user->get_user_name() ?>"
                       style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">

            </div>
           <br>
            <div class="form-group" style=" margin-bottom:40px;">
                
                <label for="file" id="uploadBtn" style="width: 200px; height:35px;border-color:white;padding-top:5px;padding-left:10px;border-radius:5px;" >Choose A Profile Photo</label>
                <input type="file" class="form-control-file" name="profile_photo" id="file">
            </div>
            <div class="mb-3">
                <label for="InputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" id="InputEmail1" name="email" aria-describedby="emailHelp"
                       value="<?php echo $user->get_user_email() ?>"
                       style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">

            </div>
            <div class="mb-3">
                <label for="InputMNumber" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="InputMNumber" name="mobile_no"
                       aria-describedby="InputMNumber" value="<?php echo $user->get_mobile_no() ?>"
                       style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">

            </div>
            <div class="mb-3">
                <label for="InputBDay" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="InputBDay" name="bday" aria-describedby="InputBDay"
                       value="<?php echo $user->get_bday() ?>"
                       style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">
            </div>
        </fieldset>
        <fieldset id="CPassword" style="display: none;">
            <div class="mb-3">
                <label for="InputPPassword" class="form-label">Previous Password</label>
                <input type="password" class="form-control" name="prev_pwd" id="InputPPassword"
                       aria-describedby="InputPPassword"
                       style=" background: transparent; border: 1px solid rgb(252, 251, 251);">
            </div>
            <div class="mb-3">
                <label for="InputNPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_pwd" id="InputNPassword"
                       aria-describedby="InputNPassword"
                       style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;"
                       onkeyup="verifyPassword()" >
                <meter min="1" max="100" value="0" low="0" high="0" id="grade"></meter>
                <span id="msg"></span>
            </div>
            <div class="mb-3">
                <label for="InputCPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="new_pwd" id="InputCPassword"
                       aria-describedby="InputNPassword"
                       style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;"
                        onchange="PasswordValidity()">
                
            </div>
        </fieldset>

        <fieldset id="Submit_button" style="display: none;">
            <button type="submit" name="submit" class="btn btn-primary" id="data" >Submit</button>
            <!-- <input type="submit" value="Submit"> -->
        </fieldset>
        </form>
    </div>
</div>

<script>
    const imgDiv = document.querySelector("profile-pic-div");
    const img = document.querySelector('#photo');
    const file = document.querySelector('#file');
    const uploadBtn = document.querySelector('#uploadBtn');

    // imgDiv.addEventListener('mouseenter', function(){
    //     uploadBtn.style.display = "block";
    // });

    // imgDiv.addEventListener('mouseleave', function(){
    //     uploadBtn.style.display = "none";
    // });

    file.addEventListener('change', function () {
        const choosedFile = this.files[0];

        if (choosedFile) {
            const reader = new FileReader();

            reader.addEventListener('load', function () {
                img.setAttribute('src', reader.result);
            });

            reader.readAsDataURL(choosedFile);
        }
    });

</script>
</body>
</html>