<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'functions.php';
    $user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
    $user->set_db($conn);

    $application = unserialize($user->fetch_value("application_details", "app_id", $_GET['application_id'], "application_object"));

    $application_id = $_GET['application_id'];

    $notification = $user->prepare_notification('confirmation', $_POST['reason']);

    $applicant_id = $user->fetch_value('application_details', 'app_id', $application_id, 'applicant_id');
    $notification->setApplicantId($applicant_id);


    if (isset($_FILES['attachment'])) {
        $attachment = checkFileValidity("attachment");
        if(isset($attachment)){
            $notification->setAttachment($attachment);
            $user->reject_application($application,$notification);
            header("location:View_Applications_Details.php");
        }
    }else{
        $user->reject_application($application,$notification);
        header("location:View_Applications_Details.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Application</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: bolder;
            color: bisque;
            min-height: 100vh;
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 1%, rgba(0, 212, 255, 1) 100%);

        }

        .Center {
            padding: 150px 50px 50px;
            border-color: black;

        }

        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 13vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: right;


        }

    </style>

</head>
<body>
<div class="header1" style="padding-right:10px;">
    <a href="Filled_Application.php">
        <button type="submit" class="btn btn-sm btn-outline-light" style="width: 100px;font-size:18px;"><b
                    style="color:#000; ">Back</b>
        </button>
    </a>
</div>

<div class="Center">

    <fieldset id="time_slot">
        <h1 class="display-3">Reject Application</h1>
        <br>
        <form id="reject-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?application_id=<?php
        echo $_GET['application_id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="floatingTextarea2">The reason for rejecting the application :</label>
            <br><br>
            <div class="form-floating">
                <textarea class="form-control" name="reason" placeholder="The reason for rejection of application......"
                          id="floatingTextarea2" style="height: 200px; background-color:bisque;"></textarea>

            </div>
            <br>
            <label for="file">Attachments :</label>
            <br>
            <input type="file" id="file" name="attachment">
            <br>

            <br>
            <button type="submit" class="btn btn-primary" style="width: 100px;">Submit</button>
        </form>
    </fieldset>


</div>

</body>
</html>