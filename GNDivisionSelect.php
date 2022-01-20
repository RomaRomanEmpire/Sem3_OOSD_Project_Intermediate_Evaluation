<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

$applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$applicant->set_db($conn);
$applicant->set_row_id($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $application = $applicant->getApplication();
    if (!empty($_POST['DS_division'])) {

        $gnCode = $applicant->fetchGnCode($_POST['GN_division'], $_POST['DS_division']);

        if (!is_null($gnCode)) {

            $basic_adr = $_POST['GN_division'];
            $ds_adr = $_POST['DS_division'];

            header("location: IdRequestForm.php?id=$id&table='gn'&basic=$basic_adr&ds=$ds_adr");
        } else {
            echo "<script type='text/javascript'>alert('Two divisions does not match. Fill again.');</script>";
        }
    } else if (!empty($_POST['school'])) {
        $basic_adr = $_POST['school'];
        $ds_adr = "";
        header("location: IdRequestForm.php?id=$id&table='schools'&basic=$basic_adr&ds=$ds_adr");
    } else if (!empty($_POST['estate'])) {
        $basic_adr = $_POST['estate'];
        $ds_adr = "";
        header("location: IdRequestForm.php?id=$id&table='estates'&basic=$basic_adr&ds=$ds_adr");
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisions Select</title>

    <script src="jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="Javascipt_File.js"></script>

    <script type="text/javascript">
        function ShowDetails() {
            var student = document.getElementById("detailsStudents")
            var estateWorker = document.getElementById("detailsEstateWorkers");
            var other = document.getElementById("detailsOther");
            var student_check = document.getElementById("student")
            var estateWorker_check = document.getElementById("estateWorker");
            var other_check = document.getElementById("otherAppliers");
            var submit_button = document.getElementById("submit");
            if (student_check.checked) {
                estateWorker.style.display = "none";
                other.style.display = "none";
                student.style.display = "block";
                submit_button.style.display = "block";
            } else if (estateWorker_check.checked) {
                student.style.display = "none";
                other.style.display = "none";
                estateWorker.style.display = "block";
                submit_button.style.display = "block";
            } else if (other_check.checked) {
                student.style.display = "none";
                estateWorker.style.display = "none";
                other.style.display = "block";
                submit_button.style.display = "block";
            }
        }

        function HideDetails() {
            var student = document.getElementById("detailsStudents")
            var estateWorker = document.getElementById("detailsEstateWorkers");
            var other = document.getElementById("detailsOther");
            var student_check = document.getElementById("student")
            var estateWorker_check = document.getElementById("estateWorker");
            var other_check = document.getElementById("otherAppliers");
            var submit_button = document.getElementById("submit");
            if (student_check.checked) {
                estateWorker.style.display = "none";
                other.style.display = "none";
                student.style.display = "none";
            } else if (estateWorker_check.checked) {
                student.style.display = "none";
                other.style.display = "none";
                estateWorker.style.display = "none";
            } else if (other_check.checked) {
                student.style.display = "none";
                estateWorker.style.display = "none";
                other.style.display = "none";
            }
            submit_button.style.display = "none";
        }

        function validate_gn_ds() {
            var school = document.getElementById("sch_data").value;
            var estate = document.getElementById("est_data").value;
            var ds_div = document.getElementById("ds_data").value;
            var gn_div = document.getElementById("gn_data").value;
            var student_check = document.getElementById("student")
            var estateWorker_check = document.getElementById("estateWorker");
            var other_check = document.getElementById("otherAppliers");

            if (student_check.checked) {
                var sch = <?php echo json_encode($_SESSION['val_array1']??NULL); ?>;
                if (!sch.includes(school)) {
                    alert("Enter a correct School name");
                    return false;
                }

            } else if (estateWorker_check.checked) {
                var est = <?php echo json_encode($_SESSION['val_array2']??NULL); ?>;
                if (!est.includes(estate)) {
                    alert("Enter a correct Estate");
                    return false;
                }

            } else if (other_check.checked) {
                var ds = <?php echo json_encode($_SESSION['val_array3']??NULL); ?>;
                if (!ds.includes(ds_div)) {
                    alert("Enter a correct Divisional section");
                    return false;
                }
                var est = <?php echo json_encode($_SESSION['val_array4']??NULL); ?>;
                if (!est.includes(gn_div)) {
                    alert("Enter a correct Grama niladari division");
                    return false;
                }
                return true;
            }
        }


    </script>

    <style>
        fieldset {
            border: none;
        }

        h1 {
            margin: 10px;
            font-size: 30px;
        }

        label {
            font-size: 20px;
            font-style: italic;
            /* margin: 10px; */
        }

        input[type="radio"] {
            margin: 10px;
            text-align: center;
        }

        input[type="text"] {
            width: 50%;
            padding: 10px 10px;
            margin: 10px;
            /* margin-bottom: 10px; */
            display: inline-block;
            border: 1px solid rgb(61, 57, 88);
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #ca89bc;
            border-color: rgb(1, 15, 15);
        }

        ::placeholder {
            color: #000;
        }

        button, input[type="submit"] {
            float: center;
            margin-top: 10px;
            padding: 10px 30px;
            border: none;
            outline: none;
            background-color: rgb(180, 220, 255);
            font-family: 'Montserrat';
            font-size: 15px;
            cursor: pointer;
        }

        body {
            background-color: cornsilk;
        }
    </style>

</head>

<body>
<div>
    <div class="header1">
        <div>
            <a href='dashboard.php'
               style="float: right;">
                <button type="button" class="btn btn-outline-light" id="Back"
                        style="background-color: pink; float: right; margin-right: 50px; height: 50px; width: 100px; "
                ">Back
                </button>
            </a>
        </div>
    </div>

    <div style="padding-top: 50px;">
        <fieldset>
            <h1>Who are You?</h1>
            <br>

            <div>
                <input type="radio" class="check-input" value="student" name="applier" id="student"
                       onclick="ShowDetails()">
                <label class="check-label" for="student">A Student</label>
            </div>

            <div>
                <input type="radio" class="check-input" value="estateWorker" name="applier" id="estateWorker"
                       onclick="ShowDetails()">
                <label class="check-label" for="estateWorker">An Estate Worker</label>
            </div>
            <div>
                <input type="radio" class="check-input" value="otherAppliers" name="applier" id="otherAppliers"
                       onclick="ShowDetails()">
                <label class="check-label" for="otherAppliers">Other</label>
            </div>

        </fieldset>

        <form id="division-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?
        id=<?php echo $_GET['id']; ?>" method="POST" onsubmit="return validate_gn_ds()">
            <fieldset id="detailsStudents" style="display: none;">
                <div>
                    <h2>What is your school?</h2>
                    <b><label for="school">School</label></b><br>

                    <input type="text" name="school" id="sch_data" list="schools" placeholder="Select your school....">
                    <datalist id="schools">

                        <script>
                            $(function () {
                                <?php
                                $php_array = $applicant->getAutoloadArray("schools", "basic_division", "1");
                                $_SESSION['val_array1'] = $php_array;
                                $js_array = json_encode($php_array);

                                ?>
                                var variables = <?php echo $js_array;?>;
                                $("#sch_data").autocomplete({
                                    source: variables
                                });
                            });

                        </script>


                    </datalist>

                    <br>
                </div>
            </fieldset>

            <fieldset id="detailsEstateWorkers" style="display: none;">
                <div>
                    <h2>What is your Estate Division?</h2>
                    <b><label for="estateDivision">Estate Division</label></b><br>
                    <input type="text" name="estate" id="est_data" list="estateDivisions"
                           placeholder="Select your Estate Division....">
                    <datalist id="estateDivisions">


                        <script>
                            $(function () {
                                <?php
                                $php_array = $applicant->getAutoloadArray("estates", "basic_division", "1");
                                $_SESSION['val_array2'] = $php_array;
                                $js_array = json_encode($php_array);

                                ?>
                                var variables = <?php echo $js_array;?>;
                                $("#est_data").autocomplete({
                                    source: variables
                                });
                            });
                        </script>
                    </datalist>
                    <br>
                </div>
            </fieldset>

            <filedset id="detailsOther" style="display: none;">
                <div>
                    <h2>What is your Grama Niladari Division and Divisional Secretariat Division?</h2>

                    <b><label for="DS_division">Divisional Secretariat Division</label></b><br>
                    <input type="text" id="ds_data" list="DS_divisions" name="DS_division"
                           placeholder="Select your DS Division....">
                    <datalist id="DS_divisions">

                        <script>
                            $(function () {
                                <?php
                                $php_array = $applicant->getAutoloadArray("ds", "DS", "1");
                                $_SESSION['val_array3'] = $php_array;
                                $js_array = json_encode($php_array);

                                ?>
                                var variables = <?php echo $js_array;?>;
                                $("#ds_data").autocomplete({
                                    source: variables
                                });
                            });

                            var ds = document.getElementById("ds_data");
                            ds.addEventListner("input", function () {
                                document.getElementById("gn_data").disabled = this.value != "";
                            });

                        </script>

                    </datalist>
                    <br>


                    <b><label for="GN_division">Grama Niladari Division</label></b><br>

                    <input type="text" id="gn_data" list="GN_divisions" name="GN_division"
                           placeholder="Select your GN Division...." disabled=true>
                    <datalist id="GN_divisions">

                        <script>
                            $(function () {
                                <?php
                                $php_array = $applicant->getAutoloadArray("gn", "basic_division", "1");
                                $_SESSION['val_array4'] = $php_array;
                                $js_array = json_encode($php_array);

                                ?>
                                var variables = <?php echo $js_array;?>;
                                $("#gn_data").autocomplete({
                                    source: variables
                                });
                            });

                            var ds_data = document.getElementById("ds_data");
                            ds_data.addEventListener("input", function () {
                                document.getElementById("gn_data").disabled = this.value == "";
                            });

                        </script>


                    </datalist>
                    <br>

                </div>
            </filedset>

            <fieldset id="submit" style="display: none">
                <br>

                <button type="submit" name='submit' value="Submit">Submit</button>
            </fieldset>
        </form>
    </div>
</div>

<script>
    $('#student').change(function () {
        if (this.checked) {
            $('#sch_data').prop('required', true);
        } else {
            $('#sch_data').prop('required', false);
        }
    });

    $('#estateWorker').change(function () {
        if (this.checked) {
            $('#est_data').prop('required', true);
        } else {
            $('#est_data').prop('required', false);
        }
    });

    $('#otherAppliers').change(function () {
        if (this.checked) {
            $('#ds_data').prop('required', true);
            $('#gn_data').prop('required', true);
        } else {
            $('#ds_data').prop('required', false);
            $('#gn_data').prop('required', false);
        }
    });


</script>
</body>

</html>
