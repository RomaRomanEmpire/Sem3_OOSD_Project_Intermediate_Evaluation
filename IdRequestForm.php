<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "functions.php";

    $photograph = checkFileValidity("photographs");
    $receipt = checkFileValidity("receipt");
    if (!empty($photograph.$receipt)) {
        $applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
        $application = $applicant->getApplication();
        $application->setGnDivOrAddress($_GET['basic']);
        $application->setDs($_GET['ds']);
        $application->setDetails($photograph, $receipt, $_POST, $applicant, $_GET['id']);

        $applicant->set_db($conn);


        $applicant->set_row_id($_SESSION['user_id']);

        $applicant->apply_NIC($_GET['basic'], $_GET['ds'], $_GET['table'], $application);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <title>ID Requesting</title>
    <style>
        h1 {
            text-align: center;
            font-size: 30px;
            font-style: italic;
        }

        h2 {
            font-size: 20px;
            font-style: oblique;
        }

        p {
            font-size: 20px;
            font-weight: bold;
            align: justify;
            padding: 10px;
            word-spacing: 10px;
            line-height: 20px;
        }

        dl {
            border: 3px double #ccc;
            padding: 5px;
        }

        dt {
            /* float: left; */
            clear: left;
            /* width: 100px; */
            text-align: left;
            font-size: 20px;
            font-weight: bold;
            color: #000;
            padding: 5px;
        }

        dd {
            padding: 5px;
        }


        input[type="text"]:hover,
        input[type="number"]:hover,
        input[type="date"]:hover {
            border-color: #fff;
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

        ::placeholder {
            color: black;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .container {
            left: 50%;
            align-self: center;
            position: absolute;
            transform: translate(-50%);
            box-sizing: border-box;
            padding: 20px 20px;
            width: 1000px;
        }

        button.next-btn,
        button.previous-btn,
        button.submit-btn {
            float: right;
            margin-top: 20px;
            padding: 10px 30px;
            border: none;
            outline: none;
            background-color: rgb(180, 220, 255);
            font-family: 'Montserrat';
            /* font-size: 10px; */
            cursor: pointer;
            font-weight: bolder;
        }

        button.previous-btn {
            float: left;
            font-weight: bolder;
        }

        button.submit-btn {
            background-color: seagreen;
            font-weight: bolder;
        }

        /* #canvas {
            border: 2px solid black;
            box-sizing: border-box;} */

        body {
            background: linear-gradient(#21669b, #a6d8ff, #fff);
            height: 100vh;
            /*background-position: relative;*/
            background-repeat: no-repeat;
            background-size: cover;
        }

        .Button_1 {
            text-align: center;
            background-color: #a6d8ff;
            color: #000;
            font-weight: bolder;
            border: none;
            outline: none;
            width: 110px;
        }

        .header1 {
            position: absolute;
            top: 0;
            right: 0;
            height: 19vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;


        }

        .header1 button:hover {
            background: whitesmoke;
            color: #000;
        }

        .header1 button {
            width: 120px;
            font-size: 18px;
            margin-right: 20px;
            color: white;
            background-color: black;
            height: 35px;
            border-radius: 5px;
        }
    </style>


</head>

<body>
<!-- <div class="header1"><button type="submit" class="fas fa-arrow-left" onclick="goback()"> Back</button> </div> -->
<section>

    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET['id']; ?>&
        table=<?php echo $_GET['table']; ?>&basic=<?php echo $_GET['basic']; ?>&ds=<?php echo $_GET['ds']; ?>"
              method="POST" enctype="multipart/form-data">

            <div class="container">
                <!-- <h1><span id="msgx"></span></h1> -->
                <div class="step step-1 active">
                    <div class="header1"><a href="dashboard.php">
                            <button type="button" class="fas fa-arrow-left"> Back</button>
                        </a></div>
                    <h1>Application for Identity Card</h1><br>
                    <h2>Personal Details</h2>
                    <div class="Form-group">
                        <dl>
                            <dt>Name in full</dt>
                            <dd><b><label for="familyName">Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName" value="<?php echo $_POST['familyName']??NULL?>" placeholder="Family name..."
                                       required></dd>
                            <dd><b> <label for="name">Name</label></b></dd>
                            <dd><input type="text" id="name" name="name" value="<?php echo $_POST['name']??NULL?>" placeholder="Name..." required></dd>
                            <dd><b> <label for="surname">Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname" value="<?php echo $_POST['surname']??NULL?>" placeholder="Surname..." required></dd>
                        </dl>
                    </div>
                    <div class="Form-group">
                        <dl>
                            <dt>Name to be appeared in the Identity Card</dt>
                            <dd><b><label for="familyName">Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName" value="<?php echo $_POST['familyName']??NULL?>" placeholder="Family name..."
                                       required></dd>
                            <dd><b> <label for="name">Name</label></b></dd>
                            <dd><input type="text" id="name" name="name" value="<?php echo $_POST['name']??NULL?>" placeholder="Name..." required></dd>
                            <dd><b> <label for="surname">Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname" value="<?php echo $_POST['surname']??NULL?>" placeholder="Surname..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Sex</dt>
                            <dd><input type="radio" id="gender_1" name="gender" value="Male" <?php echo $_POST['gender']??NULL=='Male'?'checked':NULL?> required>
                                <label for="gender_1">Male</label>
                                <input type="radio" id="gender_2" name="gender" value="Female" <?php echo $_POST['gender']??NULL=='Female'?'checked':NULL?> required>
                                <label for="gender_2">Female</label>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Civil Status</dt>
                            <dd><input type="radio" id="civilStatus_1" name="civilStatus" value="Married" <?php echo $_POST['civilStatus']??NULL=='Married'?'checked':NULL?> required>
                                <label for="civilStatus_1">Married</label>
                                <input type="radio" id="civilStatus_2" name="civilStatus" value="Single" <?php echo $_POST['civilStatus']??NULL=='Single'?'checked':NULL?> required>
                                <label for="civilStatus_2">Single</label>
                                <input type="radio" id="civilStatus_3" name="civilStatus" value="Widowed" <?php echo $_POST['civilStatus']??NULL=='Widowed'?'checked':NULL?> required>
                                <label for="civilStatus_3">Widowed</label>
                                <input type="radio" id="civilStatus_4" name="civilStatus" value="Divorced" <?php echo $_POST['civilStatus']??NULL=='Divorced'?'checked':NULL?> required>
                                <label for="civilStatus_4">Divorced</label>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="profession">Profession/Occupation/Designation</label></b></dt>
                            <dd><input type="text" id="profession" name="profession" value="<?php echo $_POST['profession']??NULL?>" placeholder="Profession..."
                                       required></dd>
                        </dl>
                    </div>

                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-2">
                    <h2>Details of Birth</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="birthday">BirthDay</label></b></dt>
                            <dd><input type="date" id="birthday" name="birthday" value="<?php echo $_POST['birthday']??NULL?>" required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Birth Certificate No</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="birthCertificateNo"
                                       value="<?php echo $_POST['birthCertificateNo']??NULL?>" placeholder="Birth Certificate No..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="placeOfBirth">Place of Birth</label></b></dt>
                            <dd><input type="text" id="placeOfBirth" name="placeOfBirth"
                                       value="<?php echo $_POST['placeOfBirth']??NULL?>" placeholder="Place of Birth..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="division">Division</label></b></dt>
                            <dd><input type="text" id="division" name="birthDivision" value="<?php echo $_POST['birthDivision']??NULL?>" placeholder="Division..."
                                       required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="district">District</label></b></dt>
                            <dd><input type="text" id="district" name="birthDistrict" value="<?php echo $_POST['birthDistrict']??NULL?>" placeholder="District..."
                                       required>
                            </dd>
                        </dl>
                    </div>

                    <h2>If the applicant is born outside of Sri Lanka, details of Citizenship Certificate issued under
                        Section 5(2) of the Citizenship Act, No.18 of 1948 </h2>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="countryOfBirth">Country of Birth</label></b></dt>
                            <dd><input type="text" id="countryOfBirth" name="countryOfBirth"
                                       value="<?php echo $_POST['countryOfBirth']??NULL?>" placeholder="Country of Birth..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="city">City</label></b></dt>
                            <dd><input type="text" id="city" name="birthCity" value="<?php echo $_POST['birthCity']??NULL?>" placeholder="City...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Certificate No.</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="citizenshipCertificateNo"
                                       value="<?php echo $_POST['citizenshipCertificateNo']??NULL?>" placeholder="Certificate No...">
                            </dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>
                </div>

                <div class="step step-3">
                    <h2>Details of Residence</h2>
                    <div class="Form-group">
                        <dl>
                            <dt>Permanent Address</dt>
                            <dd><b><label for="houseName">Name or number of the House</label></b></dd>
                            <dd><input type="text" id="houseName" name="permHouseName"
                                       value="<?php echo $_POST['permHouseName']??NULL?>" placeholder="Name or number of the House..." required></dd>
                            <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="permRoad" value="<?php echo $_POST['permRoad']??NULL?>" placeholder="Road..." required></dd>
                            <dd><b> <label for="village">Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="permVillage" value="<?php echo $_POST['permVillage']??NULL?>" placeholder="Village..." required>
                            </dd>
                            <dd><b> <label for="village">Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="permPostalCode" value="<?php echo $_POST['permPostalCode']??NULL?>" placeholder="Postal Code..."
                                       required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Postal Address</dt>
                            <dd><b><label for="houseName">Name or number of the House</label></b></dd>
                            <dd><input type="text" id="houseName" name="postalHouseName"
                                       value="<?php echo $_POST['postalHouseName']??NULL?>" placeholder="Name or number of the House..." required></dd>
                            <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="postalRoad" value="<?php echo $_POST['postalRoad']??NULL?>" placeholder="Road..." required></dd>
                            <dd><b> <label for="village">Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="postalVillage" value="<?php echo $_POST['postalVillage']??NULL?>" placeholder="Village..." required>
                            </dd>
                            <dd><b> <label for="village">Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="postalPostalCode"
                                       value="<?php echo $_POST['postalPostalCode']??NULL?>" placeholder="Postal Code..." required></dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-4">
                    <h2> Details of Citizenship Certificate /Dual Citizenship Certificate</h2>

                    <div class="Form-group">
                        <dl>
                            <dt><label for="Account_Type">Account Type</label></dt>
                            <dd><select name="citizenshipCertificateType">
                                    <option disabled hidden <?php echo (!isset($_POST['citizenshipCertificateType']))?'selected':""?>>Select the type of the Certificate</option>
                                    <option style="text-align: center;" <?php echo $_POST['citizenshipCertificateType']??NULL=='Citizenship Certificate'?'selected':NULL?>>Citizenship Certificate</option>
                                    <option style="text-align: center;" <?php echo $_POST['citizenshipCertificateType']??NULL=='Dual Citizenship Certificate'?'selected':NULL?>>Dual Citizenship Certificate</option>
                                </select></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Certificate Number</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="certificateNo"
                                       value="<?php echo $_POST['certificateNo']??NULL?>" placeholder="Certificate Number..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateDate">Date of issue of Certificate </label></b></dt>
                            <dd><input type="date" id="certificateDate" name="citizenshipCertificateDate" value="<?php echo $_POST['citizenshipCertificateDate']??NULL?>" required></dd>
                        </dl>
                    </div>

                    <h2>Details for inquiries</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="telephoneNo">Telephone Number</label></b></dt>
                            <dd><b><label for="residence">Residence</label></b></dd>
                            <dd><input type="tel" id="residence" name="residenceTelNo" value="<?php echo $_POST['residenceTelNo']??NULL?>" placeholder="Residence..."
                                       required>
                            </dd>
                            <dd><b><label for="mobile">Mobile</label></b></dd>
                            <dd><input type="tel" id="mobile" name="mobileTelNo" value="<?php echo $_POST['mobileTelNo']??NULL?>" placeholder="Mobile..." required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="email">Email</label></b></dt>
                            <dd><input type="email" id="email" name="email" value="<?php echo $_POST['email']??NULL?>" placeholder="Email..." required>
                            </dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>
                <?php if ($_GET['id'] == 2) { ?>
                    <div class="step step-5">
                        <h2>If the duplicate of the Identity Card is applied for, please complete this section.</h2>

                        <div class="Form-group">
                            <dl>
                                <dt>Purpose of application</dt>
                                <dd><input type="radio" id="purpose1" name="purpose"
                                           value="if the Identity Card is lost" <?php echo $_POST['purpose']??NULL=='if the Identity Card is lost'?'checked':NULL?> >
                                    <label for="purpose1"> if the Identity Card is lost </label><br>
                                    <input type="radio" id="purpose2" name="purpose"
                                           value="to make changes to the Identity Card" <?php echo $_POST['purpose']??NULL=='to make changes to the Identity Card'?'checked':NULL?>>
                                    <label for="purpose2">to make changes to the Identity Card</label><br>
                                    <input type="radio" id="purpose3" name="purpose"
                                           value="to renew the period of validity" <?php echo $_POST['purpose']??NULL=='to renew the period of validity'?'checked':NULL?>>
                                    <label for="purpose3">to renew the period of validity </label><br>
                                    <input type="radio" id="purpose4" name="purpose"
                                           value="if the Identity card is damaged/ defaced /illegible" <?php echo $_POST['purpose']??NULL=='if the Identity card is damaged/ defaced /illegible'?'checked':NULL?>>
                                    <label for="purpose4"> if the Identity card is damaged/ defaced
                                        /illegible</label><br>
                                </dd>
                            </dl>
                        </div>
                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="lostIdNum">Lost or last obtained Identity Card Number</label></b>
                                </dt>
                                <dd><input type="text" id="lostIdNum" name="lostIdNum"
                                           value="<?php echo $_POST['lostIdNum']??NULL?>" placeholder="Lost or last obtained Identity Card Number">
                                </dd>
                            </dl>
                        </div>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="lostIdDate">Date of the issue of the Identity Card</label></b></dt>
                                <dd><input type="date" id="lostIdDate" name="lostIdDate"
                                           value="<?php echo $_POST['lostIdDate']??NULL?>" placeholder="Date of the issue of the Identity Card">
                                </dd>
                            </dl>
                        </div>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="policeStationDetails">Details of the police report or other document
                                            pertaining to the lost Identity Card</label></b></dt>
                                <dd><b><label for="policeStationName">Name of the Police Station</label></b></dd>
                                <dd><input type="text" id="policeStationName" name="policeStationName"
                                           value="<?php echo $_POST['policeStationName']??NULL?>" placeholder="Name of the Police Station">
                                </dd>
                                <dd><b><label for="policeReportDate">Date of the issue of the Police report</label></b>
                                </dd>
                                <dd><input type="date" id="policeReportDate" name="policeReportDate" value="<?php echo $_POST['policeReportDate']??NULL?>">
                                </dd>
                            </dl>
                        </div>

                        <button type="button" class="previous-btn">Previous</button>
                        <button type="button" class="next-btn">Next</button>

                    </div>
                <?php } ?>
                <div class="step step=6">
                    <h2>Photographs</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="photographs">Add Photographs</label></b></dt>
                            <dd><input type="file" id="photographs" name="photographs"></dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-7">
<!--                    <h2>Attestation of the Certifying Officer</h2>-->

                    <dl>
                        <dt><b><label for="receiptNo">Number of the receipt or the certificate</label></b></dt>
                        <dd><input type="number" id="receiptNo" name="receiptNo"
                                   value="<?php echo $_POST['receiptNo']??NULL?>" placeholder="Number of the receipt or the certificate" required></dd>
                    </dl>

                    <dl>
                        <dt><b><label for="receipt">Add the receipt</label></b></dt>
                        <dd><input type="file" id="receipt" name="receipt"></dd>

                    </dl>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="submit" class="submit-btn">Submit</button>

                </div>


                <!-- <div class="step step-8">
                    <h2>Attestation of the Certifying Officer</h2>

                    <dl>
                        <p>I hereby certify that the photograph affixed to this application and details furnished in
                            this
                            application form are of <input type="number" id="applicationNum" name="para_1"
                                                           style="width:300px" placeholder="Application Number"
                                                           required>
                            residing at the address mentioned in the application form bearing number <input type="text"
                                                                                                            id="applicantName"
                                                                                                            name="para_2"
                                                                                                            style="width:300px"
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
                                   placeholder="Name of the Certifying Officer" required></dd>


                    </dl> -->


                    

                    <!-- <button type="button" class="previous-btn">Previous</button> -->
                    <!-- <button type="submit" class="submit-btn">Submit</button>


                </div>
            </div> -->

            <!-- <div class="step step-9 " style="position: fixed;">

                <div style="padding-left: 298px;padding-top:40px;">
                    <dl style="height:35px;width:900px;">
                        <dt><b><label for="certifySignature">Signature of the Applicant</label></b></dt>
                    </dl>
                </div>
               

                <div>
                    <canvas id="can" width="910" height="400" name="sign_1"
                            style="position: fixed; left:20%; border:2px solid; top:140px;"></canvas>


                    <input type="button" value="save" id="btn" size="30" onclick="save()" class="Button_1"
                           style="position:absolute;top:540px;left:297px;">
                    <input type="button" value="clear" id="clr" size="23" onclick="erase()" class="Button_1"
                           style="position:absolute;top:540px;left:420px;">

                    <button type="button" class="previous-btn" style="position:absolute;top:550px;left:297px;">
                        Previous
                    </button>
                    <button type="button" class="next-btn" style="position:absolute;top:550px;left:1132px;"
                            onclick="canvers(2)">Next
                    </button>


                </div>
            </div>
            <div class="step step-10 " style="position: fixed;">

                <div style="padding-left: 298px;padding-top:40px;">
                    <dl style="height:35px;width:900px;">
                        <dt><b><label for="certifySignature">Signature and official frank of the certifying
                                    Officer</label></b></dt>
                    </dl>
                </div> -->


            <!-- <div>
                <canvas id="can2" width="910" height="400" name="sign_2"
                        style="position: fixed; left:20%; border:2px solid; top:140px;"></canvas>


                <input type="button" value="save" id="btn" size="30" onclick="save()" class="Button_1"
                       style="position:absolute;top:540px;left:297px;">
                <input type="button" value="clear" id="clr" size="23" onclick="erase()" class="Button_1"
                       style="position:absolute;top:540px;left:420px;">

                <button type="button" class="previous-btn" style="position:absolute;top:550px;left:297px;">
                    Previous
                </button>
                <button type="button" class="next-btn" style="position:absolute;top:550px;left:1132px;"
                        onclick="canvers(3)">Next
                </button>


            </div>
        </div>
        <div class="step step-11 " style="position: fixed;">
            <div style="padding-left: 298px;padding-top:40px;">
                <dl style="height:35px;width:900px;">
                    <dt><b><label for="certifySignature">Signature and official frank of the certifying
                                Officer</label></b></dt>
                </dl>
            </div>


            <div>
                <canvas id="can1" width="910" height="400" name="sign_3"
                        style="position: fixed; left:20%; border:2px solid; top:140px;"></canvas>


                <input type="button" value="save" id="btn" size="30" onclick="save()" class="Button_1"
                       style="position:absolute;top:540px;left:297px;">
                <input type="button" value="clear" id="clr" size="23" onclick="erase()" class="Button_1"
                       style="position:absolute;top:540px;left:420px;">

                <button type="button" class="previous-btn" style="position:absolute;top:550px;left:297px;">
                    Previous
                </button>
                <button type="submit" class="submit-btn" style="position:absolute;top:550px;left:1110px;">Submit
                </button>


            </div>


        </div> -->

    </div>

    </form>
    </div>
</section>


<script>
    const steps = Array.from(document.querySelectorAll('form .step'));
    const nextBtn = document.querySelectorAll('form .next-btn');
    const prevBtn = document.querySelectorAll('form .previous-btn');
    const form = document.querySelector('form');

    nextBtn.forEach(button => {
        button.addEventListener('click', () => {
            changeStep('next');
        })
    })

    prevBtn.forEach(button => {
        button.addEventListener('click', () => {
            changeStep('prev');
        })
    })

    function changeStep(btn) {
        let index = 0;
        const active = document.querySelector('form .step.active');
        index = steps.indexOf(active);
        steps[index].classList.remove('active');
        if (btn === 'next') {
            index++;
        } else if (btn === 'prev') {
            index--
        }
        steps[index].classList.add('active');
    }


    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",
        y = 2;


    function init(name) {
        canvas = name;

        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;

        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
    }

    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
    }

    function draw() {
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }

    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("can").style.display = "none";
        }
    }

    function save() {
        document.getElementById("can").style.border = "2px solid";
        var dataURL = canvas.toDataURL();
        document.getElementById("can").src = dataURL;
        document.getElementById("can").style.display = "inline";
        document.getElementById("can").style.display = "inline";
    }

    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;

            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(currX, currY, 2, 2);
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
                draw();
            }
        }
    }

    function canvers(Number) {
        if (Number == 1) {
            var name1 = document.getElementById('can');
            init(name1);
        } else if (Number == 2) {
            var name1 = document.getElementById('can2');
            init(name1);
        } else {
            var name1 = document.getElementById('can1');
            init(name1);
        }

    }

    function goBack() {
        window.location.href = "applicant_dashboard.php";
    }

</script>

</body>

</html>