<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();
$db_manager = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$db_manager->set_db($conn);

$db_manager->remove_L_P_User('user_details', 'staff_id', $_GET['staff_id']);

header("location:user_Details.php");

