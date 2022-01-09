<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();


$application = unserialize($conn->get_column_value("application_details", "app_id", "=", $_GET['application_id'], "application_object", ""));
$application->setRowId($_GET['application_id']);

$user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($conn);
$user->set_row_id($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $folderPath = "uploads/";
    $image_parts = explode(";base64,", $_POST['signed']);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = $folderPath . uniqid() . '.' . $image_type;
    file_put_contents($file, $image_base64);

//echo "Signature Uploaded Successfully.";

    if ($_GET['sign_no'] == 1) {
        //refine
        $application->setApplicantSign($file);
    } elseif ($_GET['sign_no'] == 2) {
        $application->setRapSign($file);
        $user->approve_application($application);
//        $application->setState(Sent_To_RAP_1::getSentToRap1());
    } elseif ($_GET['sign_no'] == 3) {
        $application->setDsSign($file);
        $user->approve_application($application);
    }
    $application_id = $_GET['application_id'];
    //refine
//    $conn->add_signs_to_application($application_id, $application);

    header("location: Filled_Application.php?application_id=$application_id");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Signature Pad Example - Tutsmake.com</title>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <link type="text/css" href="jquery-ui/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-ui/jquery-ui.min.js"></script>

    <script type="text/javascript" src="jquery-signature/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-signature/css/jquery.signature.css">

    <style>
        body {
            background: linear-gradient(#ce5ca8, #da95c3, #1B2ABD) no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        .kbw-signature {
            width: 600px;
            height: 300px;
            margin-left: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;

        }
    </style>

</head>
<body>

<div class="container">
    <form id="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?
        application_id=<?php echo $_GET['application_id']; ?>&sign_no=<?php echo $_GET['sign_no']; ?>" method="POST">

        <div class="col-md-12" style="margin-top: 50px;align-items:center;">
            <label class="" for="" style="font-size: 50px;padding-left:315px;padding-bottom:30px;">Place Your
                Signature</label>
            <br/>
            <div id="sig"
                 style="width:1000px;height:400px;margin-left:50px;z-index:3;border-color:black;border-width:4px;"></div>
            <br/>
            <button id="clear" style="font-size: 15px;margin-left:920px;margin-top:20px;" class="btn btn-danger">Clear
                Signature
            </button>
            <textarea id="signature64" name="signed" style="display: none"></textarea>
        </div>

        <br/>
        <div style="top:586px;position:absolute;">
            <button type="submit" class="btn btn-success" style="font-size: 15px;margin-left:800px;width:130px;">
                Submit
            </button>
        </div>
    </form>

</div>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function (e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

</body>
</html>