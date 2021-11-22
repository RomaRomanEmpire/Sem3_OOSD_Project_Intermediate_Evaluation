<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'autoloader.php';
    $con = DB_OP::get_connection();
    $application = new Application($_POST,$_SESSION['user_id']);
    $applicant = $con->get_column_value("user_details","user_id","=",$_SESSION['user_id'],"user_id","");
    $applicant->apply_NIC($_SESSION['GN_division'],$_SESSION['DS_division'],$application);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            align-self: justify;
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
            font-size: 10px;
            cursor: pointer;
        }

        button.previous-btn {
            float: left;
        }

        button.submit-btn {
            background-color: seagreen;
        }

        body {
            background: linear-gradient(#21669b, #a6d8ff, #fff);
            height: 100vh;
            background-position: relative;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>


</head>

<body>
    <section>
        <div class="container">
            <form id="signin-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1>Application for Identity Card</h1>
                <!-- <h1><span id="msgx"></span></h1> -->
                <div class="step step-1 active">
                    <h2>Personal Details</h2>
                    <div class="Form-group">
                        <dl>
                            <dt>Name in full</dt>
                            <dd><b><label for="familyName">Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName" placeholder="Family name..."></dd>
                            <dd><b> <label for="name">Name</label></b></dd>
                            <dd><input type="text" id="name" name="name" placeholder="Name..."></dd>
                            <dd><b> <label for="surname">Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname" placeholder="Surname..."></dd>
                        </dl>
                    </div>
                    <div class="Form-group">
                        <dl>
                            <dt>Name to be appeared in the Identity Card</dt>
                            <dd><b><label for="familyName">Family Name</label></b></dd>
                            <dd><input type="text" id="familyNname" name="familyName" placeholder="Family name..."></dd>
                            <dd><b> <label for="name">Name</label></b></dd>
                            <dd><input type="text" id="name" name="name" placeholder="Name..."></dd>
                            <dd><b> <label for="surname">Surname</label></b></dd>
                            <dd><input type="text" id="surname" name="surname" placeholder="Surname..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Sex</dt>
                            <dd><input type="radio" id="gender_" name="gender" value="Male">
                                <label for="gender">Male</label>
                                <input type="radio" id="gender_" name="gender" value="Female">
                                <label for="gender">Female</label>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Civil Status</dt>
                            <dd><input type="radio" id="civilStatus_" name="civilStatus" value="Married">
                                <label for="civilStatus_">Married</label>
                                <input type="radio" id="civilStatus_" name="civilStatus" value="Single">
                                <label for="civilStatus_">Single</label>
                                <input type="radio" id="civilStatus_" name="civilStatus" value="Widowed">
                                <label for="civilStatus_">Widowed</label>
                                <input type="radio" id="civilStatus_" name="civilStatus" value="Divorced">
                                <label for="civilStatus_">Divorced</label>
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="profession">Profession/Occupation/Designation</label></b></dt>
                            <dd><input type="text" id="profession" name="profession" placeholder="Profession..."></dd>
                        </dl>
                    </div>

                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-2">
                    <h2>Details of Birth</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="birthday">BirthDay</label></b></dt>
                            <dd><input type="date" id="birthday" name="birthday"></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Birth Certificate No</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="birthCertificateNo"
                                    placeholder="Birth Certificate No..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="placeOfBirth">Place of Birth</label></b></dt>
                            <dd><input type="text" id="placeOfBirth" name="placeOfBirth"
                                    placeholder="Place of Birth..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="division">Division</label></b></dt>
                            <dd><input type="text" id="division" name="birthDivision" placeholder="Division...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="district">District</label></b></dt>
                            <dd><input type="text" id="district" name="birthDistrict" placeholder="District...">
                            </dd>
                        </dl>
                    </div>

                    <h2>If the applicant is born outside of Sri Lanka, details of Citizenship Certificate issued under
                        Section 5(2) of the Citizenship Act, No.18 of 1948 </h2>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="countryOfBirth">Country of Birth</label></b></dt>
                            <dd><input type="text" id="countryOfBirth" name="countryOfBirth"
                                    placeholder="Country of Birth..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="city">City</label></b></dt>
                            <dd><input type="text" id="city" name="birthCity" placeholder="City...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Certificate No.</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="f citizenshipCertificateNo"
                                    placeholder="Certificate No...">
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
                                    placeholder="Name or number of the House..."></dd>
                            <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="permRoad" placeholder="Road..."></dd>
                            <dd><b> <label for="village">Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="permVillage" placeholder="Village...">
                            </dd>
                            <dd><b> <label for="village">Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="permPostalCode" placeholder="Postal Code...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt>Postal Address </dt>
                            <dd><b><label for="houseName">Name or number of the House</label></b></dd>
                            <dd><input type="text" id="houseName" name="postalHouseName"
                                    placeholder="Name or number of the House..."></dd>
                            <dd><b> <label for="road">Road/Street/Lane/Place/Garden </label></b></dd>
                            <dd><input type="text" id="road" name="postalRoad" placeholder="Road..."></dd>
                            <dd><b> <label for="village">Village/City</label></b></dd>
                            <dd><input type="text" id="village" name="postalVillage" placeholder="Village...">
                            </dd>
                            <dd><b> <label for="village">Postal Code</label></b></dd>
                            <dd><input type="number" id="postalCode" name="postalPostalCode"
                                    placeholder="Postal Code..."></dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <div class="step step-4">
                    <h2> Details of Citizenship Certificate /Dual Citizenship Certificate</h2>

                    <div class="Form-group">
                        <dl>
                            <dt> <label for="Account_Type">Account Type</label></dt>
                            <dd><select name="citizenshipCertificateType">
                                    <option selected disabled hidden>Select the type of the Certificate</option>
                                    <option style="text-align: center;">Citizenship Certificate</option>
                                    <option style="text-align: center;">Dual Citizenship Certificate</option>
                                </select></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateNo">Certificate Number</label></b></dt>
                            <dd><input type="number" id="certificateNo" name="certificateNo"
                                    placeholder="Certificate Number..."></dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="certificateDate">Date of issue of Certificate </label></b></dt>
                            <dd><input type="date" id="certificateDate" name="citizenshipCertificateDate"></dd>
                        </dl>
                    </div>

                    <h2>Details for inquiries</h2>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="telephoneNo">Telephone Number</label></b></dt>
                            <dd><b><label for="residence">Residence</label></b></dd>
                            <dd><input type="tel" id="residence" name="residenceTelNo" placeholder="Residence...">
                            </dd>
                            <dd><b><label for="mobile">Mobile</label></b></dd>
                            <dd><input type="tel" id="mobile" name="mobileTelNo" placeholder="Mobile...">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="email">Email</label></b></dt>
                            <dd><input type="email" id="email" name="email" placeholder="Email...">
                            </dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>

                <!-- <div class="step step-5">
                    <h2>If the duplicate of the Identity Card is applied for, please complete this section.</h2>

                    <div class="Form-group">
                        <dl>
                            <dt>Purpose of application</dt>
                            <dd><input type="radio" id="purpose" name="purpose" value=" if the Identity Card is lost">
                                <label for="purpose"> if the Identity Card is lost </label><br>
                                <input type="radio" id="purpose" name="purpose"
                                    value="to make changes to the Identity Card">
                                <label for="purpose">to make changes to the Identity Card</label><br>
                                <input type="radio" id="purpose" name="purpose"
                                    value="to renew the period of validity ">
                                <label for="purpose">to renew the period of validity </label><br>
                                <input type="radio" id="purpose" name="purpose"
                                    value=" if the Identity card is damaged/ defaced /illegible">
                                <label for="purpose"> if the Identity card is damaged/ defaced /illegible</label><br>
                            </dd>
                        </dl>
                    </div>
                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="lostIdNum">Lost or last obtained Identity Card Number</label></b></dt>
                            <dd><input type="text" id="lostIdNum" name="lostIdNum"
                                    placeholder="Lost or last obtained Identity Card Number">
                            </dd>
                        </dl>
                    </div>

                    <div class="Form-group">
                        <dl>
                            <dt><b><label for="lostIdDate">Date of the issue of the Identity Card</label></b></dt>
                            <dd><input type="date" id="lostIdDate" name="lostIdDate"
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
                                    placeholder="Name of the Police Station">
                            </dd>
                            <dd><b><label for="policeReportDate">Date of the issue of the Police report</label></b></dd>
                            <dd><input type="date" id="policeReportDate" name="policeReportDate">
                            </dd>
                        </dl>
                    </div>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div> -->

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
                    <h2>Attestation of the Certifying Officer</h2>

                    <dl>
                        <dt><b><label for="receiptNo">Number of the receipt or the certificate</label></b></dt>
                        <dd><input type="number" id="receiptNo" name="receiptNo"
                                placeholder="Number of the receipt or the certificate"></dd>
                    </dl>

                    <dl>
                        <dt><b><label for="receipt">Add the receipt</label></b></dt>
                        <dd><input type="file" id="receipt" name="receipt"></dd>

                    </dl>

                    <button type="button" class="previous-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                </div>


                <div class="step step-8">
                    <h2>Attestation of the Certifying Officer</h2>

                    <dl>
                        <p>I hereby certify that the photograph affixed to this application and details furnished in
                            this
                            application form are of <input type="number" id="applicationNum" name="para_1"
                                style="width:300px" placeholder="Application Number">
                            residing at the address mentioned in the application form bearing number <input type="text"
                                id="applicantName" name="para_2" style="width:300px" placeholder="Applicant Name">
                            and that the photograph affixed is duplicating the natural status of the applicant without
                            disguise or concealment. I certify that I have placed my signature and official franh and
                            that
                            the applicant placed his signature impression before me.</p>
                    </dl>

                    <dl>
                        <dt><b><label for="certifyName">Name of the Certifying Officer</label></b></dt>
                        <dd><input type="text" id="certifyName" name="certifyName"
                                placeholder="Name of the Certifying Officer" required></dd>
                    </dl>

                    <dl>
                        <dt><b><label for="certifySignature">Signature and official frank of the certifying
                                    Officer</label></b></dt>
                    </dl>
                    <dl>
                        <dt><b><label for="certifySignature">Signature and official frank of the certifying
                                    Officer</label></b></dt>
                    </dl>

                    <button type="button" class="previous-btn">Previous</button>

                    <button type="submit" class="submit-btn">Submit</button>
                    
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

        // form.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     const inputs = [];
        //     form.querySelectorAll('input').forEach(input => {
        //         const { name, value } = input;
        //         inputs.push({ name, value })
        //     })
        //     console.log(inputs)
        //     form.reset();
        //     let index = 0;
        //     const active = document.querySelector('form .step.active');
        //     index = steps.indexOf(active);
        //     steps[index].classList.remove('active');
        //     steps[0].classList.add('active');
        // })

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
    </script>

</body>

</html>