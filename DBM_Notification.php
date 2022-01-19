<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
$user = unserialize($con->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($con);
$order = "";
$type = $user->get_user_type();

if($type == 'db_manager'){
    echo "<style>#nic_issuer{
            display: none;
     }</style>";
}else{
    echo "<style>#db-manager{
            display: none;
     }</style>";
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
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: rgb(10, 30, 235);
            background: linear-gradient(90deg, rgba(10, 30, 235, 1) 0%, rgba(15, 132, 139, 1) 41%, rgba(15, 30, 135, 1) 100%, rgba(101, 181, 198, 1) 100%);

            min-height: 100vh;
        }

        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 12vh;
            width: 100%;
            background: rgb(6, 59, 142);
            background: linear-gradient(90deg, rgba(6, 59, 142, 0.9671218829328606) 0%, rgba(4, 106, 38, 1) 100%);
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;

        }

        .header1 button:hover {
            background-color: white;
        }


    </style>
</head>
<body>
<div class="header1">
    <div style="padding-right:600px;">
        <form>
            <table>
                <tr>
                    <td style="padding-right:0%;">
                        <button type="submit" style="padding-right:10px;"><img src="Image/search.png" alt=""
                                                                               style="width: 40px;height:37px;">
                        </button>
                    </td>
                    <td style="padding-left:0%;"><input type="text" placeholder="    search....."
                                                        style="width: 650px;height:40px; margin-left:0%;   background-color: #f7f2f2;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div>
        <a href="dashboard.php">
            <button type="button" class="btn btn-sm btn-outline-light fas fa-arrow-left"
                    style="width: 100px;font-size:18px;margin-right:20px;"><b> Back</b></button>
        </a>
    </div>
</div>

<div id="db-manager">
    <div style="padding: 200px 100px 100px;color: white; background: rgb(10,30,235);background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">
        <fieldset id="table_detils">
            <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; ">
                <thead style="font-size:20px;">
                <tr class="table-info">
                    <th scope="col" id="Email">Notification ID</th>
                    <th scope="col" id="Email">Sent date</th>
                    <th scope="col" id="IdNumber">Sender</th>
                    <th scope="col" id="Username">Receiver</th>
                    <th scope="col" id="Action">Subject</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $user->fetch_array('notification_details', '', '','');
                foreach ($result as $i => $row):
                    $notification = $user->fetch_object('notification_details', 'n_id', $row['n_id'], 'n_object');
                    $notification_details = $notification->accept($user);
                    ?>
                    <tr scope="row" style="font-size: large;">
                        <td style="color: whitesmoke;"><?php echo $row['n_id']; ?></td>
                        <td style="color: whitesmoke;"><?php echo $notification_details['send_date']; ?></td>
                        <td style="color: whitesmoke;">
                            <?php
                            $sender = unserialize($user->fetch_object('user_details', 'user_id', $notification->getFromId(), 'username'));
                            echo $sender->get_user_type() . ' ' . $sender->get_user_name();
                            ?>
                        </td>
                        <td style="color: whitesmoke;">
                            <?php
                            $receiver = unserialize($user->fetch_object('user_details', 'user_id', $notification->getToId(), 'username'));
                            echo $receiver->get_user_type() . ' ' . $receiver->get_user_name();
                            ?>
                        </td>
                        <td style="color: whitesmoke;"><?php echo $notification->getType(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


        </fieldset>


    </div>
</div>
<div id="nic_issuer">
    <div style="padding: 200px 100px 100px;color: white; background: rgb(10,30,235);background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">
        <fieldset id="table_detils">
            <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; ">
                <thead style="font-size:20px;">
                <tr class="table-info">
                    <th scope="col" id="Email">Application ID</th>
                    <th scope="col" id="Email">Approved date</th>
                    <th scope="col" id="IdNumber">View NIC</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = $user->fetch_array('application_details', 'stat', 'approved', $order);
                foreach ($result as $i => $row):
                    $application = $user->fetch_object('application_details', 'app_id', $row['app_id'], 'application_object');
                    $application_details = $application->accept($user);
                    ?>
                    <tr scope="row" style="font-size: large;">
                        <td style="color: whitesmoke;"><?php echo $row['app_id']; ?></td>
                        <td style="color: whitesmoke;"><?php echo $application_details['approved_date']; ?></td>
                        <td style="color: whitesmoke;">
                        <a href="ID_Details.php?$application_id=<?php echo $row['app_id']; ?>"><button type="button" class="btn btn-sm btn-outline-danger"><b>Application Details</b></button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


        </fieldset>


    </div>
</div>
</body>
</html>