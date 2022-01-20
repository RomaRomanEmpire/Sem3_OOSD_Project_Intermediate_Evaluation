<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
    $user->set_db($conn);


    $not_content = 'appointment is scheduled on '.$_POST['date'].' '.$_POST['time']. 'Please confirm!';
    $application_id = $_GET['application_id'];
    $applicant_id = $user->fetch_value("application_details", "app_id", $application_id, "applicant_id");


    $notification = $user->prepare_notification('appointment',$not_content);

    $notification->setFromId($user->getRowId());
    $notification->setToId($applicant_id);
    $notification->setApplicationId($application_id);
    $notification->setAppointmentTime($_POST['time']);
    $notification->setAppointmentDate($_POST['date']);

    $user->send_time_slot($notification);
    header("location:Filled_Application.php?application_id=$application_id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot</title>
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
            padding: 200px 50px 50px;
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
    <a href="Filled_Application.php?application_id=<?php echo $_GET["application_id"];?>">
        <button type="submit" class="btn btn-sm btn-outline-light" style="width: 100px;font-size:18px;"><b
                    style="color:#000; ">Back</b>
        </button>
    </a>
</div>

<div class="Center">

    <fieldset id="time_slot">
        <h1 class="display-3">Send Appointment Time</h1>
        <br><br>
        <form id="appointment-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?application_id=<?php
        echo $_GET['application_id'];?>" method="POST">
            <div class="mb-3">
                <label for="Date" class="form-label" style="font-size: 20px;">Appointment Date</label>
                <input type="date" class="form-control" id="Date"
                       name="date" placeholder="Enter the appointment date" style=" background-color:bisque;">
            </div>
            <br>
            <label for="exampleDataList" class="form-label" style="font-size: 20px;">Appointment Time</label>
            <input class="form-control" list="datalistOptions" id="exampleDataList" name="time" placeholder="Type to search..."
                   type="text" style=" background-color:bisque;">
            <datalist id="datalistOptions">
                <option value="8.30 a.m.">
                <option value="9.00 a.m.">
                <option value="9.30 a.m.">
                <option value="10.00 a.m.">
                <option value="10.30 a.m.">
                <option value="11.00 a.m.">
                <option value="11.30 a.m.">
                <option value="12.00 p.m.">
                <option value="12.30 p.m.">
                <option value="1.00 p.m.">
            </datalist>
            <br>
            <button type="submit" class="btn btn-primary" style="width: 100px;">Submit</button>
        </form>
    </fieldset>


</div>

</body>
</html>