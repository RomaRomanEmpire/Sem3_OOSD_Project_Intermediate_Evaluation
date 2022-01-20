<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();


$user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($conn);

$application = unserialize($user->fetch_value("application_details", "app_id", "=", $_GET['application_id'], "application_object"));
$application_details = $application->accept($user);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['para_1']))
        $application->setCertificationDetails($_POST['para_1'], $_POST['para_2'], $_POST['certifyName']);
    elseif (isset($_POST['certifyName2']))
        $application->setCertificationDetails2($_POST['certifyName2']);

    $application_id = $_GET['application_id'];
    //refine
    $user->updateApplicationDetails($application);
    $sign_no = $_GET['sign_no'];
    header("location: sign.php?application_id=$application_id&sign_no=$sign_no");
}


$type = $user->get_user_type();
if ($type == "applicant") {
    echo "<style>#attestation-form {
            display: none;
        }</style>";
    echo "<style>#applicant_sign {
            display: none;
        }</style>";
    echo "<style>#rap_sign {
            display: none;
        }</style>";
    echo "<style>#ds_sign {
            display: none;
        }</style>";
    if ($application_details['app_type_id'] == 1){
        echo "<style>body {
            min-height: 980%;
        }</style>";
    }else{
        echo "<style>body {
            min-height: 1200%;
        }</style>";
    }

} elseif ($user instanceof R_A_P_1) {
    $already_sent = $user->fetch_value_3('notification_details', 'application_id', 'from_id', 'n_type',
        $_GET['application_id'], $_SESSION['user_id'], 'appointment', 'n_id');
    if ($already_sent) {
        echo "<style>#send-time {
            display: none;
        }</style>";
    }
    echo "<style>#ds_sign {
            display: none;
        }</style>";

}


if ($type == "db_manager"){
    if ($application_details['app_type_id'] == 1){
        echo "<style>body {
            min-height: 1200%;
        }</style>";
    }else{
        echo "<style>body {
            min-height: 1300%;
        }</style>";
    }
}

if ($type != "admin") {

    echo "<style>#admin_approve_button {
            display: none;
        }</style>";

}
if ($user instanceof R_A_P) {
    $already_sent = $user->fetch_value_3('notification_details', 'application_id', 'from_id', 'n_type',
        $_GET['application_id'], $_SESSION['user_id'], 'confirmation', 'n_id');
    if ($already_sent) {
        echo "<style>#reject_button {
            display: none;
        }</style>";
    }
    if ($application_details['app_type_id'] == 1){
        echo "<style>body {
            min-height: 900%;
        }</style>";
    }else{
        echo "<style>body {
            min-height: 1200%;
        }</style>";
    }

}

if ($type == 'admin') {
    $already_sent = $user->fetch_value_3('notification_details', 'application_id', 'from_id', 'n_type',
        $_GET['application_id'], $_SESSION['user_id'], 'confirmation', 'n_id');
    if ($already_sent) {
        echo "<style>#reject_button {
            display: none;
        }</style>";
        echo "<style>#admin_approve_button {
            display: none;
        }</style>";
    }
}

if (!($user instanceof R_A_P_1)) {

    echo "<style>#send-time {
            display: none;
        }</style>";
}

if ($type == "db_manager" || $type == "applicant") {

    echo "<style>#reject_button {
            display: none;
        }</style>";
    echo "<style>#admin_approve_button {
            display: none;
        }</style>";

}

if (($type == "admin" || $type == "db_manager") && isset($application_details['ds_sign'])) {

    echo "<style>#ds_sign {
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
    <link rel="stylesheet" href="bootstrap.css">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <title>ID Requesting</title>
    <style>
        body {
            /* background: #21669b; */
            /* background: #667EEA; */
            /*min-height: 1000%;*/
            background: rgb(209,167,108);
            background: linear-gradient(0deg, rgba(209,167,108,1) 0%, rgba(247,207,201,1) 54%);
            background-repeat: no-repeat;
            background-size: cover;
        }

        td {
            padding-left: 10px;
            padding-right: 30px;
            /* padding-bottom: 20px; */
        }

        h1 {
            text-align: center;
            font-size: 40px;
            /*font-style: italic;*/
        }

        h2 {
            font-size: 20px;
        }

        p {
            font-size: 20px;
            font-weight: bold;
            /* align: justify; */
            padding: 10px;
            word-spacing: 10px;
            line-height: 20px;
        }

        dl {
            border: 3px double #ccc;
            padding: 5px;
        }

        dt {

            clear: left;

            text-align: left;
            font-size: 20px;
            font-weight: bold;
            color: #000;
            padding: 5px;
        }

        dd {
            padding: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid rgb(61, 57, 88);
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #b7ddee;
            border-color: rgb(1, 15, 15);
        }

        .step.active {
            display: block;
        }

        .container {
            left: 50%;
            /*padding-top: 100px; */
            margin-top: 160px;
            align-self: center;
            position: absolute;
            transform: translate(-50%);
            box-sizing: border-box;
            padding: 20px 20px;
            width: 1000px;
            background-color: lightyellow;
            /*background-image: linear-gradient(to right, #00b4db, #0083b0);*/
            border-radius: 50px;
            border-color: #000;


        }

        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 135px;
            width: 100%;
            background-color: rosybrown;
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            border: none;
            outline: none;
            background-color: midnightblue;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 30px;
            font-size: 18px;
        }

        #myBtn:hover {
            background-color: #555;
        }

        .header1 button:hover {
            background-color: white;
        }

        section{
            padding-top: 20px;
        }

    </style>


