<?php
include 'autoloader.php';
session_start();
$_SESSION['application_id'] = $_GET['application_id'];
$conn = DB_OP::get_connection();
$application = unserialize($conn->get_column_value("application_details", "app_id", "=", $_SESSION['application_id'], "application_object", ""));


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

        html {
            min-height: 850%;
        }

        body {
            /* background: #21669b; */
            /* background: #667EEA; */
            min-height: 980vh;

            background-image: radial-gradient(circle farthest-corner at 22.4% 21.7%, rgba(4, 189, 228, 1) 0%, rgba(2, 83, 185, 1) 100.2%);


        }
        td{
            padding-left:  20px;
            padding-right: 30px;
            /* padding-bottom: 20px; */
            
            
        }

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


        .step.active {
            display: block;
        }

        .container {
            left: 50%;
            /* padding-top: 100px; */
            margin-top: 160px;
            align-self: center;
            position: absolute;
            transform: translate(-50%);
            box-sizing: border-box;
            padding: 20px 20px;
            width: 1000px;
            /* background-color: #a6d8ff ; */
            background-image: linear-gradient(to right, #00b4db, #0083b0);
            border-radius: 50px;
            border-color: #000;
            


        }

        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 19vh;
            width: 100%;
            background-color: #00b4db;
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;

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
            font-size: 10px;
            cursor: pointer;
        }

        button.previous-btn {
            float: left;
        }

        button.submit-btn {
            background-color: seagreen;

        }
        .header1 button:hover{
            background-color: white;
        }


    </style>


</head>

<body>
<div class="header1">
    <table>
        <tbody>
           <div ><tr><td><h1 style="text-align: center;font-size:60px; color:white;padding-right:200px; font-family: 'Times New Roman', Times, serif;">Application </h1></td></tr></div> 
           <div> <div> <div style="top: 0px;"> <tr>
                            <!-- This button id only viewed by RAP -->
                            <td style="float: right;"><a href="Time_slot.php">
                                   <button type="submit" class="btn btn-sm btn-outline-primary" style="color: black; font-size:18px;"><b >Send Time</b>  
                                   </button>
                            <!-- This button id only viewed by RAP -->
                           <td><a href="Reject_Application.php">
                                   <button type="submit" class="btn btn-sm btn-outline-primary" style="color:black;font-size:18px;" ><b >Reject Application</b>
                                   </button>
                               </a></td>
                               <td><a href="View_Applications_Details.php">
                                   <button type="submit" class="btn btn-sm btn-outline-light fas fa-arrow-left" style="width: 100px;font-size:18px;color:black;"><b >Back</b>
                                   </button>
                                  </a></td>
            </tr>
        
            </div></div></div>
        </tbody>
    </table>
