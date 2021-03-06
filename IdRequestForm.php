<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "functions.php";

    $photograph = checkFileValidity("photographs");
    $receipt = checkFileValidity("receipt");

    $policeReport = checkFileValidity("policeReport");
    if (!empty($photograph) && !empty($receipt) && !empty(isset($_FILES['policeReport'])?$policeReport:' ')){
        $applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
        $application = $applicant->getApplication();
        $application->setGnDivOrAddress($_GET['basic']);
        $application->setDs($_GET['ds']);
        $application->setDetails($photograph, $receipt,$policeReport, $_POST, $applicant, $_GET['id']);

        $applicant->set_db($conn);


        $applicant->set_row_id($_SESSION['user_id']);

        $applicant->apply_NIC($_GET['table'], $application);
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
            font-size: 40px;
            font-style: italic;
        }

        h2 {
            font-size: 30px;
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

        .required_:after {
            content:" *";
            color: red;
        }

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
        <form onsubmit="return requiredId()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET['id']; ?>&
        table=<?php echo $_GET['table']; ?>&basic=<?php echo $_GET['basic']; ?>&ds=<?php echo $_GET['ds']; ?>"
              method="POST" enctype="multipart/form-data">

            <div class="container">
                <!-- <h1><span id="msgx"></span></h1> -->
                <div class="step step-1 active">
                    <div class="header1"><a href="dashboard.php">
                            <button type="button" class="fas fa-arrow-left">Back</button>
                        </a></div>
                    <h1>Application for Identity Card</h1><br>
                    <h2>1. Personal Details</h2>
                    <div class="Form-group">
                        <dl>
                            <dt>1.1. Name in full</dt>
                            <dd><b><label for="familyName">1.1.1. Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName" value="<?php echo $_POST['familyName']??NULL?>" placeholder="Family name..."></dd>
                            <dd><b> <label class="required_" for="name">1.1.2. Name</label></b></dd>
                            <dd><input type="text" id="nameFull" name="name" value="<?php echo $_POST['name']??NULL?>" placeholder="Name..."></dd>
                            <dd><b> <label for="surname">1.1.3. Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname" value="<?php echo $_POST['surname']??NULL?>" placeholder="Surname..."></dd>
                        </dl>
                    </div>
                    <div class="Form-group">
                        <dl>
                            <dt>1.2. Name to be appeared in the Identity Card</dt>
                            <dd><b><label for="familyName">1.2.1. Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName" value="<?php echo $_POST['familyName']??NULL?>" placeholder="Family name..."></dd>
                            <dd><b> <label class="required_" for="name">1.2.2. Name</label></b></dd>
                            <dd><input type="text" id="nameCard" name="name" value="<?php echo $_POST['name']??NULL?>" placeholder="Name..."></dd>
                            <dd><b> <label for="surname">1.2.3. Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname" value="<?php echo $_POST['surname']??NULL?>" placeholder="Surname..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label class="required_" for="sex">1.3. Sex </label></b></dt>
                            <dd><input  type="radio" id="gender_1" name="gender" value="Male" <?php echo $_POST['gender']??NULL=='Male'?'checked':NULL?> required>
                                <label for="gender_1">Male</label>
                                <input type="radio" id="gender_2" name="gender" value="Female" <?php echo $_POST['gender']??NULL=='Female'?'checked':NULL?> required>
                                <label for="gender_2">Female</label>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label class="required_" for="civil_status">1.4. Civil Status</label></b></dt>
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
                            <dt><b><label class="required_" for="profession">1.5. Profession/Occupation/Designation</label></b></dt>
                            <dd><input type="text" id="profession" name="profession" value="<?php echo $_POST['profession']??NULL?>" placeholder="Profession..."
                                       required></dd>
                        </dl>
                    </div>

                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-2">
                    <h2>2. Details of Birth</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label class="required_" for="birthday">2.1. BirthDay</label></b></dt>
                            <dd><input type="date" id="birthday" name="birthday" value="<?php echo $_POST['birthday']??NULL?>" required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">2.2. Birth Certificate No</label></b></dt>
                            <dd><input type="number" id="certificateNoBirth" name="birthCertificateNo"
                                       value="<?php echo $_POST['birthCertificateNo']??NULL?>" placeholder="Birth Certificate No..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="placeOfBirth">2.3. Place of Birth</label></b></dt>
                            <dd><input type="text" id="placeOfBirth" name="placeOfBirth"
                                       value="<?php echo $_POST['placeOfBirth']??NULL?>" placeholder="Place of Birth..." ></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="division">2.4. Division</label></b></dt>
                            <dd><input type="text" id="division" name="birthDivision" value="<?php echo $_POST['birthDivision']??NULL?>" placeholder="Division...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="district">2.5. District</label></b></dt>
                            <dd><input type="text" id="district" name="birthDistrict" value="<?php echo $_POST['birthDistrict']??NULL?>" placeholder="District...">
                            </dd>
                        </dl>
                    </div>

                    <p>If the applicant is born outside of Sri Lanka, details of Citizenship Certificate issued under
                        Section 5(2) of the Citizenship Act, No.18 of 1948 </p>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="countryOfBirth">2.6. Country of Birth</label></b></dt>
                            <dd><input type="text" id="countryOfBirth" name="countryOfBirth"
                                       value="<?php echo $_POST['countryOfBirth']??NULL?>" placeholder="Country of Birth..." onchange="make_require()"></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="city">2.7. City</label></b></dt>
                            <dd><input type="text" id="city" name="birthCity" value="<?php echo $_POST['birthCity']??NULL?>" placeholder="City..." onchange="make_require()">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">2.8. Certificate No.</label></b></dt>
                            <dd><input type="number" id="certificateNoCountry" name="citizenshipCertificateNo"
                                       value="<?php echo $_POST['citizenshipCertificateNo']??NULL?>" placeholder="Certificate No..." onchange="make_require()">
                            </dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>
                </div>

                <div class="step step-3">
                    <h2>3. Details of Residence</h2>
                    <div class="Form-group">
                        <dl>
                            <dt>3.1. Permanent Address</dt>
                            <dd><b><label class="required_" for="houseName">3.1.1. Name or number of the House</label></b></dd>
                            <dd><input type="text" id="houseName" name="permHouseName"
                                       value="<?php echo $_POST['permHouseName']??NULL?>" placeholder="Name or number of the House..." required></dd>
                            <dd><b> <label class="required_" for="road">3.1.2. Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="permRoad" value="<?php echo $_POST['permRoad']??NULL?>" placeholder="Road..." required></dd>
                            <dd><b> <label class="required_" for="village">3.1.3. Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="permVillage" value="<?php echo $_POST['permVillage']??NULL?>" placeholder="Village..." required>
                            </dd>
                            <dd><b> <label class="required_" for="village">3.1.4. Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="permPostalCode" value="<?php echo $_POST['permPostalCode']??NULL?>" placeholder="Postal Code..."
                                       required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>3.2. Postal Address</dt>
                            <dd><b><label class="required_" for="houseName">3.2.1. Name or number of the House</label></b></dd>
                            <dd><input type="text" id="houseName" name="postalHouseName"
                                       value="<?php echo $_POST['postalHouseName']??NULL?>" placeholder="Name or number of the House..." required></dd>
                            <dd><b> <label class="required_" for="road">3.2.2. Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="postalRoad" value="<?php echo $_POST['postalRoad']??NULL?>" placeholder="Road..." required></dd>
                            <dd><b> <label class="required_" for="village">3.2.3. Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="postalVillage" value="<?php echo $_POST['postalVillage']??NULL?>" placeholder="Village..." required>
                            </dd>
                            <dd><b> <label class="required_" for="village">3.2.4. Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="postalPostalCode"
                                       value="<?php echo $_POST['postalPostalCode']??NULL?>" placeholder="Postal Code..." required></dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-4">
                    <h2>4. Details of Citizenship Certificate /Dual Citizenship Certificate</h2>

                    <div class="Form-group">
                        <dl>
                            <dt><label for="Account_Type">4.1. Account Type</label></dt>
                            <dd><select name="citizenshipCertificateType">
                                    <option disabled hidden <?php echo (!isset($_POST['citizenshipCertificateType']))?'selected':""?>>Select the type of the Certificate</option>
                                    <option style="text-align: center;" <?php echo $_POST['citizenshipCertificateType']??NULL=='Citizenship Certificate'?'selected':NULL?>>Citizenship Certificate</option>
                                    <option style="text-align: center;" <?php echo $_POST['citizenshipCertificateType']??NULL=='Dual Citizenship Certificate'?'selected':NULL?>>Dual Citizenship Certificate</option>
                                </select></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">4.2. Certificate Number</label></b></dt>
                            <dd><input type="number" id="certificateNoSelect" name="certificateNo_9"
                                       value="<?php echo $_POST['certificateNo_9']??NULL?>" placeholder="Certificate Number..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateDate">4.3. Date of issue of Certificate </label></b></dt>
                            <dd><input type="date" id="certificateDateSelect" name="citizenshipCertificateDate" value="<?php echo $_POST['citizenshipCertificateDate']??NULL?>" ></dd>
                        </dl>
                    </div>

                    <h2>5. Details for inquiries</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="telephoneNo">5.1. Telephone Number</label></b></dt>
                            <dd><b><label for="residence">5.1.1. Residence</label></b></dd>
                            <dd><input type="tel" id="residence" name="residenceTelNo" value="<?php echo $_POST['residenceTelNo']??NULL?>" placeholder="Residence...">
                            </dd>
                            <dd><b><label for="mobile">5.1.2. Mobile</label></b></dd>
                            <dd><input type="tel" id="mobile" name="mobileTelNo" value="<?php echo $_POST['mobileTelNo']??NULL?>" placeholder="Mobile..." >
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="email">5.2. Email</label></b></dt>
                            <dd><input type="email" id="email" name="email" value="<?php echo $_POST['email']??NULL?>" placeholder="Email...">
                            </dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step=5">
                    <h2>6. Photographs</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label class="required_" for="photographs">6.1. Add Photographs</label></b></dt>
                            <dd><input type="file" id="photographs" name="photographs" required></dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-6">
                    <h2>7. Details of the Payments made</h2>

                    <dl>
                        <dt><b><label class="required_" for="receiptNo">7.1. Number of the receipt or the certificate</label></b></dt>
                        <dd><input type="number" id="receiptNo" name="receiptNo"
                                   value="<?php echo $_POST['receiptNo']??NULL?>" placeholder="Number of the receipt or the certificate" required></dd>
                    </dl>

                    <dl>
                        <dt><b><label class="required_" for="receipt">7.2. Add the receipt</label></b></dt>
                        <dd><input type="file" id="receipt" name="receipt" required></dd>

                    </dl>

                    <button type="button" class="previous-btn">Previous</button>
                    <?php if ($_GET['id'] == 1) { ?>
                        <button type="submit" class="submit-btn">Submit</button>
                    <?php } ?>
                    <?php if ($_GET['id'] == 2) { ?>
                        <button type="button" class="next-btn">Next</button>
                    <?php } ?>

                </div>

                <?php if ($_GET['id'] == 2) { ?>
                    <div class="step step-7">
                        <h2>8. Applying for a duplicate of the Identity Card</h2>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label class="required_" for="purpose">8.1. Purpose of application</label></b></dt>
                                <dd><input type="radio" id="purpose1" name="purpose"
                                           value="if the Identity Card is lost" <?php echo $_POST['purpose']??NULL=='if the Identity Card is lost'?'checked':NULL?> >
                                    <label for="purpose1"> if the Identity Card is lost </label><br>
                                    <input type="radio" id="purpose2" name="purpose"
                                           value="to make changes to the Identity Card" <?php echo $_POST['purpose']??NULL=='to make changes to the Identity Card'?'checked':NULL?> >
                                    <label for="purpose2">to make changes to the Identity Card</label><br>
                                    <input type="radio" id="purpose3" name="purpose"
                                           value="to renew the period of validity" <?php echo $_POST['purpose']??NULL=='to renew the period of validity'?'checked':NULL?> >
                                    <label for="purpose3">to renew the period of validity </label><br>
                                    <input type="radio" id="purpose4" name="purpose"
                                           value="if the Identity card is damaged/ defaced /illegible" <?php echo $_POST['purpose']??NULL=='if the Identity card is damaged/ defaced /illegible'?'checked':NULL?> >
                                    <label for="purpose4"> if the Identity card is damaged/ defaced
                                        /illegible</label><br>
                                </dd>
                            </dl>
                        </div>
                        <div class="Form-group">
                            <dl>
                                <dt><b><label class="required_" for="lostIdNum">8.2. Lost or last obtained Identity Card Number</label></b>
                                </dt>
                                <dd><input type="text" id="lostIdNum" name="lostIdNum"
                                           value="<?php echo $_POST['lostIdNum']??NULL?>" placeholder="Lost or last obtained Identity Card Number" <?php if ($_GET['id'] == 2) { ?> required <?php } ?>>
                                </dd>
                            </dl>
                        </div>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label class="required_" for="lostIdDate">8.3. Date of the issue of the Identity Card</label></b></dt>
                                <dd><input type="date" id="lostIdDate" name="lostIdDate"
                                           value="<?php echo $_POST['lostIdDate']??NULL?>" placeholder="Date of the issue of the Identity Card" <?php if ($_GET['id'] == 2) { ?> required <?php } ?>>
                                </dd>
                            </dl>
                        </div>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="policeStationDetails">8.4. Details of the police report or other document
                                            pertaining to the lost Identity Card</label></b></dt>
                                <dd><b><label class="required_" for="policeStationName">8.4.1. Name of the Police Station</label></b></dd>
                                <dd><input type="text" id="policeStationName" name="policeStationName"
                                           value="<?php echo $_POST['policeStationName']??NULL?>" placeholder="Name of the Police Station" <?php if ($_GET['id'] == 2) { ?> required <?php } ?> >
                                </dd>
                                <dd><b><label class="required_" for="policeReportDate">8.4.2. Date of the issue of the Police report</label></b>
                                </dd>
                                <dd><input type="date" id="policeReportDate" name="policeReportDate" value="<?php echo $_POST['policeReportDate']??NULL?>" <?php if ($_GET['id'] == 2) { ?> required <?php } ?>>
                                </dd>

                                <dd><b><label class="required_" for="policeReport">8.4.3. Police report attachment</label></b>
                                </dd>
                                <dd><input type="file" id="policeReport" name="policeReport" value="<?php echo $_POST['policeReport']??NULL?>" <?php if ($_GET['id'] == 2) { ?> required <?php } ?>>
                                </dd>
                            </dl>
                        </div>

                        <button type="button" class="previous-btn">Previous</button>
                        <button type="submit" class="submit-btn">Submit</button>

                    </div>
                <?php } ?>

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

    function requiredId(){
        var value1 = document.getElementById("nameFull").value;
        var value2 = document.getElementById("nameCard").value;
        var value3 = document.getElementById("certificateNoBirth").value;
        var value4 = document.getElementById("placeOfBirth").value;
        var value5 = document.getElementById("division").value;
        var value6 = document.getElementById("district").value;
        var value7 = document.getElementById("countryOfBirth").value;
        var value8 = document.getElementById("city").value;
        var value9 = document.getElementById("certificateNoCountry").value;
        // if(value1 == "" && value2 == ""){
        //     alert("Please input all relevant personal details");
        //     return false;
        // }
        if ((value3 == "" || value4 == "" || value5 == "" || value6 == "") && (value7 == "" || value8 == "" || value9 == "")) {
            alert("Please input all relevant birth details");
            return false;
        } else {
            return true;
        }
    }

    // var canvas, ctx, flag = false,
    //     prevX = 0,
    //     currX = 0,
    //     prevY = 0,
    //     currY = 0,
    //     dot_flag = false;
    //
    // var x = "black",
    //     y = 2;
    //
    //
    // function init(name) {
    //     canvas = name;
    //
    //     ctx = canvas.getContext("2d");
    //     w = canvas.width;
    //     h = canvas.height;
    //
    //     canvas.addEventListener("mousemove", function (e) {
    //         findxy('move', e)
    //     }, false);
    //     canvas.addEventListener("mousedown", function (e) {
    //         findxy('down', e)
    //     }, false);
    //     canvas.addEventListener("mouseup", function (e) {
    //         findxy('up', e)
    //     }, false);
    //     canvas.addEventListener("mouseout", function (e) {
    //         findxy('out', e)
    //     }, false);
    // }
    //
    // function getMousePos(canvas, evt) {
    //     var rect = canvas.getBoundingClientRect();
    //     return {
    //         x: evt.clientX - rect.left,
    //         y: evt.clientY - rect.top
    //     };
    // }
    //
    // function draw() {
    //     ctx.beginPath();
    //     ctx.moveTo(prevX, prevY);
    //     ctx.lineTo(currX, currY);
    //     ctx.strokeStyle = x;
    //     ctx.lineWidth = y;
    //     ctx.stroke();
    //     ctx.closePath();
    // }
    //
    // function erase() {
    //     var m = confirm("Want to clear");
    //     if (m) {
    //         ctx.clearRect(0, 0, w, h);
    //         document.getElementById("can").style.display = "none";
    //     }
    // }
    //
    // function save() {
    //     document.getElementById("can").style.border = "2px solid";
    //     var dataURL = canvas.toDataURL();
    //     document.getElementById("can").src = dataURL;
    //     document.getElementById("can").style.display = "inline";
    //     document.getElementById("can").style.display = "inline";
    // }
    //
    // function findxy(res, e) {
    //     if (res == 'down') {
    //         prevX = currX;
    //         prevY = currY;
    //         currX = e.clientX - canvas.offsetLeft;
    //         currY = e.clientY - canvas.offsetTop;
    //
    //         flag = true;
    //         dot_flag = true;
    //         if (dot_flag) {
    //             ctx.beginPath();
    //             ctx.fillStyle = x;
    //             ctx.fillRect(currX, currY, 2, 2);
    //             ctx.closePath();
    //             dot_flag = false;
    //         }
    //     }
    //     if (res == 'up' || res == "out") {
    //         flag = false;
    //     }
    //     if (res == 'move') {
    //         if (flag) {
    //             prevX = currX;
    //             prevY = currY;
    //             currX = e.clientX - canvas.offsetLeft;
    //             currY = e.clientY - canvas.offsetTop;
    //             draw();
    //         }
    //     }
    // }
    //
    // function canvers(Number) {
    //     if (Number == 1) {
    //         var name1 = document.getElementById('can');
    //         init(name1);
    //     } else if (Number == 2) {
    //         var name1 = document.getElementById('can2');
    //         init(name1);
    //     } else {
    //         var name1 = document.getElementById('can1');
    //         init(name1);
    //     }
    //
    // }

    function goBack() {
        window.location.href = "applicant_dashboard.php";
    }

</script>

</body>

</html>
