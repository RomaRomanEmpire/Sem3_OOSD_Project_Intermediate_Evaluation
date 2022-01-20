<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['officer'] == "Database_Manager") {
        $staff_member = new DatabaseManager($_POST);
    } else if ($_POST['officer'] == "Admin") {
        $staff_member = new Admin($_POST);
    } else if ($_POST['officer'] == "Estate_Superintendent") {
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

    if ($_POST['officer'] == "Grama_Niladari") {
        if (!empty($_POST['gdivision'])) {
            $table = 'gn';
            $div = $_POST['gdivision'];
            $div2 = $_POST['ds'];
            $table2 = 'ds';
            $array = $_SESSION['val_array2'];
            $array2 = $_SESSION['val_array3'];
//        }

            $ds_id = $conn->get_column_value('ds', 'DS', '=', $div2, 'DS_code', '');
            $gnCode = $conn->get_column_value2('gn', 'basic_division', 'DS_code', $div, $ds_id, 'division_id');

            if (!is_null($gnCode)) {
                $db_manager->add_user($table, $div, $_POST['staff_id'], $staff_member);
            } else {
                echo "<script type='text/javascript'>alert('two divisions are not connected')window.location.href = 'Add_staff_member.php';;</script>";
            }

        }
    } else {
        if (!empty($_POST['school'])) {
            $table = 'schools';
            $div = $_POST['school'];
        } else if (!empty($_POST['ds1'])) {
            $table = 'ds';
            $div = $_POST['ds1'];
        } else if (!empty($_POST['estate'])) {
            $table = 'estates';
            $div = $_POST['estate'];
        } else {
            $table = '';
            $div = '';
        }

        $db_manager->add_user($table, $div, $_POST['staff_id'], $staff_member);
    }
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
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>

    <title>Add Staff</title>
    <style>
        input[type="text"], input[type="email"], input[type="date"], input[type="password"], input[type="number"] {
            background-color: #84bbc7;
        }

        h2 {

            font-weight: bolder;

        }

        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 19vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;

        }
    </style>
    <script>
        (function () {
            if (window.localStorage) {
                if (!localStorage.getItem('firstLoad')) {
                    localStorage['firstLoad'] = true;
                    window.location.reload();
                } else
                    localStorage.removeItem('firstLoad');
            }
        })();

        function ShowDetails() {
            document.getElementById("Create_form").disabled = false;
            var Database_Manager = document.getElementById("Officer_DM");
            var Admin = document.getElementById("Officer_A");
            var Estate_Superintendent = document.getElementById("Officer_E");
            var Grama_Niladari = document.getElementById("Officer_G");
            var Divitional_Secretary = document.getElementById("Officer_D");
            var Principal = document.getElementById("Officer_P");
            var National_Identity_Card_Issuer = document.getElementById("Officer_N");
            var Disable_Tag = document.getElementById("Disable_Tag");
            var Deatils_NIC = document.getElementById("DeatilsN");
            var Officer_form = document.getElementById("Create_form");
            var submit_button = document.getElementById("Submit_button");
            var Password = document.getElementById("Password");

            if (Database_Manager.checked) {
                Officer_form.style.display = "block";
                document.getElementById("DeatilsE").style.display = "none";
                document.getElementById("DeatilsG").style.display = "none";
                document.getElementById("DeatilsD").style.display = "none";
                document.getElementById("DeatilsP").style.display = "none";
                Password.style.display = "block";
                submit_button.style.display = "block";

            } else if (Admin.checked) {
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
                document.getElementById("DeatilsD1").style.display = "block";
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

        // function HideDetails() {
        //     document.getElementById("Create_form").disabled = false;
        //     var Database_Manager = document.getElementById("Officer_DM")
        //     var Admin = document.getElementById("Officer_A")
        //     var Estate_Superintendent = document.getElementById("Officer_E")
        //     var Grama_Niladari = document.getElementById("Officer_G");
        //     var Divitional_Secretary = document.getElementById("Officer_D");
        //     var Principal = document.getElementById("Officer_P");
        //     var National_Identity_Card_Issuer = document.getElementById("Officer_N");
        //     var Disable_Tag = document.getElementById("Disable_Tag");
        //     var Deatils_NIC = document.getElementById("DeatilsN");
        //     var Officer_form = document.getElementById("Create_form");
        //     var submit_button = document.getElementById("Submit_button");
        //     var Password = document.getElementById("Password");
        //
        //     if (Database_Manager.checked) {
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsD").style.display = "none";
        //         document.getElementById("DeatilsP").style.display = "none";
        //
        //     } else if (Admin.checked) {
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsD").style.display = "none";
        //         document.getElementById("DeatilsP").style.display = "none";
        //
        //     } else if (Estate_Superintendent.checked) {
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsD").style.display = "none";
        //         document.getElementById("DeatilsP").style.display = "none";
        //
        //     } else if (Grama_Niladari.checked) {
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsD").style.display = "none";
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsP").style.display = "none";
        //
        //     } else if (Divitional_Secretary.checked) {
        //         document.getElementById("DeatilsD").style.display = "none";
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsP").style.display = "none";
        //
        //     } else if (Principal.checked) {
        //         document.getElementById("DeatilsP").style.display = "none";
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsD").style.display = "none";
        //
        //     } else if (National_Identity_Card_Issuer.checked) {
        //         Officer_form.style.display = "none";
        //         document.getElementById("DeatilsE").style.display = "none";
        //         document.getElementById("DeatilsG").style.display = "none";
        //         document.getElementById("DeatilsD").style.display = "none";
        //         document.getElementById("DeatilsP").style.display = "none";
        //
        //     }
        //
        //     Password.style.display = "none";
        //     submit_button.style.display = "none";
        //
        // }


        function validate_fields() {
            var school = document.getElementById("exampleInputSchool").value;
            var estate = document.getElementById("exampleInputEAddress").value;
            var ds_div = document.getElementById("exampleInputDSecretariat").value;
            var gn_div = document.getElementById("exampleInputGDivition").value;

            var p_check = document.getElementById("Officer_P")
            var e_check = document.getElementById("Officer_E");
            var d_check = document.getElementById("Officer_D");
            var g_check = document.getElementById("Officer_G");

            if (p_check.checked) {
                var sch = <?php echo json_encode($_SESSION['val_array1'] ?? NULL); ?>;
                if (!sch.includes(school)) {
                    alert("Enter a correct School name");
                    return false;
                }

            } else if (e_check.checked) {
                var est = <?php echo json_encode($_SESSION['val_array4'] ?? NULL); ?>;
                if (!est.includes(estate)) {
                    alert("Enter a correct Estate");
                    return false;
                }

            } else if (d_check.checked) {
                var ds = <?php echo json_encode($_SESSION['val_array3'] ?? NULL); ?>;
                if (!ds.includes(ds_div)) {
                    alert("Enter a correct Divisional section");
                    return false;
                }
            } else if (g_check.checked) {
                var ds = <?php echo json_encode($_SESSION['val_array3'] ?? NULL); ?>;
                if (!ds.includes(ds_div)) {
                    alert("Enter a correct Divisional section");
                    return false;
                }
                var gn = <?php echo json_encode($_SESSION['val_array2'] ?? NULL); ?>;
                if (!gn.includes(gn_div)) {
                    alert("Enter a correct Grama niladari division");
                    return false;
                }
                // return true;//was
            }

            return true;//test
        }


    </script>
    <link rel="stylesheet" href="bootstrap.css">

</head>
<body style="color: white; background: rgb(10,30,235);
background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">
<!-- Deatils_NIC.style.display="block"; -->
<div class="header1"><a href="DatabaseManagerDashboard.php">
        <button type="submit" class="btn btn-sm btn-outline-light fas fa-arrow-left"
                style="width: 100px;font-size:18px;margin-right:20px;color:black;"> Back
        </button>
    </a></div>

<div style="padding: 100px;  background: rgb(10,30,235);
background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%); font-weight: bolder;">
    <div>
        <div>
            <div>

                <form id="add-staff-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                      onsubmit="return validate_fields()">
                    <fieldset id="Disable_Tag">
                        <br>
                        <h2 style="color: black;  ">Select The Officer's Profession</h2>
                        <br>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Database_Manager" name="officer"
                                   id="Officer_DM" onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_DM">Database Manager</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Admin" name="officer"
                                   id="Officer_A" onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_A">Admin</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" name="officer" value="Estate_Superintendent"
                                   id="Officer_E" onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_E">Estate Superintendent</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Divisional_Secretary" name="officer"
                                   id="Officer_D" onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_D">Divisional Secretary</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Grama_Niladari" name="officer"
                                   id="Officer_G" onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_G">Grama Niladari</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" value="Principal" name="officer" id="Officer_P"
                                   onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_P">Principal</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-check-input" name="officer"
                                   value="National_Identity_Card_Issuer" id="Officer_N" onclick="ShowDetails()">
                            <label class="form-check-label" for="Officer_N">National Identity Card Issuer</label>
                        </div>

                        <!--          <button type="button" class="btn btn-primary" onclick="ShowDetails()">Get Details</button>-->

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
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputIDnumber" class="form-label">Staff ID No.</label>
                            <?php
                            $last_staff_id = (!is_null($conn->get_column_value("user_details", "staff_id", ">", "0", "staff_id", "ORDER BY staff_id DESC"))) ? $conn->get_column_value("user_details", "staff_id", ">", "0", "staff_id", "ORDER BY staff_id DESC") : 0;
                            ?>
                            <input type="text" class="form-control" name="staff_id" id="exampleInputIDnumber"
                                   style=" background-color: #84bbc7;"
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
                                    $php_array = $conn->get_table_info("schools", "basic_division", 0);
                                    $_SESSION['val_array1'] = $php_array;
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
                                    $php_array = $conn->get_table_info("gn", "basic_division", 0);
                                    $_SESSION['val_array2'] = $php_array;
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
                                    $php_array = $conn->get_table_info("ds", "DS", 0);
                                    $_SESSION['val_array3'] = $php_array;
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
                    <fieldset id="DeatilsD1" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputDSecretariat1" class="form-label">Divisional Secretariat</label>
                            <input type="text" class="form-control" name="ds1" id="exampleInputDSecretariat1"
                                   placeholder="Enter current working divisional secretariat">

                            <script>
                                $(function () {
                                    <?php
                                    $php_array = $conn->get_table_info("ds", "DS", 1);
                                    $_SESSION['val_array3'] = $php_array;
                                    $js_array = json_encode($php_array);
                                    ?>
                                    var variables = <?php echo $js_array;?>;
                                    $("#exampleInputDSecretariat1").autocomplete({
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
                                    $php_array = $conn->get_table_info("estates", "basic_division", 0);
                                    $_SESSION['val_array4'] = $php_array;
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

                    <fieldset id="Password" style="display: none;">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                   placeholder="Enter password" onkeyup="verifyPassword()" required>
                            <meter min="1" max="100" value="0" low="0" high="0" id="grade"></meter>
                            <span id="msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputCPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputCPassword"
                                   placeholder="Enter password,again" onchange="PasswordValidity()" required>
                        </div>
                    </fieldset>
                    <fieldset id="Submit_button" style="display: none;">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#Officer_E').change(function () {
            if (this.checked) {
                $('#exampleInputEAddress').prop('required', true);
            } else {
                $('#exampleInputEAddress').prop('required', false);
            }
        });

        $('#Officer_D').change(function () {
            if (this.checked) {
                $('#exampleInputDSecretariat').prop('required', true);
            } else {
                $('#exampleInputDSecretariat').prop('required', false);
            }
        });

        $('#Officer_G').change(function () {
            if (this.checked) {
                $('#exampleInputGDivition').prop('required', true);
                $('#exampleInputDSecretariat').prop('required', true);
            } else {
                $('#exampleInputGDivition').prop('required', false);
                $('#exampleInputDSecretariat').prop('required', false);
            }
        });

        $('#Officer_P').change(function () {
            if (this.checked) {
                $('#exampleInputSchool').prop('required', true);
            } else {
                $('#exampleInputSchool').prop('required', false);
            }
        });


        var password_validate;
        var age_validate;
        var PW_length;

        function verifyPassword() {
            var pwd = document.getElementById("exampleInputPassword1").value;
            var msg = document.getElementById("msg");
            var grade = document.getElementById("grade");

            function showgrade(min, max, value, low, high) {
                grade.min = min;
                grade.max = max;
                grade.value = value;
                grade.low = low;
                grade.high = high;
            }

            var regExp = /(?=.*[A-Z])\w{4,15}/;
            if (pwd.match(regExp) && pwd.length > 8) {
                msg.innerHTML = "Strong Password";
                showgrade(1, 100, 100, 0, 0);
            } else {
                if (pwd.length < 4) {
                    msg.innerHTML = "poor password";
                    showgrade(1, 100, 100, 60, 80);
                } else {
                    msg.innerHTML = "Weak Password";
                    showgrade(1, 100, 100, 40, 80);
                }
            }
        }

        function PasswordValidity() {
            var pwd1 = document.getElementById("exampleInputPassword1").value;
            var pwd_conform = document.getElementById("exampleInputCPassword").value;
            var btn = document.getElementById("button");

            if ((pwd1 == pwd_conform) && (pwd1.length >= 8 && pwd1.length <= 14)) {
                return true;
            } else {
                alert("Password conformation is wrong!! and must give strong password length.Charctor length must be in 8 to 14 range");
                return false;
            }
        }

    </script>

</body>
</html>
