<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();

$nic_issuer = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$nic_issuer->set_db($conn);
$application = unserialize($nic_issuer->fetch_value("application_details", "app_id", $_GET['application_id'], "application_object"));
$application_details = $application->accept($nic_issuer);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_id = $nic_issuer->fetch_value("application_details", "app_id", $_GET['application_id'], "applicant_id");
    $nic_issuer->issue_NIC($applicant_id, $application, $_POST);
    header("location:DBM_NI_visitables.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Account Creating</title>
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <style>
        input[type=submit] {
            width: 100%;
            background-color: rgb(83, 139, 100);
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: rgb(30, 17, 71);
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid rgb(61, 57, 88);
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #bcc5c9;
            border-color: rgb(1, 15, 15);


        }

        ::placeholder {
            color: black;
        }

        .div1 {
            border-radius: 5px;
            background: rgba(0, 0, 0, 0.5);
            top: 470px;
            left: 50%;
            margin-top: 80px;
            position: absolute;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            padding: 20px 20px;
            width: 1220px;
            height: 900px;
            padding-bottom: 20px;
            bottom: 200px;
            z-index: 2;
            color: whitesmoke;

        }

        td {
            font-size: 20px;
            text-align: left;
        }

        body {
            min-height: 100vh;
        }

        label {
            font-size: 20px;
            font-weight: bolder;
        }

        .header1 {
            position: absolute;
            top: 0;
            right: 0;
            height: 80px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;
            background: rgba(0, 0, 0, 0.5);

        }

        h1 {
            text-align: center;
            color: whitesmoke;
        }

        ::placeholder {
            color: black;
            opacity: 1;
            font-size: 15px;
        }

        .hero-image {
            background-image: url("Image/lee-campbell-DtDlVpy-vvQ-unsplash.jpg");
            background-color: #cccccc;
            height: 1000px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;

        }

    </style>

</head>
<body>
<div class="hero-image">
    <div class="header1">

        <div style="justify-content: center;margin-right:460px;margin-top:5px;"><b><h1
                        style="font-size:60px;font-family:'Times New Roman', Times, serif">NIC Details</h1></b>
        </div>
        <a href="DBM_NI_visitables.php">
            <button class="btn btn-outline-light fas fa-arrow-left" id="Back"
                    style="width: 140px;margin-top:5px;margin-right:8px; ">

                Back
            </button>
        </a>


    </div>
    <div class="div1">
        <form id="ID_details_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?application_id=<?php echo $_GET["application_id"];?>" disabled="disabled" method="POST">
            <fieldset  disabled>

                <!-- <h1><span id="msgx"></span></h1> -->
                <b> <label for="full_nameid">Full Name</label></b>
                <input type="text" id="full_nameid" name="fullname" style="font-weight: 1000;"
                       value="<?php echo $application_details['familyName'] . ' ' . $application_details['name'] . ' ' . $application_details['surname']; ?>">
                <br>
                <b> <label for="photoid">Photograph</label></b>
                <input type="hidden" id="photoid" name="photograph" style="font-weight: 1000;" value="<?php echo $application_details['photograph']; ?>">
                <?php
                $receive_file = $application_details['photograph'];
                echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?>

                <br>
                <b> <label for="genid">Gender</label></b>
                <input type="text" id="genid" name="gender" style="font-weight: 1000;" value="<?php echo $application_details['gender']; ?>">
                <br>
                <b> <label for="BDateid">Birthday</label></b>
                <input type="date" id="BDateid" name="birthday" style="font-weight: 1000;" value="<?php echo $application_details['birthday']; ?>">
                <br>
                <b> <label for="Bplaceid">Birth Place</label></b>
                <input type="text" id="Bplaceid" name="bPlace" style="font-weight: 1000;"
                       value="<?php echo $application_details['placeOfBirth'] ?? $application_details['birthCity'] . ', ' . $application_details['countryOfBirth']; ?>">
                <br>
                <b> <label for="address_">Address</label></b>
                <input type="text" id="address_" name="address" style="font-weight: 1000;"
                       value="<?php echo $application_details['permHouseName'] . ', ' . $application_details['permRoad'] . ', ' . $application_details['permVillage']; ?>">
                <br>
                <b> <label for="jobid">Job</label></b>
                <input type="text" id="jobid" name="job" style="font-weight: 1000;" value="<?php echo $application_details['profession']; ?>">
                <br>

            </fieldset>
            <input type="submit" id="button" style="font-size: 17px;color:whitesmoke;font-weight:bolder;">
            <br>
            <br>
        </form></div>
</div>
</body>
</html>