</head>

<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="header1">
    <table>
        <tbody>
        <div>
            <tr>
                <td>
                    <h1 style="text-align: center;font-size:60px; color:white;padding-right:100px; font-family: 'Times New Roman', Times, serif;">
                        Application </h1></td>
            </tr>
        </div>
        <fieldset class="input-group" style="margin-left: 10px;margin-top:70px;" disabled>
            <span class="input-group-text" style="background-color:darkkhaki;color:black;"><b>State</b></span>
            <textarea class="form-control" aria-label="With textarea"
                      style="margin-right:10px;width:100px;height:35px;background-color:white;color:black;"><?php echo $application->getState()->getState(); ?></textarea>
            <span class="input-group-text" style="background-color:darkkhaki;color:black;"><b>Applied Date</b></span>
            <textarea class="form-control" aria-label="With textarea"
                      style="margin-right:10px;width:100px;height:35px;background-color:white;color:black;"><?php echo $application->getApplyDate(); ?></textarea>
        </fieldset>
        <div>
            <div>
                <div style="top: 0px;">
                    <tr>

                        <td>

                        </td>

                        <!-- This button id only viewed by RAP -->

                        <td id="send-time" style="float: right;"><a
                                    href="Time_slot.php?application_id=<?php echo $_GET['application_id']; ?>">

                                <button type="submit" class="btn btn-sm btn-outline-primary"
                                        style="color:black;width:100px; height: 40px; font-size:15px; background-color: firebrick"><b>Send Time</b>
                                </button></td>


                        <td id="admin_approve_button"><a
                                    href="sign.php.php?sign_no=<?php echo 4; ?>&application_id=<?php echo $_GET['application_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary"
                                        style="color:black;width:150px; font-size:15px;"><b>Approve</b>
                                </button>
                            </a></td>

                        <!-- This button id only viewed by RAP -->

                        <td id="reject_button"><a
                                    href="Reject_Application.php?application_id=<?php echo $_GET['application_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary"
                                        style="color:black;width:100px; height: 40px; font-size:18px; background-color: firebrick"><b>Reject</b>
                                </button>
                            </a></td>

                        <td><a href="View_Applications_Details.php">
                                <button type="submit" class="btn btn-sm btn-outline-light fas fa-arrow-left"
                                        style="width: 100px; height: 40px; font-size:18px; color:black; background-color: #5c636a; padding-top: 10px; "><b>Back</b>
                                </button>
                            </a></td>
                    </tr>

                </div>
            </div>
        </div>
        </tbody>
    </table>
