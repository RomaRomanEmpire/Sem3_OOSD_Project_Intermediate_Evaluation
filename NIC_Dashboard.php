<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();
$user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($conn);
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

<fieldset id="db-manager">
    <div style="padding: 200px 100px 100px;color: white; background: rgb(10,30,235);background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">
        <fieldset id="table_detils">
            <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; ">
                <thead style="font-size:20px;">
                <tr class="table-info">
                    <!-- <th scope="col" id="Email">Applicant ID</th> -->
                    <th scope="col" id="Email">Applicant Name</th>
                    <th scope="col" id="IdNumber">Issued Date</th>
                    <th scope="col" id="Username">View NIC</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $result = $user->fetch_array('issued_id_history', '', '', '');
                foreach ($result as $i => $row):
                    $nic = unserialize($user->fetch_value('issued_id_history', 'application_id', $row['application_id'], 'nic_object'));
                    $nic_details = $nic->accept($user);
                    ?>
                    <tr scope="row" style="font-size: large;">
                        <td style="color: whitesmoke;"><?php echo $nic_details['fullname']; ?></td>
                        <td style="color: whitesmoke;"><?php echo $nic->getIssuedDate(); ?></td>

                        <td style="color: whitesmoke;">
                            <a href="ID_Details.php?application_id=<?php echo $row["application_id"];?>">
                                <button type="button" class="btn btn-outline-light " id="Back">View NIC</button>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</fieldset>


</body>
</html>