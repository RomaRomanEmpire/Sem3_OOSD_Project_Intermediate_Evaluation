<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
$user = unserialize($con->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <link rel="stylesheet" href="bootstrap.css">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <style>
        body {
            min-height: 100vh;
        }
    </style>

    <script type="text/javascript" src="Javascipt_File.js">

    </script>
</head>
<body class="p-3 mb-2 bg-info text-dark" style="background: linear-gradient(#1D2671 ,#667EEA);">
<div>
    <div style="width: 100%; height: 70px;  display: flex; position: fixed;top: 0; right: 0;z-index: 3;box-shadow: 0 4px 8px rgba(77, 51, 51, 0.2); justify-content: right;">

        <!-- <a class="btn btn-outline-light" href="RAP_dashboard.php" role="button"
           style="height: 40px; width: 150px; padding-top:10px;margin:10px;">Back</a> -->
        <button class="btn btn-sm btn-outline-light fas fa-arrow-left" id="Back"
                style="height: 30px; width: 100px; padding-top:10px;margin:10px;" onclick=" GoPreviousFile()"> Back
        </button>

    </div>
    <br><br><br><br>
    <div class="p-3 mb-2 bg-secondary text-white" style="background: linear-gradient(#764BA2 , #667EEA);  ">

        <div>
            <div>

                <h1 class="display-3" style="font-family: 'Times New Roman', Times, serif; text-align: center;"><b>View
                        Application Details</b></h1>
                <br><br>
                <table class="table  table-hover  border border-3  border-dark table table-success table-striped "
                       style="text-align: center; ">
                    <thead>
                    <tr>

                        <?php if ($user->get_user_type() != "applicant") { ?>
                            <th scope="col">Index Number</th>
                        <?php } ?>
                        <th scope="col">Date</th>

                        <th scope="col">Status</th>

                        <?php if ($user->get_user_type() != "applicant") { ?>
                            <th scope="col">Applicant's Name</th>
                        <?php } ?>
                        <th scope="col">View Application</th>

                    </tr>
                    </thead>
                    <tbody class="table-secondary table-info">
                    <?php


                    if ($user->get_user_type() == "db_manager") {
                        $result = $con->database_details('application_details', '', '', '');
                    } else if ($user->get_user_type() == "admin") {
                        $result = $con->database_details_2('application_details', 'stat', 'stat', '!=', '!=', 'sent_to_rap_1', 'sent_to_ds', "");
                    } else if ($user instanceof R_A_P_1) {
                        $result = $con->database_details('application_details', 'gn_div_or_address', $user->getGnDivOrAddress(), "");
                    } else if ($user->get_user_type() == "ds") {
                        $result = $con->database_details_2('application_details', 'ds', 'stat', '=', '!=', $user->getDs(), 'sent_to_rap_1', "");
//                    } else if ($user->get_user_type() == "ni") {
                    } else {
                        $result = $con->database_details('application_details', 'stat', 'approved', "");
                    }

                    foreach ($result as $i => $row):
                        $applicant = $con->get_column_value("user_details", "user_id", "=", $row['applicant_id'], "username", "") ?>
                        <tr>
                            <?php if ($user->get_user_type() != "applicant") { ?>
                                <th scope="row"><?php echo $row['app_id'] ?></th>
                            <?php } ?>
                            <td><?php echo $row['apply_date'] ?></td>

                            <td><?php echo $row['stat'] ?></td>

                            <?php if ($user->get_user_type() != "applicant") { ?>
                                <td><?php echo $applicant ?></td>
                            <?php } ?>
                            <td><a href="Filled_Application.php?application_id=<?php echo $row['app_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-success"><b>Application
                                            Details</b></button>
                                </a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>