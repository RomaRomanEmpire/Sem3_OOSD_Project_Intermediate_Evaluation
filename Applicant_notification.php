<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();

$applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$applicant->set_db($conn);
$order = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['order']) && $_POST['order'] == 'latest')
        $order = "ORDER BY n_id DESC";
    if (isset($_GET['ref_id'])) {
        $ref_notification = unserialize($applicant->fetch_value("notification_details", "n_id", '=',$_GET['ref_id'], "n_object"));
        $notification_details = $ref_notification->accept($applicant);
        if ($_GET['type'] == 'confirm') {
            $notification = $applicant->prepare_notification('confirmation', 'date confirmed');
        } else {
            $notification = $applicant->prepare_notification('appointment', 'requesting for another date');
        }
        $notification->setFromId($_SESSION['user_id']);
        $notification->setToId($ref_notification->getFromId());
        $notification->setApplicationId($ref_notification->getApplicationId());
        $notification->setAppointmentDate($notification_details['appointment_date'] );
        $notification->setAppointmentTime($notification_details['appointment_time'] );
        $ref_notification->setHasReferenceNotificationId(true);

        if ($applicant->updateNotificationDetails($ref_notification))
            $applicant->send_notification($notification);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            min-height: 100vh;

        }

        img {
            width: 20px;
            height: 20px;
            border-radius: 30px;
        }


        input[type=submit],
        input[type=button] {
            background-color: purple;
            color: white;
            padding: 12px 12px;
            border: none;
            cursor: pointer;
        }
       .container1  .header2 {
                position: fixed;
                top: 0;
                right: 0;
                height: 120px;
                width: 85%;
                background-color: #050213fd;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 8px rgba(77, 51, 51, 0.2);
                z-index: 3;
            }

        .header2 button:hover {
            background-color: #525252;
        }

        .header2 select:hover {
            background-color: #525252;
        }

        .header2 button {
            height: 35px;
            width: 150px;
            text-align: center;
            /* background-color: #203169; */
            background: rgba(0,0,0,0.1);
            color: white;
            border-color: white;
        }
        .header2 button:hover {
            background: white;
            color: black;
        }
        .header2 select {
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            /* margin-top: 6px;
            margin-bottom: 16px; */
            resize: vertical;
            height: 35px;
            width: 250px;
            text-align: center;
            /* background-color: #203169; */
            background: rgba(0,0,0,0.1);
            color: white;
        }
        .header2 select:hover {
            background: white;
            color: black;
        }
        .header2 .hover_button a{
            height: 35px;
             width: 150px; 
             background: rgba(0,0,0,0.1);
              margin-top:30px;
               margin-right: 10px;
        }
     
        .header2 .hover_button a:hover{
            background: white;
            color: black;
        }

        table {
            table-layout: fixed;
            text-align: center;
        }

        td {
            word-wrap: break-word;
            padding-left: 10px;
            padding-right: 10px;
            
        }

        .container1 {
            position: absolute;
            right: 0;
            width: 100%;
            min-height: 100vh;
            
            /* background: linear-gradient(mediumpurple, white); */
        }
    </style>
    <script src="Javascipt_File.js">
    </script>
</head>
<body>
<div class="BackGround_Image">
<div class="container1 ">
    <div class="header2" style="background: rgba(0,0,0,0.5);">
        <div class="nav">
            <div style="height: 20px;padding-top:0%;place-content: center;padding-bottom:5px;">
                <h1 style="color: black; padding-left:500px; padding-top:0px;"><p id="Topic1">Appoinment Time</p></h1>
            </div>
            <table>

                <tbody>
                <tr>

                    <!-- <div class="input-group mb-3" style="width: 50%; padding-left: 0px; "></div> -->


                    <form id="order-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                      <div style="padding-top: 80px;padding-left:200px;">
                       <td >
                            

                                <select name="order" class="form-select" aria-label="Default select example">
                                    <option value="latest" selected="selected">Latest</option>
                                    <option value="oldest">Oldest</option>

                                </select>
                            
                        </td> 
                        <td >
                            <div>
                                <button type="submit" class="btn btn-success">Apply Filter
                                </button>
                            </div>
                        </td></div>
                    </form>
                </tr>
                </tbody>

            </table>


        </div>

        <div style="padding-top: 50px;" class="hover_button">
            <a class="btn btn-outline-light fas fa-arrow-left" href="dashboard.php" role="button"
               > Back</a>
        </div>

    </div>
    <div class="side_menu1" style="padding-top: 200px; padding-left:0px; background: rgba(0,0,0,0.5);">


        <ul>
            <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedT1" autocomplete="off"
                       onclick="Notification1()">
                <label class="btn btn-outline-secondary" for="btn_check_outlinedT1" style="border-color:white;"><p
                            style="width:100px; height:25px; text-align: center;color:white;"><i class="fas fa-angle-double-right"></i>Appoinment Time</p>
                </label><br>
            </li>

            <br>
            <li>
                <input type="radio" name="h" class="btn-check" id="btn_check_outlinedR1" autocomplete="off"
                       onclick="Notification1()">
                <label class="btn btn-outline-secondary" for="btn_check_outlinedR1" style="border-color:white;"><p
                            style="width:100px; height:25px; text-align: center;color:white;"><i class="fas fa-angle-double-right"></i>Confirmed Message</p>
                </label>
            </li>
            <br>

            <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedS1" autocomplete="off"
                       onclick="Notification1()">
                <label class="btn btn-outline-secondary" for="btn_check_outlinedS1" style="border-color:white;"><p
                            style="width:100px; height:25px; text-align: center;color:white; "><i class="fas fa-angle-double-right"></i>Sent Messages</p>
                </label>
            </li>

        </ul>

    </div>


    <div class="Center">

