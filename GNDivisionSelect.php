<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();
$_SESSION['id'] = $_GET['id'] ?? $_SESSION['id'];

$applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$applicant->set_db($conn);
$applicant->set_row_id($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['GN_division'])) {

  $_SESSION['GN_division'] = $_POST['GN_division'];
  $_SESSION['DS_division'] = $_POST['DS_division'];
  $id = $_SESSION['id'];
  header("location: IdRequestForm.php?id=$id");

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

  <script>
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
    } else if (estateWorker_check.checked) {
      student.style.display = "none";
      other.style.display = "none";
      estateWorker.style.display = "block";
    } else if (other_check.checked) {
      student.style.display = "none";
      estateWorker.style.display = "none";
      other.style.display = "block";
    }
    submit_button.style.display = "block";
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
    var secretatiat_div = document.getElementById();
    var gn_div = document.getElementById();
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
    font-size: 10px;
    cursor: pointer;
  }

  body {
    background-color: cornsilk;
  }
  </style>

</head>

<body>
  <div>
    <div>
      <fieldset>
        <h1>Who are You?</h1>
        <br>
        <form id="division-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div>
            <input type="radio" class="check-input" name="applier" id="student" onclick="HideDetails()">
            <label class="check-label" for="student">A Student</label>
          </div>
          <div>
            <input type="radio" class="check-input" name="applier" id="estateWorker" onclick="HideDetails()">
            <label class="check-label" for="stateWorker">An Estate Worker</label>
          </div>
          <div>
            <input type="radio" class="check-input" name="applier" id="otherAppliers" onclick="HideDetails()">
            <label class="check-label" for="otherAppliers">Other</label>
          </div>
          <button type="button" onclick="ShowDetails()">Get Details</button>
          <!--                <button type="submit" >Get Details</button>-->
        </form>
      </fieldset>

      <form id="division-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <fieldset id="detailsStudents" style="display: none;">
          <div>
            <h2>What is your school?</h2>
            <b><label for="school">School</label></b><br>




            <input type="text" name="GN_division" id="sch_data" list="schools" placeholder="Select your school....">
            <datalist id="schools">

              <script>
              $(function () {
                <?php
                $php_array = $conn->get_table_info("schools", "school");
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
            <input type="text" name="GN_division" id="est_data" list="estateDivisions"
            placeholder="Select your Estate Division....">
            <datalist id="estateDivisions">



              <script>
              $(function () {
                <?php
                $php_array = $conn->get_table_info("estates", "estate");
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
            <input type="text" id="ds_data" list="DS_divisions" name="DS_division" placeholder="Select your DS Division....">
            <datalist id="DS_divisions">

              <script>
              $(function () {
                <?php
                $php_array = $conn->get_table_info("ds", "DS");
                $js_array = json_encode($php_array);

                ?>
                var variables = <?php echo $js_array;?>;
                $("#ds_data").autocomplete({
                  source: variables
                });
              });

              </script>

            </datalist>
            <br>


            <b><label for="GN_division">Grama Niladari Division</label></b><br>

            <input type="text" id="gn_data" list="GN_divisions" name="GN_division" placeholder="Select your GN Division....">
            <datalist id="GN_divisions">

              <script>
              $(function () {
                <?php
                $php_array = $conn->get_table_info("gn", "GN_division");
                $js_array = json_encode($php_array);

                ?>
                var variables = <?php echo $js_array;?>;
                $("#gn_data").autocomplete({
                  source: variables
                });
              });
              </script>

            </datalist>
            <br>

          </div>
        </filedset>

        <fieldset id="submit" style="display: none">
          <br>

          <button type="submit" onclick="validate_gn_ds()">Submit</button>
        </fieldset>
      </form>
    </div>
  </div>
</body>

</html>
