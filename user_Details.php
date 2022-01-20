<?php
session_start();
include 'autoloader.php';
$con = DB_OP::get_connection();
$db_manager = unserialize($con->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$db_manager->set_db($con);
// echo "<style>#applicant {
//     display: none;
// }</style>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
    <script src="Javascipt_File.js">
    </script>
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
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
            height: 19vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;

        }
    </style>
</head>
<body>
<div class="header1"><a href="dashboard.php">
        <button type="submit" class="btn btn-sm btn-outline-light fas fa-arrow-left"
                style="width: 100px;font-size:18px;margin-right:20px;color:black;"> Back
        </button>
    </a></div>
<div>
    <div style="padding: 100px;color: white; background: rgb(10,30,235);
background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">

        <div style="margin-top: 30px;margin-bottom:40px;">
            <form id="db-details-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <fieldset id="Disable_Tag">
                    <h2 style="color: black;  ">View Database Details</h2>
                    <br>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="officer" value="Estate_Superintendent"
                               id="Officer_E" onclick="show_details()" required>
                        <label class="form-check-label" for="Officer_E">Estate Superintendent</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="officer" value="Divisional_Secretary"
                               id="Officer_D" onclick="show_details()" required>
                        <label class="form-check-label" for="Officer_D">Divitional Secretary</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="officer" value="Grama_Niladari"
                               id="Officer_G" onclick="show_details()" required>
                        <label class="form-check-label" for="Officer_G">Grama Niladari</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="officer" value="Principal" id="Officer_P"
                               onclick="show_details()" required>
                        <label class="form-check-label" for="Officer_P">Principal</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="officer"
                               value="National_Identity_Card_Issuer" id="Officer_N" onclick="show_details()" required>
                        <label class="form-check-label" for="Officer_N">National Identity Card Issuer</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="officer" value="Applicant" id="student"
                               onclick="show_details()" required>
                        <label class="form-check-label" for="student">Applicant</label>

                    </div>
                    <input type="submit" name="Submit" style="width: 100px;color:aliceblue;"
                           class="btn btn-outline-primary">
                </fieldset>
            </form>
        </div>

        <fieldset id="table_detils">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if ($_POST['officer'] == "Estate_Superintendent") {
                    $o_type = 'es';

                } else if ($_POST['officer'] == "Grama_Niladari") {
                    $o_type = 'gn';

                } else if ($_POST['officer'] == "Principal") {
                    $o_type = 'principal';

                } else if ($_POST['officer'] == "Divisional_Secretary") {
                    $o_type = 'ds';

                } else if ($_POST['officer'] == "National_Identity_Card_Issuer") {
                    $o_type = 'ni';

                } else if ($_POST['officer'] == "Applicant") {
                    $o_type = 'applicant';

                } ?>

                <?php if($o_type=="applicant"){ ?>
                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="applicant" >
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $applicant = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $applicant->get_full_name(); ?></td>
                            <td class="Username"
                                style="color: whitesmoke;"><?php echo $applicant->get_user_name(); ?></td>
                            <td class="Email"
                                style="color: whitesmoke;"><?php echo $applicant->get_user_email(); ?></td>
                        </tr>
                    <?php endforeach;
                    ?>
                    </tbody>
                </table>
                       
                        <?php } else if($o_type=="ni"){ ?>
                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="ni">
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                        <th scope="col" id="Action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $nic_issuer = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $nic_issuer->get_full_name(); ?></td>
                            <td class="Username"
                                style="color: whitesmoke;"><?php echo $nic_issuer->get_user_name(); ?></td>
                            <td class="Email" style="color: whitesmoke;"><?php echo $nic_issuer->get_user_email(); ?></td>
                            <td class="Action">

                                <input type="hidden" name="id">
                                <a href="remove_data.php?id=<?php echo $row['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>
                                    </button>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                    </tbody>
                </table>

                <?php } else if($o_type=="admin"){ ?>
                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="admin">
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                        <th scope="col" id="Action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $admin = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $admin->get_full_name(); ?></td>
                            <td class="Username" style="color: whitesmoke;"><?php echo $admin->get_user_name(); ?></td>
                            <td class="Email" style="color: whitesmoke;"><?php echo $admin->get_user_email(); ?></td>
                            <td class="Action">

                                <input type="hidden" name="id">
                                <a href="remove_data.php?id=<?php echo $row['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>
                                    </button>
                                </a>

                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                    </tbody>
                </table>
                <?php } else if($o_type=="gn"){ ?>        

                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="gn">
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                        <th scope="col" id="Grama_Niladari_Divition" >Grama Niladhari Division
                        </th>
                        <th scope="col" id="Divitional_Secretariat" >Divisional Secretariat</th>
                        <th scope="col" id="Action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $gn = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $gn->get_full_name(); ?></td>
                            <td class="Username" style="color: whitesmoke;"><?php echo $gn->get_user_name(); ?></td>
                            <td class="Email" style="color: whitesmoke;"><?php echo $gn->get_user_email(); ?></td>

                            <td class="Grama_Niladari_Divition" style="color: whitesmoke;"
                                ><?php echo $gn->getGnDivOrAddress(); ?></td>
                            <td class="Divitional_Secretariat"  style="color: whitesmoke;"><?php echo $gn->getDs(); ?></td>

                            <td class="Action">
                                <input type="hidden" name="id">
                                <a href="remove_data.php?id=<?php echo $row['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>
                                    </button>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                    </tbody>
                </table>
                <?php } else if($o_type=="principal"){ ?>

                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="principal">
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                        <th scope="col" id="School_Name" >School Name</th>
                        <th scope="col" id="Action">Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $principal = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $principal->get_full_name(); ?></td>
                            <td class="Username"
                                style="color: whitesmoke;"><?php echo $principal->get_user_name(); ?></td>
                            <td class="Email"
                                style="color: whitesmoke;"><?php echo $principal->get_user_email(); ?></td>

                            <td class="School_Name" style="color: whitesmoke;"
                                ><?php echo $principal->getGnDivOrAddress(); ?></td>
                            <td class="Action">
                                <input type="hidden" name="id">
                                <a href="remove_data.php?id=<?php echo $row['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>
                                    </button>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                    </tbody>
                </table>
                        
                <?php } else if($o_type=="es"){ ?>
                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="es">
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                        <th scope="col" class="Estate_Address" >Estate Address</th>

                        <th scope="col" id="Action">Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $es = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $es->get_full_name(); ?></td>
                            <td class="Username" style="color: whitesmoke;"><?php echo $es->get_user_name(); ?></td>
                            <td class="Email" style="color: whitesmoke;"><?php echo $es->get_user_email(); ?></td>
                            <td class="Estate_Address" style="color: whitesmoke;"><?php echo $es->getGnDivOrAddress(); ?></td>

                            <td class="Action">
                                <input type="hidden" name="id">
                                <a href="remove_data.php?id=<?php echo $row['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>
                                    </button>
                                </a>

                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                    </tbody>
                </table>
                <?php } else if($o_type=="ds"){ ?>

                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "
                       id="ds">
                    <thead style="font-size:20px;">
                    <tr class="table-info">
                        <th scope="col" id="IdNumber">ID Number</th>
                        <th scope="col" id="Fullname">Full Name</th>
                        <th scope="col" id="Username">Username</th>
                        <th scope="col" id="Email">Email</th>
                        <th scope="col" id="Divitional_Secretariat"  >Divitional Secretariat</th>
                        <th scope="col" id="Action">Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php
                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                    foreach ($result as $i => $row):?>
                        <tr scope="row" style="font-size: large;">
                            <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id'] ?></td>
                            <td class="Fullname" style="color: whitesmoke;"><?php
                                $ds = unserialize($db_manager->fetch_value('user_details', 'user_id', $row['user_id'], 'u_object'));
                                echo $ds->get_full_name(); ?></td>
                            <td class="Username" style="color: whitesmoke;"><?php echo $ds->get_user_name(); ?></td>
                            <td class="Email" style="color: whitesmoke;"><?php echo $ds->get_user_email(); ?></td>

                            <td class="Divitional_Secretariat" style="color: whitesmoke;"><?php echo $ds->getDs(); ?></td>

                            <td class="Action">

                                <input type="hidden" name="id">
                                <a href="remove_data.php?id=<?php echo $row['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>
                                    </button>
                                </a>

                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                    </tbody>
                </table>
                <?php } ?>
                <!--                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "-->
                <!--                       id="applicant">-->
                <!--                    <thead style="font-size:20px;">-->
                <!--                    <tr class="table-info">-->
                <!--                        <th scope="col" id="IdNumber">ID Number</th>-->
                <!--                        <th scope="col" id="Username">Username</th>-->
                <!--                        <th scope="col" id="Email">Email</th>-->
                <!--                        <!-- ================================================================================ -->
                
                <!--                        <!-- <th scope="col" class="Estate_Address" style="display: none;">Estate Address</th>-->
                <!--                        <th scope="col" id="Grama_Niladari_Divition" style="display: none;">Grama Niladari Divition</th>-->
                <!--                        <th scope="col" id="Divitional_Secretariat" style="display: none;">Divitional Secretariat</th>-->
                <!--                        <th scope="col" id="School_Name" style="display: none;">School Name</th>  -->
              
                <!--                        <th scope="col" id="Action">Action</th>-->
                <!--                    </tr>-->
                <!--                    </thead>-->
                <!--                    <tbody>-->
                <!---->
                <!---->
                <!--                    --><?php
                //                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                //                    foreach ($result as $i => $row):?>
                <!--                        <tr scope="row" style="font-size: large;">-->
                <!--                            <td class="IdNumber" style="color: whitesmoke;">-->
                <?php //echo $row['user_id'] ?><!--</td>-->
                <!--                            <td class="Username" style="color: whitesmoke;">-->
                <?php //echo $row['username'] ?><!--</td>-->
                <!--                            <td class="Email" style="color: whitesmoke;">-->
                <?php //echo $row['email'] ?><!--</td>-->
                <!--                            <!--<td class="Estate_Address" style="display: none;">Estate Address</td>-->
                <!--                            <td class="Grama_Niladari_Divition" style="display: none;">34</td>-->
                <!--                            <td class="Divitional_Secretariat" style="display: none;">24</td>-->
                <!--                            <td class="School_Name" style="display: none;">234</td> -->
                <!--                            <td class="Action">-->
                <!--                                <!-- <form style="display: inline-block" > -->
                <!--                                <input type="hidden" name="id">-->
                <!--                                <a href="remove_data.php?id=-->
                <?php //echo $row['user_id'] ?><!--">-->
                <!--                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>-->
                <!--                                    </button>-->
                <!--                                </a>-->
                <!--                                <!-- </form> -->
                <!--                            </td>-->
                <!--                        </tr>-->
                <!---->
                <!--                    --><?php //endforeach;
                //                    ?>
                <!---->
                <!--                    </tbody>-->
                <!--                </table>-->
                <!--                <table class="table table-striped table-hover" style="text-align: center;font-weight:bolder; "-->
                <!--                       id="applicant">-->
                <!--                    <thead style="font-size:20px;">-->
                <!--                    <tr class="table-info">-->
                <!--                        <th scope="col" id="IdNumber">ID Number</th>-->
                <!--                        <th scope="col" id="Username">Username</th>-->
                <!--                        <th scope="col" id="Email">Email</th>-->
                <!--                        <!-- ================================================================================ -->
                
                <!--                        <!-- <th scope="col" class="Estate_Address" style="display: none;">Estate Address</th>-->
                <!--                        <th scope="col" id="Grama_Niladari_Divition" style="display: none;">Grama Niladari Divition</th>-->
                <!--                        <th scope="col" id="Divitional_Secretariat" style="display: none;">Divitional Secretariat</th>-->
                <!--                        <th scope="col" id="School_Name" style="display: none;">School Name</th>  -->
                
                <!--                        <th scope="col" id="Action">Action</th>-->
                <!--                    </tr>-->
                <!--                    </thead>-->
                <!--                    <tbody>-->
                <!---->
                <!---->
                <!--                    --><?php
                //                    $result = $db_manager->fetch_array('user_details', 'u_type', $o_type, "ORDER BY user_id DESC");
                //                    foreach ($result as $i => $row):?>
                <!--                        <tr scope="row" style="font-size: large;">-->
                <!--                            <td class="IdNumber" style="color: whitesmoke;">-->
                <?php //echo $row['user_id'] ?><!--</td>-->
                <!--                            <td class="Username" style="color: whitesmoke;">-->
                <?php //echo $row['username'] ?><!--</td>-->
                <!--                            <td class="Email" style="color: whitesmoke;">-->
                <?php //echo $row['email'] ?><!--</td>-->
                <!--                            <!--<td class="Estate_Address" style="display: none;">Estate Address</td>-->
                <!--                            <td class="Grama_Niladari_Divition" style="display: none;">34</td>-->
                <!--                            <td class="Divitional_Secretariat" style="display: none;">24</td>-->
                <!--                            <td class="School_Name" style="display: none;">234</td> -->
                <!--                            <td class="Action">-->
                <!--                                <!-- <form style="display: inline-block" > -->
                <!--                                <input type="hidden" name="id">-->
                <!--                                <a href="remove_data.php?id=-->
                <?php //echo $row['user_id'] ?><!--">-->
                <!--                                    <button type="submit" class="btn btn-sm btn-outline-danger"><b>Remove Account</b>-->
                <!--                                    </button>-->
                <!--                                </a>-->
                <!--                                <!-- </form> -->
                <!--                            </td>-->
                <!--                        </tr>-->
                <!---->
                <!--                    --><?php //endforeach;
                //                    ?>
                <!---->
                <!--                    </tbody>-->
                <!--                </table>-->
            <?php } ?>
        </fieldset>
        
    </div>
</div>
</body>
</html>