<fieldset id="Time1" style="display: block;">

    <table class="table table-primary table-hover">

        <thead>
        <tr>

            <th scope="col">Authorize officer</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
            <th scope="col">Confirm</th>
            <th scope="col">Ask another date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result_receive_appointment = $applicant->fetch_array_2('notification_details', 'to_id', 'n_type','=','=', $_SESSION['user_id'], 'appointment', $order);
        if (is_null($result_receive_appointment))
            echo "No notifications!";
        else {
            foreach ($result_receive_appointment as $i => $row):
                $notification = unserialize($applicant->fetch_value('notification_details', 'n_id','=', $row['n_id'], 'n_object'));
                $notification_details = $notification->accept($applicant);
                ?>

                <tr>
                    <td><?php
                        $officer = unserialize($applicant->fetch_value('user_details', 'user_id','=', $notification->getFromId(), 'u_object'));
                        echo $officer->get_user_type() . ' ' . $officer->get_user_name(); ?></td>
                    <td><?php echo $notification_details['appointment_date']; ?></td>
                    <td><?php echo $notification_details['appointment_time']; ?></td>

                    <td>
                        <form id="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?type=confirm&ref_id=<?php echo $row['n_id']; ?>"
                              method="POST">
                            <button type="submit" name="confirm_time" class="btn btn-outline-success"
                                    <?php if ($notification_details['has_reference_notification_id']){ ?>disabled<?php } ?>>
                                Confirm
                            </button>
                        </form>
                    </td>
                    <td>
                        <form id=""
                              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?type=another_date&ref_id=<?php echo $row['n_id']; ?>"
                              method="POST">

                            <button type="submit" name="request_time" class="btn btn-outline-success"
                                    <?php if ($notification_details['has_reference_notification_id']){ ?>disabled<?php } ?>>
                                Another Date
                            </button>

                        </form>
                    </td>

                </tr>

            <?php endforeach;
        } ?>

        </tbody>
    </table>

</fieldset>


<fieldset id="Reject_message1" style="display: none;">
    <div>
        <table class="table table-primary table-hover">

            <thead>
            <tr style="text-align: center">

                <th scope="col">Authorize officer</th>
                <th scope="col">Received Date</th>
                <th scope="col">Content</th>
                <th scope="col">Attachment</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result_receive_confirmations = $applicant->fetch_array_2('notification_details', 'to_id', 'n_type','=','=', $_SESSION['user_id'], 'confirmation', $order);
            if (is_null($result_receive_confirmations)) {
                echo "No notifications!";
            } else {
                foreach ($result_receive_confirmations as $i => $row):
                    $notification = unserialize($applicant->fetch_object('notification_details', 'n_id', $row['n_id'], 'n_object'));
                    $notification_details = $notification->accept($applicant);
                ?>
                    <tr>
                        <td><?php echo $notification->getFromId(); ?></td>
                        <td><?php echo $notification_details['send_date']; ?></td>
                        <td><?php echo $notification_details['content']; ?></td>
                        <td><?php
                            $receive_file = $notification_details['attachment'];
                            if (isset($receive_file)) {
                                echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
                                            <embed src=\"$receive_file\" width=100px height=100px>";
                            } ?></td>

                    </tr>
                <?php endforeach;
            } ?>
            </tbody>
        </table>
    </div>
</fieldset>

<fieldset id="Sent_message1" style="display:none;">
    <div>
        <table class="table table-primary table-hover">

            <thead>
            <tr>
                <th scope="col">Receiving officer</th>
                <th scope="col">Send Date</th>
                <th scope="col">Content</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $result_sent_notifications = $applicant->fetch_array('notification_details', 'from_id', $_SESSION['user_id'],$order);
            if (is_null($result_sent_notifications)) {
                echo "No notifications!";
            } else {
                foreach ($result_sent_notifications as $i => $row):
                    $notification = unserialize($applicant->fetch_value('notification_details', 'n_id','=', $row['n_id'], 'n_object'));
                    $notification_details = $notification->accept($applicant);
                    $receiver = unserialize($applicant->fetch_value('user_details', 'user_id','=', $row['to_id'], 'u_object'));
                    ?>
                    <tr>

                        <th scope="row"><?php echo $receiver->get_user_type() . ' ' . $receiver->get_user_name(); ?></th>
                        <td><?php echo $notification_details['send_date']; ?></td>
                        <td><?php echo $notification_details['content']; ?></td>
                    </tr>

                <?php endforeach;
            } ?>

            </tbody>
        </table>
    </div>
</fieldset>
</div>

</body>
</html>