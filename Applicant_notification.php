<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();

$applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$applicant->set_db($conn);
$applicant->set_row_id($_SESSION['user_id']);
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

        .header2 button:hover{
            background-color: #525252;
        }

        .header2 select:hover {
            background-color: #525252;
        }

        .header2 button{
            height:35px;
            width:150px;
            text-align:center;
            background-color: #203169;
            color:white;
        }

        .header2 select {
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            height:35px;
            width:150px;
            text-align:center;
            background-color: #203169;
            color:white;
        }

        table {
            table-layout: fixed;
        }

        td {
            word-wrap: break-word;
            padding-left: 10px;
        }

        .container1 {
            position: absolute;
            right: 0;
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(mediumpurple, white);
        }
    </style>
    <script src="Javascipt_File.js">
    </script>
</head>
<body>
<div class="container1">
    <div class="header2" style="background-color:lightblue;">
        <div class="nav">
            <div>
                <h1 style="color: black; padding-left:600px; padding-top:20px;"><p id="Topic1">Notifications</p></h1>
            </div>
            <table>

                <tbody>
                <tr>

                    <div class="input-group mb-3" style="width: 50%;p adding-left: 30px "></div>


                    <form id="order-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <td style="padding-top: 10px;padding-left:150px;">
                            <div>

                                <select name="order" class="form-select" aria-label="Default select example">
                                    <option value="latest" selected="selected">Latest</option>
                                    <option value="oldest">Oldest</option>

                                </select>
                            </div>
                        </td>
                        <td style="margin-left:10px;">
                            <div>
                                <button type="submit" class="btn btn-success">Apply Filter
                                </button>
                            </div>
                        </td>
                    </form>
                </tr>
                </tbody>

            </table>


        </div>

        <div style="padding-top: 50px;">
            <a class="btn btn-outline-light" href="applicant_dashboard.php" role="button"
               style="height: 35px; width: 150px; background-color:#1cdb92; margin-top:30px; margin-right: 10px;">Back</a>
        </div>

    </div>
    <div class="side_menu1" style="padding-top: 200px; padding-left:0px; background-color: lightblue;">


        <ul>
            <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedT1" autocomplete="off"
                       onclick="Notification1()">
                <label class="btn btn-outline-primary" for="btn_check_outlinedT1"><p
                            style="font-weight: bold;width:100px; height:25px; text-align: center;">Appoinment Time</p></label><br>
            </li>

            <br>
            <li>
                <input type="radio" name="h" class="btn-check" id="btn_check_outlinedR1" autocomplete="off"
                       onclick="Notification1()">
                <label class="btn btn-outline-primary" for="btn_check_outlinedR1"><p
                            style="font-weight: bold;width:100px; height:25px; text-align: center;">Confirmation</p></label>
            </li>
            <br>

            <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedS1" autocomplete="off"
                       onclick="Notification1()">
                <label class="btn btn-outline-primary" for="btn_check_outlinedS1"><p
                            style="font-weight: bold;width:100px; height:25px; text-align: center;">Sent Messages</p></label>
            </li>

        </ul>

    </div>


    <div class="Center">

        <fieldset id="Time1" style="display: block;">
            <div>
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
                    $result_receive_appointment = $conn->database_details_2('notification_details', 'to_id', 'n_type', $_SESSION['user_id'], 'appointment', $order);
                    if (is_null($result_receive_appointment))
                        echo "No notifications!";
                    else {
                        foreach ($result_receive_appointment as $i => $row):
                            $notification = $conn->get_column_value('notification_details', 'n_id', '=', $row['n_id'], 'n_object', $order);
                            ?>
                            <tr>
                                <td><?php echo $notification->getSender(); ?></td>
                                <td><?php echo $notification->getAppointmentDate(); ?></td>
                                <td><?php echo $notification->getAppointmentTime(); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-outline-success">Confirm</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success">Another Date</button>
                                </td>
                            </tr>
                        <?php endforeach;
                    } ?>

                    </tbody>
                </table>
            </div>
        </fieldset>


        <fieldset id="Reject_message1" style="display: none;">
            <div>
                <table class="table table-primary table-hover">

                    <thead>
                    <tr>

                        <th scope="col">Authorize officer</th>
                        <th scope="col">Received Date</th>
                        <th scope="col">Content</th>
                        <th scope="col">Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result_receive_confirmations = $conn->database_details_2('notification_details', 'to_id', 'n_type', $_SESSION['user_id'], 'confirmation', $order);
                    if (is_null($result_receive_confirmations)) {
                        echo "No notifications!";
                    } else {
                        foreach ($result_receive_confirmations as $i => $row):
                            $notification = $conn->get_column_value('notification_details', 'n_id', '=', $row['n_id'], 'n_object', "");
                            ?>
                            <tr>
                                <td><?php echo $notification->getSender(); ?></td>
                                <td><?php echo $notification->getSendDate(); ?></td>
                                <td><?php echo $notification->getText(); ?></td>
                                <td><?php
                                    $receive_file = $notification->getAttachment();
                                    echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?></td>
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
                        <th scope="col">Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result_sent_answers = $conn->database_details_2('notification_details', 'from_id', 'n_type', $_SESSION['user_id'], 'answer', "ORDER BY user_id DESC");
                    if (is_null($result_sent_answers)) {
                        echo "No notifications!";
                    } else {
                        foreach ($result_sent_answers as $i => $row):
                            $notification = $conn->get_column_value('notification_details', 'n_id', '=', $row['n_id'], 'n_object', "");
                            ?>
                            <tr>

                                <th scope="row"><?php echo $notification->getSender(); ?></th>
                                <td><?php echo $notification->getSendDate(); ?></td>
                                <td><?php echo $notification->getText(); ?></td>
                                td>
                                <td><?php
                                    $receive_file = $notification->getAttachment();
                                    echo "<a href='view_file.php?path=" . $receive_file . "' target='_blank'' style='color:blue;'>" . "View in Full" . "</a><br><br>
													<embed src=\"$receive_file\", width=100px height=100px>"; ?></td>
                            </tr>
                            </td>
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