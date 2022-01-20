<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();

$staff_member = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$staff_member->set_db($conn);
$staff_member->set_row_id($_SESSION['user_id']);
$order = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['order'] == 'latest')
        $order = "ORDER BY n_id DESC";
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
            /* background: rgb(2, 0, 36); */
            /* background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 1%, rgba(0, 212, 255, 1) 100%); */

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
            /* border-radius: 10px; */
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #525252;
        }

        select:hover {
            
            background: white;
            color:black;
        }

        select {
            height: 35px;
            width: 150px;
            padding-left: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            /* background-color: none; */
            background: rgba(0,0,0,0.1);
            color: white;
        }

        

        #Form {
            margin: 5px;
            padding: 5px;
            width: 20%;
        }

        table {
            table-layout: fixed;
        }

        td {
            word-wrap: break-word;
            /* padding-top: 15px; */
            padding-left: 10px;
        }

        #grad1 {
            background-image: linear-gradient(to top, #64646b, #717176, #7e7e82, #8c8b8d, #999999);
        }

        #grad2 {
            background-image: linear-gradient(to right top, #626262, #68686f, #6c6f7c, #6e7689, #6d7e97, #72839f, #7789a7, #7c8eaf, #8b92b2, #9995b4, #a699b5, #b19eb6);
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container1 {
            position: absolute;
            right: 0;
            width: 100%;
            min-height: 100vh;
            
        }
        .BackGround_Image .container1 .header2 .nav button{
            height: 35px;
            width: 150px;
            background: rgba(0,0,0,0.1);
            color: white;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .BackGround_Image .container1 .header2 .nav button:hover{
            background: white;
            color:black;
        }
        .BackGround_Image .container1 .header2 .nav   ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: white;}
         /* Microsoft Edge */
        /* .BackGround_Image .container1 .header2 .nav     ::-ms-input-placeholder { */
            
           /* color: white;} */
          
    </style>
    <script src="Javascipt_File.js">
    </script>
</head>
<body >
<div class="BackGround_Image">
<div class="container1">
    <div class="header2">
        <div class="nav">
            <div>
                <h2 style="color: white;padding-left:400px;padding-top:20px;"><p id="Topic">Inbox Messages</p></h2>
            </div>


            <table>

                <tbody>
                <tr>
                    <form id="search-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <td>
                            <div class="input-group mb-3" style="  width: 50%;padding-right:50px;padding-left:0px;">
                        <td style="padding-left: 0px;">
                            <button class="btn btn-outline-light" type="submit" id="button-addon1"
                                    style="height: 35px;border-radius: 0px;">Search
                            </button>
                        </td>
                        <td style="padding-left: 0px;"><input type="text" class="form-control"
                                                              placeholder="Enter ID Number........."
                                                              aria-label="Example text with button addon"
                                                              aria-describedby="button-addon1"
                                                              style="height: 35px;border-radius: 0px; background: rgba(0,0,0,0.1);color:white;"></td>

        </div>
        </td>
        </form>

        <form id="order_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <td style="padding-top: 5px;padding-left:100px;">
                <div>

                    <select name="order"  aria-label="Default select example"  >
                        <option value="latest" selected="selected">Latest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                </div>
            </td>
            <td style="padding-left:60px;">
                <div>
                    <button type="submit" >Apply Filter </button>
                </div>
            </td>
        </form>
        </tr>
        </tbody>

        </table>


    </div>
    <div style="padding-top: 75px;">
        <!--        correct back button-->
        <a class="btn btn-outline-light fas fa-arrow-left" href="dashboard.php" role="button"
           style="height: 35px; width: 150px; padding-right:10px;margin-right: 10px;"> Back</a>
    </div>

</div>
<div class="side_menu1" style="padding-top: 200px; padding-left:0px;">


    <ul>
        <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedc" autocomplete="off"
                   onclick="Notification()">
            <label class="btn btn-outline-light" for="btn_check_outlinedc" style="border-color: white;"><p
                        style="font-weight: bold;width:150px; height:10px;">Confirm Messages</p></label><br>
        </li>
        <br>
        <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedI" autocomplete="off"
                   onclick="Notification()">
            <label class="btn btn-outline-light" for="btn_check_outlinedI" style="border-color: white;"><p
                        style="font-weight: bold;width:150px; height:10px;">Inbox Messages</p></label><br>
        </li>
        <br>
        <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedS" autocomplete="off"
                   onclick="Notification()">
            <label class="btn btn-outline-light" for="btn_check_outlinedS" style="border-color: white;"><p
                        style="font-weight: bold;width:150px; height:10px;">Sent Messages</p></label>
        </li>
        <fieldset id="Sent" style="display: none;">
            <br>
            <li>
                <input type="radio" name="e" class="btn-check" id="btn_check_outlinedT" autocomplete="off"
                       onclick="Notification()">
                <label class="btn btn-outline-info" for="btn_check_outlinedT"><p
                            style="font-weight: bold;width:150px; height:10px;">Time Allocation</p></label>
            </li>
            <br>
            <li>
                <input type="radio" name="e" class="btn-check" id="btn_check_outlinedR" autocomplete="off"
                       onclick="Notification()">
                <label class="btn btn-outline-info" for="btn_check_outlinedR"><p
                            style="font-weight: bold;width:150px; height:10px;">Confirmations</p></label>
            </li>
        </fieldset>
    </ul>


</div>


<div class="Center" style="padding-top: 150px;">
    <fieldset id="confirmation_message" style="display: none;">
        <div>
            <table class="table table-primary table-hover">

                <thead>
                <tr>
                    <th scope="col">ID Number</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Sender</th>
                    <th scope="col">content</th>
                    <th scope="col">Attachment</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result_receive_confirmation = $staff_member->fetch_array_2('notification_details', 'to_id', 'n_type', '=', '=', $_SESSION['user_id'], 'confirmation', $order);
                if (is_null($result_receive_confirmation)) {
                    echo "No notifications!";
                } else {
                    foreach ($result_receive_confirmation as $i => $row):
                        $notification = unserialize($staff_member->fetch_value('notification_details', 'n_id', $row['n_id'], 'n_object'));
                        $notification_details = $notification->accept($staff_member);
                        ?>
                        <tr>
                            <td><?php echo $row['n_id']; ?></td>
                            <td><?php
                                $applicant_id = $staff_member->fetch_value('application_details', 'app_id', $row['application_id'], 'applicant_id');
                                $applicant = $staff_member->fetch_value('user_details', 'user_id',  $applicant_id, 'username');
                                echo $applicant;
                                ?></td>
                            <td><?php
                                $sender = $staff_member->fetch_value('user_details', 'user_id', $notification->getFromId(), 'username');
                                echo $sender;
                                ?></td>
                            <td><?php echo $notification_details['content']; ?></td>
                            <td><?php

                                $receive_file = $notification_details['attachment'] ?? NULL;
                                if (isset($receive_file)) {
                                    echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>";
                                } ?></td>
                        </tr>
                    <?php endforeach;
                } ?>


                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset id="Inbox_message" style="display: block;">
        <div>
            <table class="table table-primary table-hover">

                <thead>
                <tr>
                    <th scope="col">ID Number</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Content</th>
                    <th scope="col">Add A Reply</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result_appointment_reschedules = $staff_member->fetch_array_2('notification_details', 'to_id', 'n_type', '=', '=', $_SESSION['user_id'], 'appointment', $order);
                if (is_null($result_appointment_reschedules)) {
                    echo "No notifications!";
                } else {
                    foreach ($result_appointment_reschedules as $i => $row):
                        $notification = unserialize($staff_member->fetch_value('notification_details', 'n_id', $row['n_id'], 'n_object'));
                        $notification_details = $notification->accept($staff_member);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['n_id']; ?></th>
                            <td><?php
                                $applicant_id =$staff_member->fetch_value('application_details', 'app_id', $row['application_id'], 'applicant_id');
                                $applicant = $staff_member->fetch_value('user_details', 'user_id', $applicant_id, 'username');
                                echo $applicant;
                                ?></td>
                            <td><?php echo $notification_details['appointment_date']; ?></td>
                            <td><?php echo $notification_details['appointment_time']; ?></td>
                            <td><?php echo $notification_details['content']; ?></td>
                            <td>
                                <a href="Time_slot.php?application_id=<?php echo $row['application_id']; ?>">
                                    <button type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add reply
                                    </button>
                                </a></td>
                        </tr>

                    <?php endforeach;
                } ?>


                </tbody>
            </table>
        </div>
    </fieldset>

    <fieldset id="Sent_message" style="display:none;">
        <div>
            <table class="table table-primary table-hover">

                <thead>
                <tr>
                    <th scope="col">Application Number</th>
                    <th scope="col">Notification Typer</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Send Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result_appointment_schedules = $staff_member->fetch_array_2('notification_details', 'from_id', 'n_type', '=', '=', $_SESSION['user_id'], 'appointment', $order);
                if (is_null($result_appointment_schedules)) {
                    echo "No notifications!";
                } else {
                    foreach ($result_appointment_schedules as $i => $row):
                        $notification = unserialize($staff_member->fetch_value('notification_details', 'n_id', $row['n_id'], 'n_object'));
                        $notification_details = $notification->accept($staff_member);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['application_id']; ?></th>
                            <td><?php echo $row['n_type']; ?></td>
                            <td><?php
                                $applicant_id = $staff_member->fetch_value('application_details', 'app_id',  $row['application_id'], 'applicant_id');
                                $applicant = $staff_member->fetch_value('user_details', 'user_id',  $applicant_id, 'username');
                                echo $applicant;
                                ?></td>
                            <td><?php echo $notification_details['appointment_date']; ?></td>
                            <td><?php echo $notification_details['appointment_time']; ?></td>
                            <td><?php echo $notification_details['send_date']; ?></td>

                        </tr>

                    <?php endforeach;
                } ?>

                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset id="Reject_message" style="display: none;">
        <div>
            <table class="table table-primary table-hover">

                <thead>
                <tr>
                    <th scope="col">ID Number</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Send Date</th>
                    <th scope="col">View Message</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result_confirmations = $staff_member->fetch_array_2('notification_details', 'to_id', 'n_type', '=', '=', $_SESSION['user_id'], 'confirmation', $order);
                if (is_null($result_confirmations)) {
                    echo "No notifications!";
                } else {
                    foreach ($result_confirmations as $i => $row):
                        $notification = $staff_member->fetch_value('notification_details', 'n_id', $row['n_id'], 'n_object');
                        $notification_details = $notification->accept($staff_member);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php
                                $applicant_id = $staff_member->fetch_value('application_details', 'app_id', '=', $row['application_id'], 'applicant_id');
                                $applicant = $staff_member->fetch_value('user_details', 'user_id', $applicant_id, 'username');
                                echo $applicant;
                                ?></td>
                            <td><?php echo $notification_details['send_date']; ?></td>
                            <td><a href="view_message.php?n_id=<?php echo $row['n_id'] ?>">
                                    <button type="button" class="btn btn-outline-primary" style="width: 100px;"><img
                                                src="Image/view.png"> view
                                    </button>
                                </a></td>
                        </tr>
                    <?php endforeach;
                } ?>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
</div>

</body>
</html>