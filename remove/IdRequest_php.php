<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    print_r($_POST);
    $con = DB_OP::get_connection();
    $application = new Application($_POST);
    $applicant = $con->get_column_value("user_details","user_id","=",$_SESSION['user_id'],"user_id","");
    $applicant->apply_NIC($_SESSION['GN_division'],$_SESSION['DS_division'],$application);
}
?>
