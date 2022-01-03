<?php
session_start();
include 'autoloader.php';

$conn = DB_OP::get_connection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['officer'] == "Database_Manager") {
        $staff_member = new DatabaseManager($_POST);
    } else if ($_POST['officer'] == "Admin") {
        $staff_member = new Admin($_POST);
    }else if ($_POST['officer'] == "Estate_Superintendent") {
        $staff_member = new E_S($_POST);
    } else if ($_POST['officer'] == "Grama_Niladari") {
        $staff_member = new GramaNiladari($_POST);
    } else if ($_POST['officer'] == "Principal") {
        $staff_member = new Principal($_POST);
    } else if ($_POST['officer'] == "Divisional_Secretary") {
        $staff_member = new DivisionalSecretary($_POST);
    } else if ($_POST['officer'] == "National_Identity_Card_Issuer") {
        $staff_member = new NIC_Issuer($_POST);
    }


    $db_manager = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
    $db_manager->set_db($conn);
    $db_manager->set_row_id($_SESSION['user_id']);
    $db_manager->add_L_P_User($_POST['staff_id'], $staff_member->get_user_type(), $_POST['uname'], $_POST['email'], $_POST['password'], $staff_member);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.min.js"></script>


    <title>Add Staff</title>
    <script>
        function ShowDetails() {
            document.getElementById("Create_form").disabled = false;
            var Database_Manager = document.getElementById("Officer_DM")
            var Admin = document.getElementById("Officer_A")
            var Estate_Superintendent = document.getElementById("Officer_E")
            var Grama_Niladari = document.getElementById("Officer_G");
            var Divitional_Secretary = document.getElementById("Officer_D");
            var Principal = document.getElementById("Officer_P");
            var National_Identity_Card_Issuer = document.getElementById("Officer_N");
            var Disable_Tag = document.getElementById("Disable_Tag");
            var Deatils_NIC = document.getElementById("DeatilsN");
            var Officer_form = document.getElementById("Create_form");
            var submit_button = document.getElementById("Submit_button");
            var Password = document.getElementById("Password");
            var Estate_Superintendent = document.getElementById("Officer_E");

            if (Database_Manager.checked) {
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            }else if (Admin.checked) {
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            } else if (Estate_Superintendent.checked) {
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "block";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            } else if (Grama_Niladari.checked) {
                document.getElementById("DeatilsG").style.display = "block";
                document.getElementById("DeatilsD").style.display = "block";
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            } else if (Divitional_Secretary.checked) {
                document.getElementById("DeatilsD").style.display = "block";
                Officer_form.style.display = "block";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            } else if (Principal.checked) {
                document.getElementById("DeatilsP").style.display = "block";
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            } else if (National_Identity_Card_Issuer.checked) {
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";
            }

        }

        function HideDetails() {
            document.getElementById("Create_form").disabled = false;
            var Database_Manager = document.getElementById("Officer_DM")
            var Admin = document.getElementById("Officer_A")
            var Estate_Superintendent = document.getElementById("Officer_E")
            var Grama_Niladari = document.getElementById("Officer_G");
            var Divitional_Secretary = document.getElementById("Officer_D");
            var Principal = document.getElementById("Officer_P");
            var National_Identity_Card_Issuer = document.getElementById("Officer_N");
            var Disable_Tag = document.getElementById("Disable_Tag");
            var Deatils_NIC = document.getElementById("DeatilsN");
            var Officer_form = document.getElementById("Create_form");
            var submit_button = document.getElementById("Submit_button");
            var Password = document.getElementById("Password");
            var Estate_Superintendent = document.getElementById("Officer_E");

            if (Database_Manager.checked) {
                Officer_form.style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";

            }else if (Admin.checked) {
                Officer_form.style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";

            } else if (Estate_Superintendent.checked) {
                Officer_form.style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";

            } else if (Grama_Niladari.checked) {
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                Officer_form.style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";

            } else if (Divitional_Secretary.checked) {
                document.getElementById("DeatilsD").style.display = "none";
                Officer_form.style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";

            } else if (Principal.checked) {
                document.getElementById("DeatilsP").style.display = "none";
                Officer_form.style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";

            } else if (National_Identity_Card_Issuer.checked) {
                Officer_form.style.display = "none";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";

            }

            Password.style.display = "none";
            submit_button.style.display = "none";

        }
    </script>
    <link rel="stylesheet" href="bootstrap.css">

