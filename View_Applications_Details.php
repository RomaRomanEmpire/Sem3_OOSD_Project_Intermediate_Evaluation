<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
$user = unserialize($con->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$user->set_db($con);
$user->set_row_id($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <link rel="stylesheet" href="bootstrap.css">

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
        <button class="btn btn-outline-light" id="Back" style="height: 40px; width: 150px; padding-top:10px;margin:10px;" onclick=" GoPreviousFile()">Back</button>

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

                        <?php if($user->get_user_type() != "applicant"){?>
                        <th scope="col">Index Number</th>
                        <?php } ?>
                        <th scope="col">Date</th>
                        <?php if ($user->get_user_type() == "db_manager" || $user->get_user_type() == "applicant") { ?>
                        <th scope="col">Status</th>
                        <?php } ?>
                        <?php if($user->get_user_type() != "applicant"){?>
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
                    $result = $con->database_details('application_details', 'stat', 'sent_to_admin', "ORDER BY app_id DESC");
                    } else if ($user->get_user_type() == "gn" || $user->get_user_type() == "es" || $user->get_user_type() == "principal" || $user->get_user_type() == "co") {
                    $result = $con->database_details_2('application_details', 'stat', 'gn_div_or_address', 'sent_to_rap_1', "$user->getGnDivOrAddress()", "");
                    } else if ($user->get_user_type() == "ds") {
                    $result = $con->database_details_2('application_details', 'stat', 'ds', 'sent_to_ds', "$user->getDs()", "");
                    } else if ($user->get_user_type() == "ni") {
                    $result = $con->database_details('application_details', 'stat', 'approved', "");
                    } else{
                    $result = $con->database_details('application_details', 'applicant_id', $_SESSION['user_id'], "");
                    }

                    foreach ($result as $i => $row):
                    $applicant = $con->get_column_value("user_details", "user_id", "=", $row['applicant_id'], "username", "") ?>
                    <tr>
                        <?php if($user->get_user_type() != "applicant"){?>
                        <th scope="row"><?php echo $row['app_id'] ?></th>
                        <?php } ?>
                        <td><?php echo $row['apply_date']?></td>
                        <?php if ($user->get_user_type() == "db_manager" || $user->get_user_type() == "applicant") { ?>
                        <td><?php echo $row['stat'] ?></td>
                        <?php } ?>
                        <?php if($user->get_user_type() != "applicant"){?>
                        <td><?php echo $applicant ?></td>
                        <?php } ?>
                        <td><a href="Filled_Application.php?application_id=<?php echo $row['app_id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-success"><b>Application
                                        Details</b></button>
                            </a></td>
                        <!--                            <td><a href="">-->
                        <!--                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Approve</b>-->
                        <!--                                    </button>-->
                        <!--                                </a></td>-->
                    </tr>
                        <!-- <tr >
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-success" ><b>Application Details</b></button></a></td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-danger" ><b>Approve</b></button></a></td>
                        </tr>
                        <tr >
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-success" ><b>Application Details</b></button></a></td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-danger" ><b>Approve</b></button></a></td>
                        </tr>
                        <tr >
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-success" ><b>Application Details</b></button></a></td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-danger" ><b>Approve</b></button></a></td>
                        </tr>
                        <tr >
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-success" ><b>Application Details</b></button></a></td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-danger" ><b>Approve</b></button></a></td>
                        </tr>
                        <tr >
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-success" ><b>Application Details</b></button></a></td>
                          <td><a href=""><button  type="submit" class="btn btn-sm btn-outline-danger" ><b>Approve</b></button></a></td>
                        </tr> -->
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>