</div>
<section>
    <div class="container">


        <fieldset disabled>


            <div class="step step-1 active">
                <h2>Personal Details</h2>
                <div class="Form-group">
                    <dl>
                        <dt>Name in full</dt>
                        <dd><b><label for="familyName">Family Name</label></b></dd>
                        <dd><input type="text" id="familyNname" name="familyName"
                                   value="<?php echo $application_details['familyName']; ?>"></dd>
                        <dd><b> <label for="name">Name</label></b></dd>
                        <dd><input type="text" id="name" name="name" value="<?php echo $application_details['name']; ?>" required></dd>
                        <dd><b> <label for="surname">Surname</label></b></dd>
                        <dd><input type="text" id="surname" name="surname"
                                   value="<?php echo $application_details['surname']; ?>"></dd>
                    </dl>
                </div>
                <div class="Form-group">
                    <dl>
                        <dt>Name to be appeared in the Identity Card</dt>
                        <dd><b><label for="familyName">Family Name</label></b></dd>
                        <dd><input type="text" id="familyNname" name="familyName"
                                   value="<?php echo $application_details['familyName']; ?>"></dd>
                        <dd><b> <label for="name">Name</label></b></dd>
                        <dd><input type="text" id="name" name="name" value="<?php echo $application_details['name']; ?>" required></dd>
                        <dd><b> <label for="surname">Surname</label></b></dd>
                        <dd><input type="text" id="surname" name="surname"
                                   value="<?php echo $application_details['surname']; ?>" ></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt>Sex</dt>
                        <dd><input type="text" id="gender_" name="gender"
                                   value="<?php echo $application_details['gender']; ?>" required></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt>Civil Status</dt>
                        <dd><input type="text" id="civilStatus_" name="civilStatus"
                                   value="<?php echo $application_details['civilStatus']; ?>" required></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="profession">Profession/Occupation/Designation</label></b></dt>
                        <dd><input type="text" id="profession" name="profession"
                                   value="<?php echo $application_details['profession']; ?>"
                                   required></dd>
                    </dl>
                </div>


            </div>

            <div class="step step-2">
                <h2>Details of Birth</h2>
                <div class="Form-group">
                    <dl>
                        <dt><b><label for="birthday">BirthDay</label></b></dt>
                        <dd><input type="date" id="birthday" name="birthday"
                                   value="<?php echo $application_details['birthday']; ?>" required></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="certificateNo">Birth Certificate No</label></b></dt>
                        <dd><input type="number" id="certificateNo" name="birthCertificateNo"
                                   value="<?php echo $application_details['birthCertificateNo']; ?>"></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="placeOfBirth">Place of Birth</label></b></dt>
                        <dd><input type="text" id="placeOfBirth" name="placeOfBirth"
                                   value="<?php echo $application_details['placeOfBirth']; ?>"></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="division">Division</label></b></dt>
                        <dd><input type="text" id="division" name="birthDivision"
                                   value="<?php echo $application_details['birthDivision']; ?>">
                        </dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="district">District</label></b></dt>
                        <dd><input type="text" id="district" name="birthDistrict"
                                   value="<?php echo $application_details['birthDistrict']; ?>">
                        </dd>
                    </dl>
                </div>

                <h5 style="font-size: 18px;">If the applicant is born outside of Sri Lanka, details of Citizenship
                    Certificate issued under
                    Section 5(2) of the Citizenship Act, No.18 of 1948 </h5>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="countryOfBirth">Country of Birth</label></b></dt>
                        <dd><input type="text" id="countryOfBirth" name="countryOfBirth"
                                   value="<?php echo $application_details['countryOfBirth']; ?>"></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="city">City</label></b></dt>
                        <dd><input type="text" id="city" name="birthCity"
                                   value="<?php echo $application_details['birthCity']; ?>">
                        </dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="certificateNo">Certificate No.</label></b></dt>
                        <dd><input type="number" id="certificateNo" name="f citizenshipCertificateNo"
                                   value="<?php echo $application_details['citizenshipCertificateNo']; ?>">
                        </dd>
                    </dl>
                </div>


            </div>

            <div class="step step-3">
                <h2>Details of Residence</h2>
                <div class="Form-group">
                    <dl>
                        <dt>Permanent Address</dt>
                        <dd><b><label for="houseName">Name or number of the House</label></b></dd>
                        <dd><input type="text" id="houseName" name="permHouseName"
                                   value="<?php echo $application_details['permHouseName']; ?>" required></dd>
                        <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                        <dd><input type="text" id="road" name="permRoad"
                                   value="<?php echo $application_details['permRoad']; ?>"
                                   required></dd>
                        <dd><b> <label for="village">Village/City</label></b></dd>
                        <dd><input type="text" id="village" name="permVillage"
                                   value="<?php echo $application_details['permVillage']; ?>"
                                   required>
                        </dd>
                        <dd><b> <label for="village">Postal Code</label></b></dd>
                        <dd><input type="number" id="postalCode" name="permPostalCode"
                                   value="<?php echo $application_details['permPostalCode']; ?>"
                                   required>
                        </dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt>Postal Address</dt>
                        <dd><b><label for="houseName">Name or number of the House</label></b></dd>
                        <dd><input type="text" id="houseName" name="postalHouseName"
                                   value="<?php echo $application_details['postalHouseName']; ?>"
                                   required></dd>
                        <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                        <dd><input type="text" id="road" name="postalRoad"
                                   value="<?php echo $application_details['postalRoad']; ?>"
                                   required></dd>
                        <dd><b> <label for="village">Village/City</label></b></dd>
                        <dd><input type="text" id="village" name="postalVillage"
                                   value="<?php echo $application_details['postalVillage']; ?>"
                                   required>
                        </dd>
                        <dd><b> <label for="village">Postal Code</label></b></dd>
                        <dd><input type="number" id="postalCode" name="postalPostalCode"
                                   value="<?php echo $application_details['postalPostalCode']; ?>"
                                   required></dd>
                    </dl>
                </div>


            </div>

            <div class="step step-4">
                <h2> Details of Citizenship Certificate /Dual Citizenship Certificate</h2>

                <div class="Form-group">
                    <dl>
                        <dt><label for="Account_Type">Account Type</label></dt>

                        <dd><input type="text" name="citizenshipCertificateType"
                                   value="<?php echo $application_details['citizenshipCertificateType']; ?>"></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="certificateNo">Certificate Number</label></b></dt>
                        <dd><input type="number" id="certificateNo" name="certificateNo_9"
                                   value="<?php echo $application_details['certificateNo_9']; ?>"></dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="certificateDate">Date of issue of Certificate </label></b></dt>
                        <dd><input type="date" id="certificateDate" name="citizenshipCertificateDate"
                                   value="<?php echo $application_details['citizenshipCertificateDate']; ?>">
                        </dd>
                    </dl>
                </div>

                <h2>Details for inquiries</h2>
                <div class="Form-group">
                    <dl>
                        <dt><b><label for="telephoneNo">Telephone Number</label></b></dt>
                        <dd><b><label for="residence">Residence</label></b></dd>
                        <dd><input type="tel" id="residence" name="residenceTelNo"
                                   value="<?php echo $application_details['residenceTelNo']; ?>">
                        </dd>
                        <dd><b><label for="mobile">Mobile</label></b></dd>
                        <dd><input type="tel" id="mobile" name="mobileTelNo"
                                   value="<?php echo $application_details['mobileTelNo']; ?>">
                        </dd>
                    </dl>
                </div>

                <div class="Form-group">
                    <dl>
                        <dt><b><label for="email">Email</label></b></dt>
                        <dd><input type="email" id="email" name="email"
                                   value="<?php echo $application_details['email']; ?>">
                        </dd>
                    </dl>
                </div>


            </div>

            <div class="step step=5">
                <dl>
                    <div class="Form-group">
                        <h2>Photographs</h2>

                        <?php
                        $receive_file = $application_details['photograph'];
                        echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?>

                    </div>
                </dl>

            </div>

            <div class="step step-6">
                <h2>Attestation of the Certifying Officer</h2>

                <dl>
                    <dt><b><label for="receiptNo">Number of the receipt or the certificate</label></b></dt>
                    <dd><input type="number" id="receiptNo" name="receiptNo"
                               value="<?php echo $application_details['receiptNo']; ?>" required></dd>
                </dl>

                <dl>
                    <div>
                        <?php
                        $receive_file = $application_details['receipt'];
                        echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?>
                    </div>
                </dl>


            </div>

            <?php if ($application_details['app_type_id'] == 2) { ?>
                <div class="step step-7">
                    <h2>If the duplicate of the Identity Card is applied for, please complete this section.</h2>

                    <div class="Form-group">
                        <dl>
                            <dt>Purpose of application</dt>
                            <dd><label for="purpose"></label>
                                <input type="text" id="purpose" name="purpose"
                                       value="<?php echo $application_details['purpose']; ?>">
                        </dl>
                    </div>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="lostIdNum">Lost or last obtained Identity Card Number</label></b>
                            </dt>
                            <dd><input type="text" id="lostIdNum" name="lostIdNum"
                                       value="<?php echo $application_details['lostIdNum']; ?>">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="lostIdDate">Date of the issue of the Identity Card</label></b></dt>
                            <dd><input type="date" id="lostIdDate" name="lostIdDate"
                                       value="<?php echo $application_details['lostIdDate']; ?>">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="policeStationDetails">Details of the police report or other document
                                        pertaining to the lost Identity Card</label></b></dt>
                            <dd><b><label for="policeStationName">Name of the Police Station</label></b></dd>
                            <dd><input type="text" id="policeStationName" name="policeStationName"
                                       value="<?php echo $application_details['policeStationName']; ?>">
                            </dd>
                            <dd><b><label for="policeReportDate">Date of the issue of the Police report</label></b>
                            </dd>
                            <dd><input type="date" id="policeReportDate" name="policeReportDate"
                                       value="<?php echo $application_details['policeReportDate']; ?>">
                            </dd>
                        </dl>
                    </div>

                </div>
            <?php } ?>
        </fieldset>
        <form id="attestation-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?
        application_id=<?php echo $_GET['application_id']; ?>&sign_no=<?php echo 1; ?>" method="POST">
            <fieldset <?php if (isset($application_details['para_1'])) { ?>disabled<?php } ?>>

                <div class="step step-8" style="display: block;">
                    <h2>Attestation of the Certifying Officer</h2>

                    <dl>
                        <p style="font-size: 16px;">I hereby certify that the photograph affixed to this application and
                            details furnished in
                            this
                            application form are of <input type="number" id="applicationNum" name="para_1"
                                                           style="width:300px"
                                                           value="<?php echo $application_details['para_1'] ?? NULL; ?>"
                                                           placeholder="Application Number" required>
                            residing at the address mentioned in the application form bearing number <input type="text"
                                                                                                            id="applicantName"
                                                                                                            name="para_2"
                                                                                                            style="width:300px"
                                                                                                            value="<?php echo $application_details['para_2'] ?? NULL; ?>"
                                                                                                            placeholder="Applicant Name"
                                                                                                            required>
                            and that the photograph affixed is duplicating the natural status of the applicant without
                            disguise or concealment. I certify that I have placed my signature and official franh and
                            that
                            the applicant placed his signature impression before me.</p>
                    </dl>

                    <dl>
                        <dt><b><label for="certifyName">Name of the Certifying Officer</label></b></dt>
                        <dd><input type="text" id="certifyName" name="certifyName"
                                   value="<?php echo $application_details['certifyName'] ?? NULL; ?>"
                                   placeholder="Name of the Certifying Officer" required></dd>
                    </dl>

                    <div id="applicant_sign">
                        <dl>
                            <dt><b><label for="certifySignature1">Signature of the applicant</label></b><br>

                                <?php
                                $receive_file = $application_details['applicant_sign'] ?? NULL;
                                if (isset($receive_file)) {
                                    echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\" width=100px height=100px>";
                                } else {
                                    ?>
                                    <button type="submit" class="btn btn-sm btn-outline-success " style="color: black;">
                                        <b>
                                            Add the signature </b></button>

                                <?php } ?>
                            </dt>
                        </dl>
                    </div>
                </div>
            </fieldset>
        </form>
        <div id="rap_sign">
            <dl>
                <dt><b><label for="certifySignature2">Signature and official frank of the certifying
                            Officer</label></b><br>
                    <?php
                    $receive_file = $application_details['rap_sign'] ?? NULL;
                    if (isset($receive_file)) {
                        echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
                        <embed src=\"$receive_file\" width=100px height=100px>";

                    } else {
                        ?>
                        <a href="sign.php?sign_no=<?php echo 2; ?>&application_id=<?php echo $_GET['application_id'] ?>">
                            <button type="button" class="btn btn-sm btn-outline-success " style="color: black;">
                                <b>
                                    Add the signature </b></button>
                        </a>

                    <?php } ?>
                </dt>

            </dl>
        </div>
        <div id="ds_sign">
            <form id="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?
        application_id=<?php echo $_GET['application_id']; ?>&sign_no=<?php echo 3; ?>" method="POST">
                <dl>
                    <dt><b><label for="certifyName2">Name of the Certifying Officer</label></b></dt>
                    <dd><input type="text" id="certifyName2" name="certifyName2"
                               value="<?php echo $application_details['certifyName2'] ?? NULL; ?>"
                               placeholder="Name of the Certifying Officer" required></dd>
                </dl>
                <dl>
                    <dt><b><label for="certifySignature3">Signature and official frank of the certifying
                                Officer</label></b><br>
                        <?php
                        $receive_file = $application_details['ds_sign'] ?? NULL;
                        if (isset($receive_file)) {
                            echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
                        <embed src=\"$receive_file\", width=100px height=100px>";

                        } else { ?>

                            <button type="submit" class="btn btn-sm btn-outline-success " style="color: black;"><b>
                                    Add
                                    the signature </b></button>
                        <?php } ?>
                    </dt>

                </dl>


                <!-- <button type="submit" class="submit-btn">Submit</button> -->
                <!--    </form>-->
            </form>
        </div>
    </div>

</section>
<script>
    mybutton = document.getElementById("myBtn");

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</body>

</html>