</head>
<body style="background-color:#9886e6fd;">
<!-- Deatils_NIC.style.display="block"; -->


<div style="padding: 100px;  background-color: #9886e6fd; font-weight: bolder;">
    <div>
        <div>
            <div>

                <form id="add-staff-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <fieldset id="Disable_Tag">
                        <br>
                        <h2 style="color: black;  ">Select The Officer's Profession</h2>
                        <br>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Database_Manager" name="officer"
                                   id="Officer_DM" onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_DM">Database Manager</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Admin" name="officer"
                                   id="Officer_A" onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_A">Admin</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" name="officer" value="Estate_Superintendent"
                                   id="Officer_E" onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_E">Estate Superintendent</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Divisional_Secretary" name="officer"
                                   id="Officer_D" onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_D">Divisional Secretary</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Grama_Niladari" name="officer"
                                   id="Officer_G" onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_G">Grama Niladari</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Principal" name="officer" id="Officer_P"
                                   onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_P">Principal</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" name="officer"
                                   value="National_Identity_Card_Issuer" id="Officer_N" onclick="HideDetails()">
                            <label class="form-check-label" for="Officer_N">National Identity Card Issuer</label>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="ShowDetails()">Get Details</button>

                    </fieldset>

                    <fieldset id="Create_form" style="display: none;">
                        <br>
                        <h2 style="color: black;  ">Create Staff Account</h2>
                        <br>
                        <div class="mb-3">
                            <label for="exampleInputFname" class="form-label">Officer's Full Name</label>
                            <input type="text" class="form-control" id="exampleInputFname" name="fname"
                                   aria-describedby="emailHelp" placeholder="Enter full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUname" class="form-label">Username</label>
                            <input type="text" class="form-control" id="exampleInputUname" name="uname"
                                   aria-describedby="emailHelp" placeholder="Enter user name" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="Enter email.address" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputIDnumber" class="form-label">Staff ID No.</label>
                            <?php
                            $last_staff_id = (!is_null($conn->get_column_value("user_details", "staff_id", ">", "0", "staff_id", "ORDER BY staff_id DESC"))) ? $conn->get_column_value("user_details", "staff_id", ">", "0", "staff_id", "ORDER BY staff_id DESC") : 0;
                            ?>
                            <input type="text" class="form-control" name="staff_id" id="exampleInputIDnumber"
                                   aria-describedby="emailHelp" placeholder="Enter identticard number"
                                   value="<?php echo($last_staff_id + 1) ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputMNumber" class="form-label">Mobile Number</label>
                            <input type="number" class="form-control" name="mobileNo" id="exampleInputMNumber"
                                   placeholder="Enter mobile number" required>
                        </div>
                    </fieldset>


                    <fieldset id="DeatilsP" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputSchool" class="form-label">Current Working School</label>
                            <input type="text" class="form-control" name="school" id="exampleInputSchool"
                                   placeholder="Enter current working school">

                             <script>
                               $(function () {
                                 <?php
                                 $php_array = $conn->get_table_info("schools", "school");
                                 $js_array = json_encode($php_array);
                                 ?>
                                 var variables = <?php echo $js_array;?>;
                                 $("#exampleInputSchool").autocomplete({
                                   source: variables
                                 });
                               });
                             </script>
                        </div>
                    </fieldset>
                    <fieldset id="DeatilsG" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputGDivition" class="form-label">Grama Niladari Division</label>
                            <input type="text" class="form-control" name="gdivision" id="exampleInputGDivition"
                                   placeholder="Enter current working grama niladari division">

                             <script>
                               $(function () {
                                 <?php
                                 $php_array = $conn->get_table_info("gn", "GN_division");
                                 $js_array = json_encode($php_array);
                                 ?>
                                 var variables = <?php echo $js_array;?>;
                                 $("#exampleInputGDivition").autocomplete({
                                   source: variables
                                 });
                               });
                             </script>
                        </div>
                    </fieldset>
                    <fieldset id="DeatilsD" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputDSecretariat" class="form-label">Divisional Secretariat</label>
                            <input type="text" class="form-control" name="ds" id="exampleInputDSecretariat"
                                   placeholder="Enter current working divisional secretariat">

                             <script>
                               $(function () {
                                 <?php
                                 $php_array = $conn->get_table_info("ds", "DS");
                                 $js_array = json_encode($php_array);
                                 ?>
                                 var variables = <?php echo $js_array;?>;
                                 $("#exampleInputDSecretariat").autocomplete({
                                   source: variables
                                 });
                               });
                             </script>
                        </div>
                    </fieldset>
                    <fieldset id="DeatilsE" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputEAddress" class="form-label">Estate Address</label>
                            <input type="text" class="form-control" name="estate" id="exampleInputEAddress"
                                   placeholder="Enter current working estate address">

                             <script>
                               $(function () {
                                 <?php
                                 $php_array = $conn->get_table_info("estates", "estate");
                                 $js_array = json_encode($php_array);
                                 ?>
                                 var variables = <?php echo $js_array;?>;
                                 $("#exampleInputEAddress").autocomplete({
                                   source: variables
                                 });
                               });
                             </script>

                        </div>
                    </fieldset>


                    <!-- <fieldset id="DeatilsN" style="display: none;"> -->

                    <!-- <h2 style="color: black;  ">Create Identticard Issuer Account</h2>
                    <div class="mb-3" >
                          <label for="exampleInputCName" class="form-label">Company Name</label>
                          <input type="text" class="form-control" id="exampleInputCName" placeholder="Enter company name">
                    </div>
                    <div class="mb-3">
                          <label for="exampleInputCEmail1" class="form-label">Company Email Address</label>
                          <input type="email" class="form-control" id="exampleInputCEmail1" aria-describedby="emailHelp" placeholder="Enter company email address">

                    </div>
                    <div class="mb-3">
                          <label for="exampleInputCNumber" class="form-label">Contract Number</label>
                          <input type="number" class="form-control" id="exampleInputCNumber" placeholder="Enter contract number">
                    </div> -->

                    <!-- </fieldset> -->
                    <fieldset id="Password" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                   placeholder="Enter password" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputCPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputCPassword"
                                   placeholder="Enter password,again" required>
                        </div>
                    </fieldset>
                    <fieldset id="Submit_button" style="display: none;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#Officer_E').change(function () {
            if(this.checked) {
                $('#exampleInputEAddress').prop('required', true);
            } else {
                $('#exampleInputEAddress').prop('required', false);
            }
        });

        $('#Officer_D').change(function () {
            if(this.checked) {
                $('#exampleInputDSecretariat').prop('required', true);
            } else {
                $('#exampleInputDSecretariat').prop('required', false);
            }
        });

        $('#Officer_G').change(function () {
            if(this.checked) {
                $('#exampleInputGDivition').prop('required', true);
                $('#exampleInputDSecretariat').prop('required', true);
            } else {
                $('#exampleInputGDivition').prop('required', false);
                $('#exampleInputDSecretariat').prop('required', false);
            }
        });

        $('#Officer_P').change(function () {
            if(this.checked) {
                $('#exampleInputSchool').prop('required', true);
            } else {
                $('#exampleInputSchool').prop('required', false);
            }
        });


    </script>

</body>
</html>
