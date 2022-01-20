<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

$user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($conn);

$application = unserialize($user->fetch_value("application_details", "app_id", $_GET['application_id'], "application_object"));
$application_id = $_GET['application_id'];
$applicant_id = $user->fetch_value('application_details', 'app_id', $application_id, 'applicant_id');


if ($_GET['sign_no'] == 4) {
    $notification = $user->prepare_notification('confirmation', 'application confirmation by '.$user->get_user_type());
    $notification->setApplicantId($applicant_id);
    $user->approve_application($application,$notification);
    header("location: Filled_Application.php?application_id=$application_id");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'functions.php';
    $sign = uploadSign($_POST['signed']);

    if ($_GET['sign_no'] == 1) {
        $user->add_applicant_sign($application, $sign);
    } elseif ($_GET['sign_no'] == 2) {
        $application->setRapSign($sign);
        $notification = $user->prepare_notification('confirmation', 'application confirmation by '.$user->get_user_type());
        $notification->setApplicantId($applicant_id);
        $user->approve_application($application,$notification);

    } elseif ($_GET['sign_no'] == 3) {
        $application->setDsSign($sign);
        $notification = $user->prepare_notification('confirmation', 'application confirmation by '.$user->get_user_type());
        $notification->setApplicantId($applicant_id);
        $user->approve_application($application,$notification);

    }


    header("location: Filled_Application.php?application_id=$application_id");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Signature Pad Example - Tutsmake.com</title>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
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
        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 16vh;
            width: 100%;
            /* background-color: #00b4db; */
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;
            padding-right: 10px;

        }
    </style>

</head>
<body>
<div class="header1">
<a href="Filled_Application.php?application_id=<?php echo $_GET['application_id'];?>">
                                <button type="button" class="btn btn-sm btn-outline-light fas fa-arrow-left"
                                        style="width: 100px;font-size:18px;color:black;height:30px;"><b>Back</b>
                                </button>
                            </a>
</div>
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