</div>
<section>
    <div class="container">

        <form id="signin-form" action="">
            <fieldset disabled>


                <div class="step step-1 active">
                    <h2>Personal Details</h2>
                    <div class="Form-group">
                        <dl>
                            <dt>Name in full</dt>
                            <dd><b><label for="familyName">Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName"
                                       value="<?php echo $application->getFamilyName(); ?>" placeholder="Family name..."
                                       required></dd>
                            <dd><b> <label for="name">Name</label></b></dd>
                            <dd><input type="text" id="name" name="name" value="<?php echo $application->getName(); ?>"
                                       placeholder="Name..." required></dd>
                            <dd><b> <label for="surname">Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname"
                                       value="<?php echo $application->getSurname(); ?>" placeholder="Surname..."
                                       required></dd>
                        </dl>
                    </div>
                    <div class="Form-group">
                        <dl>
                            <dt>Name to be appeared in the Identity Card</dt>
                            <dd><b><label for="familyName">Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName"
                                       value="<?php echo $application->getFamilyName(); ?>" placeholder="Family name..."
                                       required></dd>
                            <dd><b> <label for="name">Name</label></b></dd>
                            <dd><input type="text" id="name" name="name" value="<?php echo $application->getName(); ?>"
                                       placeholder="Name..." required></dd>
                            <dd><b> <label for="surname">Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname"
                                       value="<?php echo $application->getSurname(); ?>" placeholder="Surname..."
                                       required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Sex</dt>
                            <dd><input type="text" id="gender_" name="gender"
                                       value="<?php echo $application->getGender(); ?>" required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Civil Status</dt>
                            <dd><input type="text" id="civilStatus_" name="civilStatus"
                                       value="<?php echo $application->getCivilStatus(); ?>" required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="profession">Profession/Occupation/Designation</label></b></dt>
                            <dd><input type="text" id="profession" name="profession"
                                       value="<?php echo $application->getProfession(); ?>" placeholder="Profession..."
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
                                       value="<?php echo $application->getBirthday(); ?>" required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Birth Certificate No</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="birthCertificateNo"
                                       value="<?php echo $application->getBirthCertificateNo(); ?>"
                                       placeholder="Birth Certificate No..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="placeOfBirth">Place of Birth</label></b></dt>
                            <dd><input type="text" id="placeOfBirth" name="placeOfBirth"
                                       value="<?php echo $application->getPlaceOfBirth(); ?>"
                                       placeholder="Place of Birth..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="division">Division</label></b></dt>
                            <dd><input type="text" id="division" name="birthDivision"
                                       value="<?php echo $application->getBirthDivision(); ?>" placeholder="Division..."
                                       required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="district">District</label></b></dt>
                            <dd><input type="text" id="district" name="birthDistrict"
                                       value="<?php echo $application->getBirthDistrict(); ?>" placeholder="District..."
                                       required>
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
                                       value="<?php echo $application->getCountryOfBirth(); ?>"
                                       placeholder="Country of Birth..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="city">City</label></b></dt>
                            <dd><input type="text" id="city" name="birthCity"
                                       value="<?php echo $application->getBirthCity(); ?>" placeholder="City...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Certificate No.</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="f citizenshipCertificateNo"
                                       value="<?php echo $application->getCitizenshipCertificateNo(); ?>"
                                       placeholder="Certificate No...">
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
                                       value="<?php echo $application->getPermHouseName(); ?>"
                                       placeholder="Name or number of the House..." required></dd>
                            <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="permRoad"
                                       value="<?php echo $application->getPermRoad(); ?>" placeholder="Road..."
                                       required></dd>
                            <dd><b> <label for="village">Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="permVillage"
                                       value="<?php echo $application->getPermVillage(); ?>" placeholder="Village..."
                                       required>
                            </dd>
                            <dd><b> <label for="village">Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="permPostalCode"
                                       value="<?php echo $application->getPermPostalCode(); ?>"
                                       placeholder="Postal Code..." required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Postal Address</dt>
                            <dd><b><label for="houseName">Name or number of the House</label></b></dd>
                            <dd><input type="text" id="houseName" name="postalHouseName"
                                       value="<?php echo $application->getPostalHouseName(); ?>"
                                       placeholder="Name or number of the House..." required></dd>
                            <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="postalRoad"
                                       value="<?php echo $application->getPostalRoad(); ?>" placeholder="Road..."
                                       required></dd>
                            <dd><b> <label for="village">Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="postalVillage"
                                       value="<?php echo $application->getPostalVillage(); ?>" placeholder="Village..."
                                       required>
                            </dd>
                            <dd><b> <label for="village">Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="postalPostalCode"
                                       value="<?php echo $application->getPostalPostalCode(); ?>"
                                       placeholder="Postal Code..." required></dd>
                        </dl>
                    </div>


                </div>

                <div class="step step-4">
                    <h2> Details of Citizenship Certificate /Dual Citizenship Certificate</h2>

                    <div class="Form-group">
                        <dl>
                            <dt><label for="Account_Type">Account Type</label></dt>

                            <dd><input type="text" name="citizenshipCertificateType"
                                       value="<?php echo $application->getCitizenshipCertificateType(); ?>"
                                       placeholder="Postal Code..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Certificate Number</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="certificateNo_9.1"
                                       value="<?php echo $application->getCitizenshipCertificateNo91(); ?>"
                                       placeholder="Certificate Number..." required></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateDate">Date of issue of Certificate </label></b></dt>
                            <dd><input type="date" id="certificateDate" name="citizenshipCertificateDate"
                                       value="<?php echo $application->getCitizenshipCertificateDate(); ?>" required>
                            </dd>
                        </dl>
                    </div>

                    <h2>Details for inquiries</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="telephoneNo">Telephone Number</label></b></dt>
                            <dd><b><label for="residence">Residence</label></b></dd>
                            <dd><input type="tel" id="residence" name="residenceTelNo"
                                       value="<?php echo $application->getResidenceTelNo(); ?>"
                                       placeholder="Residence..." required>
                            </dd>
                            <dd><b><label for="mobile">Mobile</label></b></dd>
                            <dd><input type="tel" id="mobile" name="mobileTelNo"
                                       value="<?php echo $application->getMobileTelNo(); ?>" placeholder="Mobile..."
                                       required>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="email">Email</label></b></dt>
                            <dd><input type="email" id="email" name="email"
                                       value="<?php echo $application->getEmail(); ?>" placeholder="Email..." required>
                            </dd>
                        </dl>
                    </div>


                </div>
                <?php if ($_GET['application_id'] == 2) { ?>
                    <div class="step step-5">
                        <h2>If the duplicate of the Identity Card is applied for, please complete this section.</h2>

                        <div class="Form-group">
                            <dl>
                                <dt>Purpose of application</dt>
                                <dd><input type="text" id="purpose" name="purpose"
                                           value="<?php echo $application->getPurpose(); ?>" placeholder="Email..."
                                           required>
                            </dl>
                        </div>
                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="lostIdNum">Lost or last obtained Identity Card Number</label></b>
                                </dt>
                                <dd><input type="text" id="lostIdNum" name="lostIdNum"
                                           value="<?php echo $application->getLostIdNum(); ?>"
                                           placeholder="Lost or last obtained Identity Card Number">
                                </dd>
                            </dl>
                        </div>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="lostIdDate">Date of the issue of the Identity Card</label></b></dt>
                                <dd><input type="date" id="lostIdDate" name="lostIdDate"
                                           value="<?php echo $application->getLostIdDate(); ?>"
                                           placeholder="Date of the issue of the Identity Card">
                                </dd>
                            </dl>
                        </div>

                        <div class="Form-group">
                            <dl>
                                <dt><b><label for="policeStationDetails">Details of the police report or other document
                                            pertaining to the lost Identity Card</label></b></dt>
                                <dd><b><label for="policeStationName">Name of the Police Station</label></b></dd>
                                <dd><input type="text" id="policeStationName" name="policeStationName"
                                           value="<?php echo $application->getPoliceStationName(); ?>"
                                           placeholder="Name of the Police Station">
                                </dd>
                                <dd><b><label for="policeReportDate">Date of the issue of the Police report</label></b>
                                </dd>
                                <dd><input type="date" id="policeReportDate" name="policeReportDate"
                                           value="<?php echo $application->getPoliceReportDate(); ?>">
                                </dd>
                            </dl>
                        </div>

                        <!-- <button type="button" class="previous-btn">Previous</button>
                        <button type="button" class="next-btn">Next</button> -->

                    </div>
                <?php } ?>

                <div class="step step=6">
                    <dl>
                        <div class="Form-group">
                            <h2>Photographs</h2>

                            <?php
                            $receive_file = $application->getPhotographs();
                            echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?>

                        </div>
                    </dl>

                </div>

                <div class="step step-7">
                    <h2>Attestation of the Certifying Officer</h2>

                    <dl>
                        <dt><b><label for="receiptNo">Number of the receipt or the certificate</label></b></dt>
                        <dd><input type="number" id="receiptNo" name="receiptNo"
                                   value="<?php echo $application->getReceiptNo(); ?>"
                                   placeholder="Number of the receipt or the certificate" required></dd>
                    </dl>

                    <dl>
                        <div>
                            <?php
                            $receive_file = $application->getReceipt();
                            echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?>
                        </div>
                    </dl>


                </div>
            </fieldset>


            <div class="step step-8" style="display: block;">
                <h2>Attestation of the Certifying Officer</h2>

                <dl>
                    <p style="font-size: 16px;">I hereby certify that the photograph affixed to this application and
                        details furnished in
                        this
                        application form are of <input type="number" id="applicationNum" name="para_1"
                                                       style="width:300px"
                                                       value="<?php echo $application->getPara1(); ?>"
                                                       placeholder="Application Number" required>
                        residing at the address mentioned in the application form bearing number <input type="text"
                                                                                                        id="applicantName"
                                                                                                        name="para_2"
                                                                                                        style="width:300px"
                                                                                                        value="<?php echo $application->getPara2(); ?>"
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
                               value="<?php echo $application->getCertifyName(); ?>"
                               placeholder="Name of the Certifying Officer" required></dd>
                </dl>

                <dl>
                    <dt><b><label for="certifySignature1">Signature of the applicant</label></b>
                        <a href="" style="float: right;">
                            <button type="submit" class="btn btn-sm btn-outline-success " style="color: black;"><b> Add the sign </b></button>
                        </a>
                    </dt></dl>
            </div>
        
        <dl>
            <dt><b><label for="certifySignature2">Signature and official frank of the certifying
                        Officer</label></b>
                <a href="" style="float: right;">
                    <button type="submit" class="btn btn-sm btn-outline-success" style="color: black;"><b>Add the sign</b></button>
                </a>
            </dt>

        </dl>
        <dl>
            <dt><b><label for="certifySignature3">Signature and official frank of the certifying
                        Officer</label></b>
                <a href="" style="float: right;">
                    <button type="submit" class="btn btn-sm btn-outline-success" style="color: black;"><b>Add the sign</b></button>
                </a>
            </dt>

        </dl>


        <!-- <button type="submit" class="submit-btn">Submit</button> -->
    </form>
    </div>

    
    </div>
</section>


</body>

</html>